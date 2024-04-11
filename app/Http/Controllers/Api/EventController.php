<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Api\RestController;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends RestController
{
    public function index(Request $request){

        $events = Event::orderByDesc('date')->paginate(10);

        return $this->sendResponse(new EventCollection($events));
    }

    public function show(Request $request,  int $id){

        $event = Event::find($id);

        if($event == null){
            return $this->sendError("Мероприятие не найдено", [], 404);
        }

        return EventResource::make($event);
    }
}
