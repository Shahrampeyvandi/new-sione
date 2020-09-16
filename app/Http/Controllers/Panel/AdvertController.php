<?php

namespace App\Http\Controllers\Panel;

use App\AdvertImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;

class AdvertController extends Controller
{
    public function Add()
    {
        return view('Panel.Advert.Add');
    }

    public function Save(Request $request)
    {
         $slug = SlugService::createSlug(AdvertImage::class,'slug',$request->title);
        $destinationPath = "advert_images/$slug";
        if ($request->hasFile('poster')) {
            $Poster = $this->savePoster($request->file('poster'),'advert-'.$request->title,$destinationPath);
            $resize =  $this->image_resize(410,205,$Poster,$destinationPath);
            File::delete(public_path() . '/' . $Poster);
        } else {
            $resize = '';
        }

         $advert = new AdvertImage();
        $advert->title = $request->title;
        $advert->poster = $resize;
        $advert->save();
        
        toastr()->success('تبلیغ با موفقیت افزوده شد');
        return redirect()->route('Panel.AdvertList');
    }

     function list()
    {
        return view('Panel.Advert.List')->with('adverts', AdvertImage::all());
    }

    
    public function DeleteAdvert(Request $request)
    {
       
            $advert = AdvertImage::find($request->id);
            File::deleteDirectory(public_path("advert_images/$advert->slug/"));
            $advert->delete();
        


        toastr()->success('تبلیغ با موفقیت حذف شد');
        return back();
    }

    public function Edit(AdvertImage $advert)
    {
        return view('Panel.Advert.Add', ['advert' => $advert]);
    }

    public function SaveEdit(Request $request, AdvertImage $advert)
    {

        $destinationPath = "blogs";
        if ($request->hasFile('poster')) {
             File::deleteDirectory(public_path("advert_images/$advert->slug/"));
           $Poster = $this->savePoster($request->file('poster'),'advert-'.$request->title,$destinationPath);
            $resize =  $this->image_resize(410,205,$Poster,$destinationPath);
            File::delete(public_path() . '/' . $Poster);
        } else {
            $resize = $advert->poster;
        }

        $advert->title = $request->title;
        $advert->poster = $resize;
      
        $advert->update();



        toastr()->success('تبلیغ با موفقیت ویرایش شد');
        return redirect()->route('Panel.AdvertList');
    }

}
