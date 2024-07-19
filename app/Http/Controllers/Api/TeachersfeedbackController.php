<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Api\RestController;
use App\Http\Controllers\Controller;
// use App\Http\Resources\TeachersfeedbackFeedCollection;
use App\Http\Resources\TeachersfeedbackResource;
use App\Models\Teachersfeedback;
use Illuminate\Http\Request;

class TeachersfeedbackController extends RestController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){

        $teachersfeedbacks = Teachersfeedback::all();
        return $this->sendResponse(TeachersfeedbackResource::collection($teachersfeedbacks));
    }

    public function show(Request $request,  int $id){

        $teachersfeedback = Teachersfeedback::find($id);

        if($teachersfeedback == null){
            return $this->sendError("Отзыв не найден", [], 404);
        }

        return TeachersfeedbackResource::make($teachersfeedback);
    }

    
}
