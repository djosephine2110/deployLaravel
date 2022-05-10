<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getDataProject = DB::table('projects')
            ->join('users', 'projects.user_assigned_id', '=', 'users.id')
            ->where('projects.deleted_at', '=', null)
            ->when(Auth::user()->user_flag == '1', function ($query) {
                return $query->where('projects.flag', '=', Auth::user()->flag);
            })
            ->when(Auth::user()->user_flag == '4', function ($query) {
                return $query->where('projects.user_assigned_id', '=', Auth::user()->id);
            })
            ->count();
        $getDataTask = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('tasks.deleted_at', '=', null)
            ->when(Auth::user()->user_flag == '1', function ($query) {
                return $query->where('tasks.flag', '=', Auth::user()->flag);
            })
            ->when(Auth::user()->user_flag == '4', function ($query) {
                return $query->where('tasks.user_assigned_id', '=', Auth::user()->id);
            })
            ->count();
        $getIncTask = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('tasks.deleted_at', '=', null)
            ->when(Auth::user()->user_flag == '1', function ($query) {
                return $query->where('tasks.flag', '=', Auth::user()->flag);
            })
            ->when(Auth::user()->user_flag == '4', function ($query) {
                return $query->where('tasks.user_assigned_id', '=', Auth::user()->id);
            })
            ->where('tasks.status_id', '!=', 7)
            ->count();
        $getCompTask = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('tasks.deleted_at', '=', null)
            ->when(Auth::user()->user_flag == '1', function ($query) {
                return $query->where('tasks.flag', '=', Auth::user()->flag);
            })
            ->when(Auth::user()->user_flag == '4', function ($query) {
                return $query->where('tasks.user_assigned_id', '=', Auth::user()->id);
            })
            ->where('tasks.status_id', '=', 7)
            ->count();
        $getOv = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('tasks.deleted_at', '=', null)
            ->when(Auth::user()->user_flag == '1', function ($query) {
                return $query->where('tasks.flag', '=', Auth::user()->flag);
            })
            ->when(Auth::user()->user_flag == '4', function ($query) {
                return $query->where('tasks.user_assigned_id', '=', Auth::user()->id);
            })
            ->where('tasks.deadline', '<', Carbon::today())
            ->where('tasks.status_id', '!=', 7)
            ->count();
        $getUserList = DB::table('users')->count();
        $getUser = DB::table('users')->get();
        $most = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('divs', 'users.flag', 'divs.id')
            ->where('tasks.deleted_at', null)
            ->when(Auth::user()->user_flag == '1', function ($query) {
                return $query->where('divs.id', '=', Auth::user()->flag);
            })
            ->when(Auth::user()->user_flag == '4', function ($query) {
                return $query->where('user_assigned_id', '=', Auth::user()->id);
            })
            ->select('users.name', 'users.image', 'users.email', 'tasks.created_at', 
                DB::raw("SUM(tasks.status_id = 7) as finish_tasks"), DB::raw("COUNT(tasks.deleted_at is NULL) as total_tasks"),
                DB::raw('SUM(tasks.status_id = 7) / COUNT(tasks.deleted_at is NULL)*100 as jml'))
            ->groupBy('tasks.user_assigned_id')
            ->orderByDesc('jml')
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
            if(strlen($value['month'])<2){
                $year[] = $value['year'].'-0'.$value['month'];
            }
            else{
                $year[] = $value['year'].'-'.$value['month'];
            }
        }

        $user = [];
        foreach ($year as $key => $value) {
            $user[] = DB::table('tasks')
                ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
                ->join('projects', 'tasks.project_id', '=', 'projects.id')
                ->where('tasks.deleted_at', '=', null)
                ->when(Auth::user()->user_flag == '1', function ($query) {
                    return $query->where('tasks.flag', '=', Auth::user()->flag);
                })
                ->when(Auth::user()->user_flag == '4', function ($query) {
                    return $query->where('tasks.user_assigned_id', '=', Auth::user()->id);
                })
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

        return view('welcome', $data, compact('getDataProject', 'getDataTask', 'getIncTask', 'getCompTask', 'getOv', 'getUserList', 'getUser', 'most'))->with('year', json_encode($year, JSON_NUMERIC_CHECK))->with('user', json_encode($user, JSON_NUMERIC_CHECK));
    }

}
