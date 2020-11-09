<?php

namespace App\Http\Controllers\Panel;

use App\Blog;
use App\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class BlogController extends Controller
{
    public function Add()
    {
        return view('Panel.Blog.Add');
    }

    public function UploadImage()
    {
        if (request()->hasFile('upload')) {

            $tmpName = $_FILES['upload']['tmp_name'];

            $size = $_FILES['upload']['size'];
            $filePath = "blogs/images-content/" . date('d-m-Y-H-i-s');
            $filename = request()->file('upload')->getClientOriginalName();

            if (!file_exists($filePath)) {
                mkdir($filePath, 0755, true);
            }
            $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $type = $_GET['type'];
            $funcNum = isset($_GET['CKEditorFuncNum']) ? $_GET['CKEditorFuncNum'] : null;

            if ($type == 'image') {
                $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png');
            } else {
                //file
                $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png', 'pdf', 'doc', 'docx');
            }

            //contrinue only if file is allowed
            if (in_array($fileExtension, $allowedfileExtensions)) {

                if (request()->file('upload')->move(public_path($filePath), $filename)) {
                    // if (move_uploaded_file($tmpName, $filePath)) {
                    $file = "$filePath/$filename";
                    // $filePath = str_replace('../', 'http://filemanager.localhost/elfinder/', $filePath);
                    $data = ['uploaded' => 1, 'fileName' => $filename, 'url' => URL::to('/') . '/' . $file];

                    if ($type == 'file') {

                        return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$filePath','');</script>";
                    }
                } else {

                    $error = 'There has been an error, please contact support.';

                    if ($type == 'file') {
                        $message = $error;

                        return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$filePath', '$message');</script>";
                    }

                    $data = array('uploaded' => 0, 'error' => array('message' => $error));
                }
            } else {

                $error = 'The file type uploaded is not allowed.';

                if ($type == 'file') {
                    $funcNum = $_GET['CKEditorFuncNum'];
                    $message = $error;

                    return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$filePath', '$message');</script>";
                }

                $data = array('uploaded' => 0, 'error' => array('message' => $error));
            }

            //return response
            return json_encode($data);
        }
    }

    public function Save(Request $request)
    {

        $slug = SlugService::createSlug(Blog::class,'slug',$request->name);
        $destinationPath = "blogs/$slug";
        if ($request->hasFile('poster')) {
            $Poster = $this->savePoster($request->file('poster'),'blog-'.$request->name,$destinationPath);
        } else {
            $Poster = '';
        }

        
       $resize =  $this->image_resize(250,156,$Poster,$destinationPath);
       $banner =  $this->image_resize(1440,720,$Poster,$destinationPath);
        $blog = new Blog;
        $blog->title = $request->name;
        $blog->poster = serialize(['org'=>$Poster,'resize'=>$resize,'poster'=>$banner]);
        $blog->description = $request->desc ? $request->desc : '' ;
        $blog->views = 10;
        $blog->category_id = $request->category;
        $blog->save();

        if($request->video) {
              
            $picextension = $request->file('video')->getClientOriginalExtension();
            $fileName = 'video-' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $imagePath = $destinationPath . '/' . $fileName;
            $request->file('video')->move(public_path($destinationPath), $fileName);
            $url = "$destinationPath/$fileName";
        $blog->videos()->create([
                'url'  => $url,
            
            ]);
        }
           
        

        foreach ($request->link_name as $key => $name) {
            if (!is_null($name)) {
                $blog->links()->create([
                    'name' => $name,
                    'url' => $request->link_url[$key]
                ]);
            }
        }

        toastr()->success('بلاگ با موفقیت افزوده شد');
        return redirect()->route('Panel.BlogList');
    }

    function list()
    {
        return view('Panel.Blog.List')->with('blogs', Blog::all());
    }

    public function DeleteBlog(Request $request)
    {
      
            $blog = Blog::find($request->blog_id);
            File::deleteDirectory(public_path("blogs/$blog->slug/"));
            $blog->comments()->delete();
            $blog->videos()->delete();
            $blog->links()->delete();
            $blog->delete();
        


        toastr()->success('بلاگ با موفقیت حذف شد');
        return back();
    }

    public function Edit(Blog $blog)
    {
        return view('Panel.Blog.Add', ['blog' => $blog]);
    }

    public function SaveEdit(Request $request, Blog $blog)
    {

        $destinationPath = "blogs";
        if ($request->hasFile('poster')) {
            File::delete(public_path() . $blog->poster);
            $picextension = $request->file('poster')->getClientOriginalExtension();
            $fileName = $request->name .  '-poster_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $request->file('poster')->move($destinationPath, $fileName);
            $Poster = "$destinationPath/$fileName";
        } else {
            $Poster = $blog->poster;
        }

        $blog->title = $request->name;
        $blog->poster = $Poster;
        $blog->description = $request->desc;
        $blog->views = 10;
        $blog->category_id = $request->category;
       
        $blog->update();



       


        $blog->links()->delete();

        foreach ($request->link_name as $key => $name) {
            if (!is_null($name)) {
                $blog->links()->create([
                    'name' => $name,
                    'url' => $request->link_url[$key]
                ]);
            }
        }


        toastr()->success('بلاگ با موفقیت ویرایش شد');
        return redirect()->route('Panel.BlogList');
    }
}
