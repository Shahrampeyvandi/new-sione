<?php

namespace App\Http\Controllers\Panel;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Image as ImageInvention;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function Add()
    {
        return view('Panel.Category.add');
    }

    function list()
    {
        return view('Panel.Category.list')->with('categories', Category::all());
    }

    public function Edit(Category $category)
    {
        return view('Panel.Category.add', ['category' => $category]);
    }

    public function Save(Request $request, Category $category)
    {


        $destinationPath = "files/categories";
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        if ($request->hasFile('poster')) {
     
                    $Poster = $this->savePoster($request->file('poster'), 'category_', $destinationPath);

            $resize = $this->image_resize(340, 191, $Poster, $destinationPath);
            File::delete(public_path() . '/' . $Poster);
        } else {
            $resize = '';
        }
        $check = Category::where('name',$request->name)->first();
        if($check){
            $check->image = $resize;
            $check->update();
        }else{

            $category = new Category;
            $category->name = $request->name;
            $category->latin = $request->latin;
            $category->image = $resize;
            $category->save();
        }
        toastr()->success('دسته بندی با موفقیت افزوده شد');
        return redirect()->route('Panel.CatList');
    }

    public function SaveEdit(Request $request, $id)
    {

        $category = Category::whereId($id)->first();
        $destinationPath = "files/categories";


        if ($request->hasFile('poster')) {
            
                File::delete(public_path() . "/$category->image");
            
           $Poster = $this->savePoster($request->file('poster'), 'category_', $destinationPath);

            $picPath = $this->image_resize(340, 191, $Poster, $destinationPath);
            File::delete(public_path() . '/' . $Poster);
        } else {
            $picPath = $category->image;
        }

        $category->name = $request->name;
        $category->latin = $request->latin;
        $category->image = $picPath;

        $category->update();

        toastr()->success('دسته بندی با موفقیت ویرایش شد');
        return redirect()->route('Panel.CatList');
    }

    
    public function Delete(Request $request)
    {

        $category = Category::find($request->category_id);

        File::delete(public_path() . '/' . $category->image);
        foreach (Post::all() as $key => $post) {
            $post->categories()->detach($category->id);
        }

        $category->delete();

        toastr()->success('دسته بندی با موفقیت حذف شد');
        return back();
    }
}
