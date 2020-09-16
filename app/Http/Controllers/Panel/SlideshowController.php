<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Slider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Image as ImageInvention;

use Symfony\Component\HttpFoundation\File\File as FileFile;

class SlideshowController extends Controller
{

    public function List()
    {
        $slideshows = Slider::all();


        return view('Panel.Slider.List', compact(['slideshows']));
    }
    public function Add()
    {

        $posts = Post::all();

        return view('Panel.Slider.Add', ['posts' => $posts]);
    }


    public function Save(Request $request)
    {

        
        $destinationPath = "files/slideshow/";
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
       
        if ($request->hasFile('poster')) {
         
                    $resize = $this->savePoster($request->file('poster'), 'slider_', $destinationPath);
            //         $resize = $this->image_resize(1900,900,$Poster,$destinationPath);
                 
            // File::delete(public_path() . '/' . $Poster);
            // $img = ImageInvention::make(public_path($picPath))->resize(1900, 900)->save(public_path($picPath));
        }

        $slideshow = new Slider;
        $slideshow->post_id = $request->post;
        $slideshow->image = $resize;

        $slideshow->save();
        toastr()->success('اسلایدشو با موفقیت افزوده شد');
        return redirect()->route('Panel.SliderList');
    }

    public function Delete(Request $request)
    {

        $slideshow = Slider::find($request->slider_id);

        File::delete(public_path() . '/' . $slideshow->image);

        $slideshow->delete();
        toastr()->success('اسلایدشو با موفقیت حذف شد');
        return back();
    }

    public function Edit($id)
    {
        
      
       $slideshow = Slider::whereId($id)->first();
       $posts = Post::all();
      return view('Panel.Slider.Add', ['posts' => $posts,'slideshow'=>$slideshow]);
    }

    public function SaveEdit(Request $request,$id)
    {

        $slideshow = Slider::whereId($id)->first();
        $destinationPath = "files/slideshow";
      

        if ($request->hasFile('poster')) {
             if (!File::exists("$destinationPath/$slideshow->image")) {
                    File::delete(public_path() . "$destinationPath/$slideshow->image");
            }
            $picextension = $request->file('poster')->getClientOriginalExtension();
            $fileName = 'slider_' . time() . '-(1900X900)_' . '.' . $picextension;
            $request->file('poster')->move($destinationPath, $fileName);
            $picPath = "files/slideshow/$fileName";
            $img = ImageInvention::make(public_path($picPath))->resize(1900, 900)->save(public_path($picPath));
        }
         else{
             $picPath = $slideshow->image;
         }

        
        $slideshow->post_id = $request->post;
        $slideshow->image = $picPath;


        $slideshow->update();
        toastr()->success('اسلایدشو با موفقیت ویرایش شد');
        return redirect()->route('Panel.SliderList');
    }
}
