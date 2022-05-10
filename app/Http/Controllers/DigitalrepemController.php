<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\ReportExport;

class DigitalrepemController extends Controller
{
    public function __construct(){
        $this->middleware(function($request, $next){
            $this->roleGlob = Auth::user();
            $this->fromDate = $request->input('from');
            $this->toDate = $request->input('to');
            $this->ordDate = $request->input('reqDate');
            $this->countries = DB::table('projects')->get();
            $this->states = DB::table('tasks')->where('project_id', $request->country_id)->get();
            $this->product = DB::table('tasks')
                ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
                ->where('tasks.deleted_at', '=', null)
                ->join('projects', 'tasks.project_id', '=', 'projects.id')
                ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
                ->join('divs', 'tasks.flag', '=', 'divs.id')
                ->select('statuses.title as jo', 
                        'projects.title as pt', 
                        'tasks.project_id', 
                        'tasks.id', 
                        'tasks.title as tt', 
                        'users.name as ui', 
                        'tasks.created_at', 
                        'tasks.status_id', 
                        'tasks.updated_at', 
                        'tasks.created_at', 
                        DB::raw('TIMESTAMPDIFF(HOUR, tasks.created_at, tasks.updated_at) AS timediff'))
                ->when(Auth::user()->user_flag != "2", function ($query) {
                    return $query->where('tasks.flag', '=', Auth::user()->flag);
                })
                ->where('projects.deleted_at', '=', null)
                ->where('users.deleted_at', '=', null)
                ->where(function ($query) use ($request) {
                    return $request->price_id ? $query->from('tasks')->where('tasks.status_id', $request->price_id) : '';
                })
                ->where(function ($query) use ($request) {
                    return $request->divs_id ? $query->from('divs')->where('divs.id', $request->divs_id) : '';
                })
                ->where(function ($query) use ($request) {
                    return $request->name_id ? $query->from('users')->where('users.id', $request->name_id) : '';
                })
                ->where(function ($query) use ($request) {
                    return $request->from ? $query->from('tasks')
                    ->whereBetween($this->ordDate, [$request->from . ' 00:00:00', $request->to . ' 23:59:59']) : '';
                })
                ->get();
            $this->price_id = $request->price_id;
            $this->name_id = $request->name_id;
            $this->divs_id = $request->divs_id;
            $this->startDate = Carbon::today()->toDateString();
            return $next($request);
        });
    }

    public function filter(Request $request)
    {
        switch ($request->input('action')) {
            case 'print':
                return $this->printExcel();
                break;
            case 'filter':
                return $this->test($request);
                break;
        }
    }

    public function test(Request $request)
    {
        $product = $this->product;
        $startDate = $this->startDate;
        $countries = $this->countries;
        $price_id = $this->price_id;
        $divs_id = $this->divs_id;
        $name_id = $this->name_id;
        $fromDate = $this->fromDate;
        $toDate = $this->toDate;
        $ordDate = $this->ordDate;
        return view('digitalrepem', compact('product', 'startDate', 'countries', 'price_id', 'name_id', 'divs_id', 'fromDate', 'toDate', 'ordDate'));
    }

    public function overdue(Request $request)
    {
        $product = DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.flag', '=', auth()->user()->flag)
            ->where('projects.deleted_at', '=', null)
            ->where('tasks.deleted_at', '=', null)
            ->where('tasks.flag', '=', auth()->user()->flag)
            ->where(function ($query) use ($request) {
                return $request->from ?
                    $query->from('tasks')->whereBetween('deadline', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']) : '';
            })
            ->select('tasks.*')
            ->get();
        $selected_id = [];
        $selected_id['deadline'] = $request->from;
        $selected_id['deadline'] = $request->to;
        return view('overdue', compact('product', 'selected_id'));
    }

    public function employee()
    {
        $product = $this->product;
        $startDate = $this->startDate;
        $countries = $this->countries;
        $price_id = $this->price_id;
        $name_id = $this->name_id;
        return view('digitalrepem', compact('product', 'startDate', 'countries', 'price_id', 'name_id'));
    }

    public function printExcel()
    {
        return \Excel::download(new ReportExport, 'exportduration.xls');
    }

}