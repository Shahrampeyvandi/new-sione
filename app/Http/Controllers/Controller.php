<?php

namespace App\Http\Controllers;

use App\User;
use App\Actor;
use App\Image;
use App\Writer;
use App\Quality;
use App\Setting;
use App\Category;
use App\Director;
use App\Language;
use Carbon\Carbon;
use App\Notification;
use Illuminate\Http\Request;
use Image as ImageInvention;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Morilog\Jalali\Jalalian;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function convertDate($date)
    {

        $date_array = explode('/', $date);
        $year = $date_array[2];
        $month = $date_array[1];
        $day = $date_array[0];
        if (strlen($month) == 1) {
            $month = '0' . $month;
        }
        if (strlen($day) == 1) {
            $day = '0' . $day;
        }


        $new_date_array = array($year, $month, $day);
        $new_date_string = implode('/', $new_date_array);
        $carbon = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d', $new_date_string);

        return $carbon;
    }



    public function sendSMS($patterncode, $phone, $data)
    {

        // برای پیامک هنگام ثبت نام
        //$patterncode="g0mj7wtqv3";
        // $data = array("name" => "نام طرف", "username" => "یوزر نیم طرف","password"=>"پسورد طرف");
        //------------------------------
        // برای ارسال پیامک ثبت خرید اشتراک
        //$patterncode="97b8c9m9a5";
        //$data = array("name" => "نام طرف", "number" => "نام اشتراک");
        //-------------------------------
        // ویرایش اطلاعات پروفایل
        //$patterncode="nj36jd5q3c";
        //$data = array("name" => "نام طرف");
        //-------------------------------


        //$username = "khosravanihadi";
        //$password = 'Hk129837';
        $datas = array(
            "pattern_code" => $patterncode,
            "originator" => "+985000125475",
            "recipient" => '+98' . substr($phone, 1),
            "values" => $data
        );
        $url = "http://rest.ippanel.com/v1/messages/patterns/send";
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, json_encode($datas));
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: AccessKey E34dbA2knATnyD5dXlm3y1b5WzYT2dd8te2znaVWRgk='
        ));
        $response = curl_exec($handler);
    }

    public function SaveCaption(Request $request, $post, $destinationPath)
    {
        foreach ($request->captions as $key => $caption) {
            if (array_key_exists(1, $caption) &&   array_key_exists(2, $caption)  &&  !is_null($caption[1]) && !is_null($caption[2])) {
                $ext = 'vtt';
                // $ext = $caption[2]->getClientOriginalExtension();
                $fileName = 'vtt_' . date("Y-m-d") . '_' . time() . '.' . $ext;
                //---------
                $fileHandle = fopen($caption[2], 'r');
                if ($fileHandle) {
                    $lines = array();
                    while (($line = fgets($fileHandle, 8192)) !== false) $lines[] = $line;
                    if (!feof($fileHandle)) exit("Error: unexpected fgets() fail\n");
                    else ($fileHandle);
                }
                $length = count($lines);
                for ($index = 1; $index < $length; $index++) {
                    if ($index === 1 || trim($lines[$index - 2]) === '') {
                        $lines[$index] = str_replace(',', '.', $lines[$index]);
                    }
                }
                for ($index = 0; $index < $length; $index++) {
                    $ttttt = trim($lines[$index]);
                    if (ctype_digit($ttttt)) {
                        echo 'n= ' . $index . ' is=' . $lines[$index] . '</br>';
                        $lines[$index] = '';
                    }
                }
                $header = "WEBVTT\n\n";
                $vttPath = "$destinationPath/$fileName";
                file_put_contents($vttPath, $header . implode('', $lines));
                //----------
                //$caption[2]->move(public_path($destinationPath), $fileName);
                // $vttPath = "$destinationPath/$fileName";
                $post->captions()->create([
                    'url' => $vttPath,
                    'lang' => $caption[1]
                ]);
            }
        }
    }

    public  function url_get_contents($Url)
    {
        if (!function_exists('curl_init')) {
            die('CURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }


    public function sendNoty($user, $plan = null)
    {
        //$query = DB::table('user_plan')->where('user_id', '=', $user->id)->where('plan_id', '=', $plan->id)->first();
        if (!is_null($plan)) {
            $content = 'اشتراک ' . $plan->name . ' تا تاریخ ' . Jalalian::forge($user->expire_date)->format('%d/%m/%Y') . ' برای شما فعال میباشد';
            $noty = new Notification;
            $noty->content = $content;
            $noty->reciver_id = $user->id;
            $noty->save();
        }
    }


    public function serialize_poster(Request $request, $file, $destinationPath)
    {
        if ($file) {
            $Poster =  $this->SavePoster($request->file('poster'), 'poster_', $destinationPath);
            $resize = $this->image_resize(268, 398, $Poster, $destinationPath);
            $banner = $this->image_resize(536, 796, $Poster, $destinationPath);
            return serialize(['org' => $Poster, 'resize' => $resize, 'banner' => $banner]);
        } else {
            if (isset($request->imdbposter) && $request->imdbposter) {
                $img = $destinationPath . '/poster_' . basename($request->imdbposter);
                $get_content = $this->url_get_contents($request->imdbposter);
                file_put_contents($img, $get_content);
                $Poster = $img;
                $resize = $this->image_resize(268, 398, $Poster, $destinationPath);
                $banner = $this->image_resize(536, 796, $Poster, $destinationPath);
                return serialize(['org' => $Poster, 'resize' => $resize, 'banner' => $banner]);
            } else {
                $setting = Setting::first();
                if ($setting) {

                    $Poster = $setting->default_poster;
                } else {
                    $Poster = '';
                }
                $resize = $this->image_resize(268, 398, $Poster, $destinationPath);
                $banner = $this->image_resize(536, 796, $Poster, $destinationPath);
                return serialize(['org' => $Poster, 'resize' => $resize, 'banner' => $banner]);
            }
        }
    }

    public function deletePosters($post)
    {
        $array = unserialize($post->poster);
        foreach ($array as $key => $poster) {
            File::delete(public_path() . '/' . $poster);
        }
    }

    public function saveData(Request $request, $destinationPath, $post)
    {
        $post->imdbID = $request->imdbID;
        $post->imdbRating = $request->imdbRating;
        $post->imdbVotes = $request->imdbVotes;
        $post->post_status = $request->serie_status;
        if (isset($request->first_release) && $request->first_release !== 'N/A') {

            $post->first_publish_date = Carbon::parse($request->first_release)->toDateTimeString();
        }
        if (isset($request->last_release) && $request->last_release !== 'N/A') {

            $post->last_publish_date = Carbon::parse($request->last_release)->toDateTimeString();
        }
        if (isset($request->released) && $request->released !== 'N/A') {

            $post->released = Carbon::parse($request->released)->toDateTimeString();
        }

        if ($request->comming && $request->comming == 'yes') {
            $post->publish_status = 1;
        } else {
            $post->publish_status = 0;
        }
        if ($request->comming_soon && $request->comming_soon == '1') {
            $post->comming_soon = 1;
        } else {
            $post->comming_soon = 0;
        }
        if (isset($request->age)) {
            $post->age_rate = $request->age;
        }
        if (isset($request->top250)) {
            $post->top_250 = $request->top250;
        }
        $post->update();


        $this->upload_images($request, $destinationPath, $post);

        if (isset($request->trailer)) {
            $post->trailer()->create([
                'name' => $post->name,
                'poster' => '',
                'url' => $request->trailer
            ]);
        }

        if (isset($request->categories)) {
            foreach ($request->categories as $key => $category) {
                if ($id = Category::check($category)) {
                    $post->categories()->attach($id);
                }
            }
        }

        if (isset($request->collections)) {
            foreach ($request->collections as $key => $collection) {
                $post->collections()->attach($collection);
            }
        }


        if (isset($request->actors)) {
            foreach ($request->actors as $key => $actor) {
                if ($id = Actor::check($actor)) {
                    $post->actors()->attach($id);
                } else {

                    $post->actors()->create(['name' => $actor]);
                }
            }
        }
        if (isset($request->directors)) {
            foreach ($request->directors as $key => $director) {
                if ($id = Director::check($director)) {
                    $post->directors()->attach($id);
                } else {
                    $post->directors()->create(['name' => $director]);
                }
            }
        }
        if (isset($request->writers)) {
            foreach ($request->writers as $key => $writer) {
                if ($id = Writer::check($writer)) {
                    $post->writers()->attach($id);
                } else {
                    $post->writers()->create(['name' => $writer]);
                }
            }
        }
        if (isset($request->languages)) {
            foreach ($request->languages as $key => $language) {
                if ($id = Language::check($language)) {
                    $post->languages()->attach($id);
                } else {
                    $post->languages()->create(['name' => $language]);
                }
            }
        }


        //http://dl.sione.live/movies/2015/1We.Are.Your.Friends.2015.720p.BluRay.Film2Movie_INFO.mp4

        if (isset($request->file)) {
            foreach ($request->file as $key => $file) {
                if (array_key_exists(1, $file)) {
                    if ($id = Quality::check($file[2])) {
                        $quality_id = $id;
                    } else {
                        $quality = Quality::create(['name' => $file[2]]);
                        $quality_id = $quality->id;
                    }
                    $video = $post->videos()->create([
                        'url' => $file[1],
                        'quality_id' => $quality_id
                    ]);
                }
            }
        }

        if (isset($request->captions)) {

            $this->SaveCaption($request, $post, $destinationPath);
        }
    }

    public function editData(Request $request, $destinationPath, $post)
    {
        $post->post_status = $request->serie_status;
        if ($request->comming_soon && $request->comming_soon == '1') {
            $post->comming_soon = 1;
        } else {
            $post->comming_soon = 0;
        }
        if ($request->comming && $request->comming == 'yes') {
            $post->publish_status = 1;
        } else {
            $post->publish_status = 0;
        }
        if (isset($request->age)) {
            $post->age_rate = $request->age;
        }
        $post->update();



        if ($request->has('imdbImages')) {
            $array_images = $post->images()->pluck('url');
            foreach ($array_images as $image) {
                if (!in_array($image, $request->imdbImages)) {
                    File::delete(public_path($image));
                    $image = Image::where('url', $image)->delete();
                }
            }
        }

        $this->upload_images($request, $destinationPath, $post);


        if (isset($request->trailer)) {
            if ($post->trailer) {
                $post->trailer()->update([
                    'name' => $post->name,
                    'poster' => '',
                    'url' => $request->trailer
                ]);
            } else {
                $post->trailer()->create([
                    'name' => $post->name,
                    'poster' => '',
                    'url' => $request->trailer
                ]);
            }
        }



        $post->categories()->detach();
        if (isset($request->categories)) {
            foreach ($request->categories as $key => $category) {
                if ($post->categories()->pluck('latin')->contains($category)) {
                    continue;
                }

                if ($id = Category::check($category)) {
                    $post->categories()->attach($id);
                }
            }
        }

        $post->collections()->detach();
        if (isset($request->collections)) {
            foreach ($request->collections as $key => $collection) {
                $post->collections()->attach($collection);
            }
        }


        foreach ($request->actors as $key => $actor) {
            if ($post->actors()->pluck('name')->contains($actor)) {
                continue;
            }
            if ($id = Actor::check($actor)) {
                $post->actors()->attach($id);
            } else {

                $post->actors()->create(['name' => $actor]);
            }
        }

        if (isset($request->directors)) {
            foreach ($request->directors as $key => $director) {
                if ($post->directors()->pluck('name')->contains($director)) {
                    continue;
                }
                if ($id = Director::check($director)) {
                    $post->directors()->attach($id);
                } else {

                    $post->directors()->create(['name' => $director]);
                }
            }
        }

        if (isset($request->writers)) {
            foreach ($request->writers as $key => $writer) {
                if ($post->writers()->pluck('name')->contains($writer)) {
                    continue;
                }
                if ($id = Writer::check($writer)) {
                    $post->writers()->attach($id);
                } else {
                    $post->writers()->create(['name' => $writer]);
                }
            }
        }

        if (isset($request->languages)) {
            foreach ($request->languages as $key => $language) {
                if ($post->languages()->pluck('name')->contains($language)) {
                    continue;
                }
                if ($id = Language::check($language)) {
                    $post->languages()->attach($id);
                } else {
                    $post->languages()->create(['name' => $language]);
                }
            }
        }


        if ($post->type == 'movies') {
            $videos = $post->videos();
            $videos->delete();
            if (isset($request->file)) {
                foreach ($request->file as $key => $file) {
                    if ($file[1] !== null) {
                        if ($id = Quality::check($file[2])) {
                            $quality_id = $id;
                        } else {
                            $quality = Quality::create(['name' => $file[2]]);
                            $quality_id = $quality->id;
                        }
                        $video = $post->videos()->create([
                            'url' => $file[1],
                            'quality_id' => $quality_id
                        ]);
                    }
                }
            }

            if (isset($request->captions)) {
                $this->SaveCaption($request, $post, $destinationPath);
            }
        }
    }


    public function SavePoster($file, $name, $destinationPath)
    {

        if ($file) {
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true);
            }
            $picextension = $file->getClientOriginalExtension();
            $fileName = $name . date("Y-m-d") . '_' . uniqid() . '.' . $picextension;
            $imagePath = $destinationPath . '/' . $fileName;
            $file->move(public_path($destinationPath), $fileName);

            return "$destinationPath/$fileName";
        } else {
            return '';
        }
    }
    public function image_resize($width, $height, $poster, $destinationPath)
    {

        if ($poster !== '') {
            // dd([$file,$size,$destinationPath]);
            $picextension = pathinfo($poster, PATHINFO_EXTENSION);
            $fileName = $width . 'x' . $height . '-' . date("Y-m-d") . '_' . uniqid() . '.' . $picextension;
            $imagePath = $destinationPath . '/' . $fileName;
            $imgs = ImageInvention::make($poster)->resize($width, $height)->save($imagePath);
            return $imagePath;
        }
    }



    public function upload_images(Request $request, $destinationPath, $post)
    {


        if ($request->has('images')) {
            if (!File::exists($destinationPath . "/images")) {
                File::makeDirectory($destinationPath . "/images", 0777, true);
            }
            foreach ($request->images as $key => $image) {
                if (is_uploaded_file($image)) {
                    $picextension = $image->getClientOriginalExtension();
                    $fileName = 'image_' . date("Y-m-d") . '_' . uniqid() . $key . '.' . $picextension;
                    $imageUrl = $this->SavePoster($image, 'image_', $destinationPath . "/images");

                    list($width, $height) = getimagesize(public_path($imageUrl));
                    if ($width > $height) {
                        // Landscape
                        $resize = ImageInvention::make($imageUrl)->resize(350, 250)->save($imageUrl);
                    } else {
                        // Portrait or Square
                        $resize = ImageInvention::make($imageUrl)->resize(250, 350)->save($imageUrl);
                    }

                    $post->images()->create([
                        'url' => $imageUrl,
                    ]);
                } else {
                    $img = $destinationPath . "/images/" . basename($image);
                    file_put_contents($img, $this->url_get_contents($image));

                    list($width, $height) = getimagesize(public_path($img));

                    if ($width > $height) {
                        // Landscape
                        $resize = ImageInvention::make($img)->resize(350, 250)->save($img);
                    } else {
                        // Portrait or Square
                        $resize = ImageInvention::make($img)->resize(250, 350)->save($img);
                    }



                    $post->images()->create([
                        'url' => $img,
                    ]);
                }
            }
        }
    }
}
