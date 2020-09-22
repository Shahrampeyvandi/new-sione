<?php

namespace App\Http\Controllers\Panel;

use App\Post;
use App\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CollectionController extends Controller
{
    public function Add()
    {
        return view('Panel.Collection.add');
    }

    function list()
    {
        return view('Panel.Collection.list')->with('collections', Collection::all());
    }

    public function Edit(Collection $Collection)
    {
        return view('Panel.Collection.add', ['collection' => $Collection]);
    }

    public function Save(Request $request, Collection $Collection)
    {

        $destinationPath = "files/collections";
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        if ($request->hasFile('poster')) {



            $Poster = $this->savePoster($request->file('poster'), 'collection_', $destinationPath);
            $resize = $this->image_resize(340, 191, $Poster, $destinationPath);
            File::delete(public_path() . '/' . $Poster);
        } else {
            $resize = '';
        }
        $check = Collection::where('name', $request->name)->first();
        if ($check) {
            $check->poster = $resize;
            $check->update();
        } else {

            $Collection = new Collection;
            $Collection->name = $request->name;
            $Collection->description = $request->desc;
            $Collection->poster = $resize;
            $Collection->for = $request->for;
            $Collection->save();
        }
        toastr()->success('مجموعه با موفقیت ثبت شد');
        return redirect()->route('Panel.CollectionList');
    }

    public function SaveEdit(Request $request, $id)
    {

        $Collection = Collection::whereId($id)->first();
        $destinationPath = "files/collections";


        if ($request->hasFile('poster')) {
            if (!File::exists("/$Collection->image")) {
                File::delete(public_path() . "/$Collection->poster");
            }
            $Poster = $this->savePoster($request->file('poster'), 'collection_', $destinationPath);

            $picPath = $this->image_resize(340, 191, $Poster, $destinationPath);
            File::delete(public_path() . '/' . $Poster);
        } else {
            $picPath = $Collection->poster;
        }

        $Collection->name = $request->name;
        $Collection->description = $request->desc;
        $Collection->poster = $picPath;
        $Collection->for = $request->for;

        $Collection->update();

        toastr()->success('مجموعه با موفقیت ویرایش شد');
        return redirect()->route('Panel.CollectionList');
    }


    public function Delete(Request $request)
    {

        $Collection = Collection::find($request->collection_id);

        File::delete(public_path() . '/' . $Collection->poster);
        $Collection->posts()->detach();
        $Collection->delete();

        toastr()->success('مجموعه با موفقیت حذف شد');
        return back();
    }
}
