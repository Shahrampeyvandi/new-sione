<?php

namespace App\Http\Controllers\Panel;

use App\Actor;
use App\Writer;
use App\Director;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ActorsController extends Controller
{
    public function List()
    {
        $actors = Actor::orderBy('name', 'asc')->get();
        $directors = Director::orderBy('name', 'asc')->get();
        $writers = Writer::orderBy('name', 'asc')->get();
        $all = $actors->concat($directors);
        $alll = $all->concat($writers);



        return view('Panel.Actors.Lists', ['users' => $alll]);
    }
    public function Edit($id)
    {

        if (request()->type == 'actor') {
            $user = Actor::find($id);
        }

        if (request()->type == 'director') {
            $user = Director::find($id);
        }
        if (request()->type == 'writer') {
            $user = Writer::find($id);
        }
        return view('Panel.Actors.Edit', ['artist' => $user, 'type' => request()->type]);
    }

    public function SaveEdit(Request $request, $id)
    {

        if (request()->type == 'actor') {
            $model = Actor::find($id);
            $destinationPath = 'actors';
        }

        if (request()->type == 'director') {
            $model = Director::find($id);
            $destinationPath = 'directors';
        }
        if (request()->type == 'writer') {
            $model = Writer::find($id);
            $destinationPath = 'writers';
        }

        if ($request->hasFile('poster')) {

            $poster = $this->SavePoster($request->file('poster'), Str::slug($model->name), $destinationPath);
            $resize = $this->image_resize(250, 300, $poster, $destinationPath);
            File::delete(public_path() . '/' . $poster);
            File::delete(public_path() . '/' . $model->image);
            $model->image = $resize;
        }
        $model->name = $request->name;
        $model->fa_name = $request->fa_name;
        $model->bio = $request->bio;
        $model->update();


        toastr()->success('هنرمند با موفقیت ویرایش شد');
        return redirect()->route('Panel.ActorsList');
    }

    public function Save(Request $request)
    {
        if (request()->type == 'actor') {
            $model = new Actor;
            $destinationPath = 'actors';
        }
        if (request()->type == 'director') {
            $model = new Director;
            $destinationPath = 'directors';
        }
        if (request()->type == 'writer') {
            $model = new Writer;
            $destinationPath = 'writers';
        }
        if ($request->hasFile('poster')) {
            $poster = $this->SavePoster($request->file('poster'), Str::slug($request->name), $destinationPath);
            $resize = $this->image_resize(250, 300, $poster,$destinationPath);
            File::delete(public_path() . '/' . $poster);
        } else {
            $resize = '';
        }

        $model->name = $request->name;
        $model->fa_name = $request->fa_name;
        $model->bio = $request->bio;
        $model->image = $resize;
        $model->save();





        toastr()->success('هنرمند با موفقیت ویرایش شد');
        return back();
    }

    private function upload($destinationPath)
    {
        if (request()->hasFile('picture')) {
            $picextension = request()->file('picture')->getClientOriginalExtension();
            $fileName = 'picture' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            request()->file('picture')->move($destinationPath, $fileName);
            return "$destinationPath/$fileName";
        } else {
            return '';
        }
    }
    public function Insert(Request $request)
    {
        if ($request->type == "actor") {
            $destinationPath = "actors";

            $image = $this->upload($destinationPath);

            Actor::create([
                'name' => $request->fullname,
                'image' => $image,
                'bio' => $request->description,
            ]);
        }

        if ($request->type == "writer") {
            $destinationPath = "writers";

            $image = $this->upload($destinationPath);
            Writer::create([
                'name' => $request->fullname,
                'image' => $image,
                'bio' => $request->description,
            ]);
        }
        if ($request->type == "creator") {
            $destinationPath = "directors";

            $image = $this->upload($destinationPath);
            Director::create([
                'name' => $request->fullname,
                'image' => $image,
                'bio' => $request->description,
            ]);
        }

        return back();
    }

    public function GetActorAjax(Request $request)
    {

        $actors = Actor::where("name", "like", "%" . $request->val . "%")->get();
        $list = '';
        foreach ($actors as $key => $actor) {
            $list .= '<li><a href="#" onclick="addToInput(event)">' . $actor->name . '</a></li>';
        }

        return $list;
    }
    public function GetDirectorAjax(Request $request)
    {

        $actors = Director::where("name", "like", "%" . $request->val . "%")->get();
        $list = '';
        foreach ($actors as $key => $actor) {
            $list .= '<li><a href="#" onclick="addToInput(event)">' . $actor->name . '</a></li>';
        }

        return $list;
    }

    public function Delete(Request $request)
    {
        if ($request->type == "actor") {
            $destinationPath = "actors";
            $model = Actor::find($request->id);
        }
        if ($request->type == "writer") {
            $destinationPath = "writers";
            $model = Writer::find($request->id);
        }
        if ($request->type == "director") {
            $destinationPath = "directors";
            $model = Director::find($request->id);
        }
        File::delete(public_path() . '/' . $model->image);

        $model->delete();
        return back();
    }
}
