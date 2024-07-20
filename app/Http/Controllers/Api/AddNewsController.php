<?php

namespace App\Http\Controllers\Api;

use Illuminate\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\AddNewsRequest;
use App\Models\AddNews;
use App\Models\Publication;
use App\Models\Activity;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class AddNewsController extends RestController
{
    private function storeImage($base64Image)
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            $data = substr($base64Image, strpos($base64Image, ',') + 1);
            $type = strtolower($type[1]);
            if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                return ['error' => 'Invalid image type'];
            }
            $data = base64_decode($data);
            if ($data === false) {
                return ['error' => 'Base64 decode failed'];
            }

            $fileName = uniqid() . '.' . $type;
            $path = 'images/' . $fileName;
            Storage::disk('public')->put($path, $data);
            return ['path' => $path];
        } else {
            return ['error' => 'Did not match data URI scheme'];
        }
    }
    public function submit(Request $req)
    {
        $path = null;
        $img = null;
        $imageResult = null;
        if ($req->has('img')) {
            $img = $req->img; // Получаем изображение
            $imageResult = $this->storeImage($img); // Сохраняем изображение и получаем путь
            if (isset($imageResult['error'])) {
                return $this->sendResponse(400, $imageResult['error']);
            }
            $path = $imageResult['path']; // Получаем путь к изображению
        }
        if ($req->news_type == "publication") {
            $title = $req->title;
            $brief = $req->shortDescr;
            $content = $req->descr;
            $author = $req->fio;
            Publication::insert([
                'type_id'=> 1,
                'img' => $path,
                'title' =>$title,
                'brief' => $brief,
                'content' => $content,
                'author' => $author
            ]);
            return $this->sendResponse(200);
        }
        else if ($req->news_type == "activity") {
            $title = $req->title;
            $brief = $req->shortDescr;
            $content = $req->descr;
            $author = $req->fio;
            Activity::insert([
                'img' => $path,
                'title' =>$title,
                'brief' => $brief,
                'content' => $content,
                'author' => $author
            ]);
            return $this->sendResponse(200);
        }
        else if ($req->news_type == "event") {
            $title = $req->title;
            $brief = $req->shortDescr;
            $description = $req->descr;
            // $author = $req->fio;
            Event::insert([
                'img' => $path,
                'title' =>$title,
                'brief' => $brief,
                'description' => $description,
                'date' =>'2024-04-27'
            ]);
            return $this->sendResponse(200);
        }
    }
}
