<?php

namespace App\Http\Controllers\Api;

use Illuminate\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\AddNewsRequest;
use App\Models\AddNews;
use App\Models\Publication;
use App\Models\Activity;
use App\Models\Event;

class AddNewsController extends RestController
{
    public function submit(Request $req) 
    {
        if ($req->news_type == "publication") {
            $img = $req->img;
            $title = $req->title;
            $brief = $req->shortDescr;
            $content = $req->descr;
            $author = $req->fio;
            Publication::insert([
                'img' => $img,
                'title' =>$title,
                'brief' => $brief,
                'content' => $content,
                'author' => $author
            ]);
            return $this->sendResponse(200);
        }
        else if ($req->news_type == "activity") {
            $img = $req->img;
            $title = $req->title;
            $brief = $req->shortDescr;
            $content = $req->descr;
            $author = $req->fio;
            Activity::insert([
                'img' => $img,
                'title' =>$title,
                'brief' => $brief,
                'content' => $content,
                'author' => $author
            ]);
            return $this->sendResponse(200);
        }
        else if ($req->news_type == "event") {
            $img = $req->img;
            $title = $req->title;
            $brief = $req->shortDescr;
            $description = $req->descr;
            // $author = $req->fio;
            Event::insert([
                'img' => $img,
                'title' =>$title,
                'brief' => $brief,
                'description' => $description,
                // 'author' => $author
            ]);
            return $this->sendResponse(200);
        }        
    }
}
