<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function index()
    {
        $getDataProject = DB::table('projects')
        ->join('users', 'projects.user_assigned_id', '=', 'users.id')
        ->where('projects.deleted_at', '=', null)
        ->where('projects.flag', '=', Auth::user()->flag)
        ->count();
        $getDataTask = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.deleted_at', '=', null)
            ->where('tasks.deleted_at', '=', null)
            ->where('tasks.flag', '=', Auth::user()->flag)
            ->count();
        $getIncTask = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.deleted_at', '=', null)
            ->where('tasks.deleted_at', '=', null)
            ->where('tasks.flag', '=', Auth::user()->flag)
            ->where('tasks.status_id', '!=', 7)
            ->count();
        $getCompTask = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.deleted_at', '=', null)
            ->where('tasks.deleted_at', '=', null)
            ->where('tasks.flag', '=', Auth::user()->flag)
            ->where('tasks.status_id', '=', 7)
            ->count();
        $getOv = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.deleted_at', '=', null)
            ->where('tasks.deleted_at', '=', null)
            ->where('tasks.flag', '=', Auth::user()->flag)
            ->where('tasks.deadline', '<', Carbon::today())
            ->where('tasks.status_id', '!=', 7)
            ->count();
        $getUserList = DB::table('users')->count();
        $getUser = DB::table('users')->get();
        $most = DB::table('activities')
        ->join('users', 'activities.causer_id', '=', 'users.id')
        ->select('users.name', 'users.image', 'users.email', 'activities.created_at')->distinct()
        ->paginate(5);
        
        $period = now()->subMonths(12)->monthsUntil(now());
        $data = [];
        foreach ($period as $date) {
            $data[] = [
                'month' => $date->month,
                'year' => $date->year,
            ];
        }
        foreach ($data as $key => $value) {
            if (strlen($value['month'])<2) {
                $year[] = $value['year'].'-0'.$value['month'];
            } else {
                $year[] = $value['year'].'-'.$value['month'];
            }
        }

        $user = [];
        foreach ($year as $key => $value) {
            $user[] = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.deleted_at', '=', null)
            ->where('tasks.deleted_at', '=', null)
            ->where('tasks.flag', '=', Auth::user()->flag)
            ->where(DB::raw("DATE_FORMAT(tasks.created_at, '%Y-%m')"), $value)
            ->count();
        }

        $record = DB::table('tasks')
        ->select(DB::raw("COUNT(*) as count"), DB::raw("flag as day_name"), 'divs.division')
        ->join('divs', 'tasks.flag', '=', 'divs.id')
        ->groupBy('day_name')
        ->get();
  
        $data = [];
 
        foreach ($record as $row) {
            $data['division'][] = $row->division;
            $data['data'][] = (int) $row->count;
        }
 
        $data['chart_data'] = json_encode($data);
    
        return view('chart', $data, compact('getDataProject', 'getDataTask', 'getIncTask', 'getCompTask', 'getOv', 'getUserList', 'getUser', 'most'))->with('year', json_encode($year, JSON_NUMERIC_CHECK))->with('user', json_encode($user, JSON_NUMERIC_CHECK));
    }

}
