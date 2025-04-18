<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use App\Http\Resources\ScheduleResource;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $now = now();
        $schedules = Schedule::whereDate('date', '>=', $now->toDateString())
            ->where(function($query) use ($now) {
                $query->whereDate('date', '>', $now->toDateString())
                      ->orWhere(function($query) use ($now) {
                          $query->whereDate('date', $now->toDateString())
                                ->whereTime('time_from', '>', $now->toTimeString());
                      });
            })
            ->with(['movie', 'hall'])
            ->paginate(10);
    
        return ScheduleResource::collection($schedules);
    }
}
