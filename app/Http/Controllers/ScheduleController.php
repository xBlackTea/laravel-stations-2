<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\CarbonImmutable;

class ScheduleController extends Controller
{
    public function scheduleList()
    {
        $movies = Movie::has('schedules')->with('schedules')->get();
        return view('admin.schedules.listSchedules', ['movies' => $movies]);
    }

    public function showSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.schedules.showSchedule', ['schedule' => $schedule]);
    }

    public function createSchedule($movieId)
    {
        $movie = Movie::findOrFail($movieId);
        return view('admin.schedules.createSchedule', ['movie' => $movie]);
    }

    public function storeSchedule(Request $request, $movieId)
    {
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required|exists:movies,id',
            'start_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_date' => 'required|date_format:Y-m-d',
            'end_time_time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/movies/' . $movieId . '/schedules/create')
                ->withErrors($validator)
                ->withInput();
        }

        $startDate = '2022-01-01';
        $endDate = '2022-01-01';

        $startTimeString = $startDate . ' ' . $request->input('start_time_time') . ':00';
        $endTimeString = $endDate . ' ' . $request->input('end_time_time') . ':00';

        $startTime = CarbonImmutable::createFromFormat('Y-m-d H:i:s', $startTimeString, 'Asia/Tokyo');
        $endTime = CarbonImmutable::createFromFormat('Y-m-d H:i:s', $endTimeString, 'Asia/Tokyo');

        Schedule::create([
            'movie_id' => $movieId,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        return redirect('/admin/schedules')->with('success', 'スケジュールが作成されました。');
    }

    public function editSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.schedules.editSchedule', ['schedule' => $schedule]);
    }

    public function updateSchedule(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required|exists:movies,id',
            'start_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_date' => 'required|date_format:Y-m-d',
            'end_time_time' => 'required|date_format:H:i',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // 年月日を固定し、時間部分はリクエストから受け取る
        $startDate = '2022-01-01';
        $endDate = '2022-01-01';
    
        $startTimeString = $startDate . ' ' . $request->input('start_time_time') . ':00';
        $endTimeString = $endDate . ' ' . $request->input('end_time_time') . ':00';
    
        $startTime = CarbonImmutable::createFromFormat('Y-m-d H:i:s', $startTimeString, 'Asia/Tokyo');
        $endTime = CarbonImmutable::createFromFormat('Y-m-d H:i:s', $endTimeString, 'Asia/Tokyo');
    
        $schedule = Schedule::findOrFail($id);
        $schedule->movie_id = $request->input('movie_id');
        $schedule->start_time = $startTime;
        $schedule->end_time = $endTime;
        $schedule->save();
    
        return redirect('/admin/schedules/' . $id)->with('success', 'スケジュールが更新されました。');
    }

    public function destroySchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect('/admin/schedules')->with('success', 'スケジュールが削除されました。');
    }
}
