<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Api\RestController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityFeedCollection;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends RestController
{
    public function index(Request $request){

        $activities = Activity::orderByDesc('date')->paginate(10);

        return $this->sendResponse(new ActivityFeedCollection($activities));
    }

    public function show(Request $request,  int $id){

        $activity = Activity::find($id);

        if($activity == null){
            return $this->sendError("Мероприятие не найдено", [], 404);
        }

        return ActivityResource::make($activity);
    }
}