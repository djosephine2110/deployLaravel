<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SaController extends Controller
{
    public function index()
    {
        //Users
        $getDataProject = DB::table('projects')
            ->join('users', 'projects.user_assigned_id', '=', 'users.id')
            ->where('projects.deleted_at', '=', null)
            ->count();
        $getDataTask = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.deleted_at', '=', null)
            ->where('tasks.deleted_at', '=', null)
            ->count();
            dd($getDataTask);
        $getIncTask = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.deleted_at', '=', null)
            ->where('tasks.deleted_at', '=', null)
            ->where('tasks.status_id', '!=', 7)
            ->where('tasks.status_id', '!=', 1)
            ->where('tasks.status_id', '!=', 3)
            ->count();
        $getCompTask = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.deleted_at', '=', null)
            ->where('tasks.deleted_at', '=', null)
            ->where('tasks.status_id', '=', 7)
            ->count();
        $getOv = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.deleted_at', '=', null)
            ->where('tasks.deleted_at', '=', null)->where('tasks.deadline', '<', Carbon::today())->where('tasks.status_id', '!=', 7)->count();
        $getUserList = DB::table('users')->count();
        $getUser = DB::table('users')->get();
        $most = DB::table('tasks')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('divs', 'users.flag', 'divs.id')
            ->when(Auth::user()->user_flag != "2", function ($query) {
                return $query->where('divs.id', '=', Auth::user()->flag);
            })
            ->select('users.name', 'users.image', 'users.email', 'tasks.created_at')
            ->groupBy('users.id')
            ->orderByDesc('tasks.status_id')
            ->where('tasks.status_id', '7')
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
            if (strlen($value['month']) < 2) {
                $year[] = $value['year'] . '-0' . $value['month'];
            } else {
                $year[] = $value['year'] . '-' . $value['month'];
            }
        }
        $user = [];
        foreach ($year as $key => $value) {
            $user[] = DB::table('tasks')
                ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
                ->join('projects', 'tasks.project_id', '=', 'projects.id')
                ->where('projects.deleted_at', '=', NULL)
                ->where('tasks.deleted_at', '=', NULL)
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
        return view('sa', $data, compact('getDataProject', 'getDataTask', 'getIncTask', 'getCompTask', 'getOv', 'getUserList', 'getUser', 'most'))->with('year', json_encode($year, JSON_NUMERIC_CHECK))->with('user', json_encode($user, JSON_NUMERIC_CHECK));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
