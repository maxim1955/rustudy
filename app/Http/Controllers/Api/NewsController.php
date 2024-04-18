<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Activity;
use App\Models\Publication;
use App\Models\News;
use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;

class NewsController extends RestController
{
    public function index(Request $request)
    {

        // Выборка публикаций
        $publications = Publication::select('id', 'img', 'title', 'brief', 'created_at as date')
            ->selectRaw("'publication' as type")
            ->orderBy('date', 'desc');

        // Выборка событий
        $events = Event::select('id', 'img', 'title', 'brief', 'created_at as date')
            ->selectRaw("'event' as type")
            ->orderBy('date', 'desc');

        // Выборка активностей
        $activities = Activity::select('id', 'img', 'title', 'brief', 'created_at as date')
            ->selectRaw("'activity' as type")
            ->orderBy('date', 'desc');

        // Объединяем все выборки
        $news = $publications->union($events)->union($activities)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return $this->sendResponse(new NewsCollection($news));
    }
}
