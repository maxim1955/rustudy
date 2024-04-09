<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublicationFeedCollection;
use App\Http\Resources\PublicationResource;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends RestController
{
    public function index(Request $request){

        $publications = Publication::where('published', '=', '1')->orderByDesc('published_at')->paginate(10);

        return $this->sendResponse(new PublicationFeedCollection($publications));
    }

    public function show(Request $request,  int $id){

        $publication = Publication::find($id);

        if($publication == null){
            return $this->sendError("Новость не найдена", [], 404);
        }

        return PublicationResource::make($publication);
    }

}
