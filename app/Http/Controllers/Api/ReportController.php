<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function monthlyTask(Request $request)
    {
        $monthName = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];
        $firstMonth = Carbon::createFromFormat('Y-m-d', $request->firstDate)->firstOfMonth();
        $endMonth = Carbon::createFromFormat('Y-m-d', $request->endDate)->endOfMonth();

        $data = [];

        if ($firstMonth->year == $endMonth->year) {
            for ($i = $firstMonth->month; $i <= $endMonth->month; $i++) {
                $data[] = [
                    "year" => $firstMonth->year,
                    "month" => $i,
                    "month_name" => $monthName[$i - 1]
                ];
            }
        } else {
            for ($i = $firstMonth->month; $i <= 12; $i++) {
                $data[] = [
                    "year" => $firstMonth->year,
                    "month" => $i,
                    "month_name" => $monthName[$i - 1]
                ];
            }

            for ($i = 1; $i <= $endMonth->month; $i++) {
                $data[] = [
                    "year" => $endMonth->year,
                    "month" => $i,
                    "month_name" => $monthName[$i - 1]
                ];
            }
        }

        //return [$firstMonth, $endMonth];
        // $task = DB::table('tasks')
        //     ->selectRaw('count(tasks.id) as total, month(tasks.created_at) as month, year(tasks.created_at) as year')
        //     ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
        //     ->join('divs', 'users.flag', '=', 'divs.id')
        //     ->join('projects', 'tasks.project_id', '=', 'projects.id')
        //     ->where('projects.deleted_at', '=', NULL)
        //     ->where('tasks.deleted_at', '=', NULL)
        //     ->when($request->division, function ($query) use ($request) {
        //         $query->where('divs.id', $request->division);
        //     })
        //     ->whereBetween('tasks.created_at', [$firstMonth, $endMonth])
        //     ->groupBy(DB::raw('Month(tasks.created_at), Year(tasks.created_at)'))
        //     //->whereRaw("MONTH(tasks.created_at) = ?", [$i])
        //     //->whereRaw("YEAR(tasks.created_at) = ?", [$year])
        // ;
        // return response()->json($task->get());

        // $data = [];
        for ($i = 0; $i < count($data); $i++) {
            $task = DB::table('tasks')
                ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
                ->join('divs', 'users.flag', '=', 'divs.id')
                ->join('projects', 'tasks.project_id', '=', 'projects.id')
                ->where('projects.deleted_at', '=', NULL)
                ->where('tasks.deleted_at', '=', NULL)
                ->when($request->division, function ($query) use ($request) {
                    $query->where('divs.id', $request->division);
                })

                ->whereRaw("MONTH(tasks.created_at) = ?", [$data[$i]['month']])
                ->whereRaw("YEAR(tasks.created_at) = ?", [$data[$i]['year']])
                ->count();
            // array_push($data, ["month" => $monthName[$i - 1], "total" => $task]);

            $data[$i]['total'] = $task;
        }

        return response()->json(["message" => "Succesfully", "data" => $data]);

        // $now = Carbon::now();
        // return $now->subMonths(2);
    }

    public function totalTask(Request $request)
    {
        $firstMonth = ($request->firstDate) ? Carbon::createFromFormat('Y-m-d', $request->firstDate)->firstOfMonth() : null;
        $endMonth = ($request->endDate) ? Carbon::createFromFormat('Y-m-d', $request->endDate)->endOfMonth() : null;
        return response()->json([
            "message" => "Succesfully",
            "data" => DB::table('tasks')
                ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
                ->join('divs', 'users.flag', '=', 'divs.id')
                ->join('projects', 'tasks.project_id', '=', 'projects.id')
                ->where('projects.deleted_at', '=', NULL)
                ->where('tasks.deleted_at', '=', NULL)
                ->when($request->division, function ($query) use ($request) {
                    $query->where('divs.id', $request->division);
                })
                ->when($request->firstDate && $request->endDate, function ($query) use ($firstMonth, $endMonth) {
                    $query->whereBetween('tasks.created_at', [$firstMonth, $endMonth]);
                })
                ->count()
        ]);
    }

    public function taskCompleted(Request $request)
    {
        $firstMonth = ($request->firstDate) ? Carbon::createFromFormat('Y-m-d', $request->firstDate)->firstOfMonth() : null;
        $endMonth = ($request->endDate) ? Carbon::createFromFormat('Y-m-d', $request->endDate)->endOfMonth() : null;
        return response()->json([
            "message" => "Succesfully",
            "data" => DB::table('tasks')
                ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
                ->join('divs', 'users.flag', '=', 'divs.id')
                ->join('projects', 'tasks.project_id', '=', 'projects.id')
                ->where('projects.deleted_at', '=', NULL)
                ->where('tasks.deleted_at', '=', NULL)
                ->where('tasks.status_id', '=', 7)
                ->when($request->division, function ($query) use ($request) {
                    $query->where('divs.id', $request->division);
                })
                ->when($request->firstDate && $request->endDate, function ($query) use ($firstMonth, $endMonth) {
                    $query->whereBetween('tasks.created_at', [$firstMonth, $endMonth]);
                })
                ->count()
        ]);
    }

    public function taskIncomplete(Request $request)
    {
        $firstMonth = ($request->firstDate) ? Carbon::createFromFormat('Y-m-d', $request->firstDate)->firstOfMonth() : null;
        $endMonth = ($request->endDate) ? Carbon::createFromFormat('Y-m-d', $request->endDate)->endOfMonth() : null;
        return response()->json([
            "message" => "Succesfully",
            "data" => DB::table('tasks')
                ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
                ->join('divs', 'users.flag', '=', 'divs.id')
                ->join('projects', 'tasks.project_id', '=', 'projects.id')
                ->where('projects.deleted_at', '=', NULL)
                ->where('tasks.deleted_at', '=', NULL)
                ->where('tasks.status_id', '<>', 7)
                ->when($request->division, function ($query) use ($request) {
                    $query->where('divs.id', $request->division);
                })
                ->when($request->firstDate && $request->endDate, function ($query) use ($firstMonth, $endMonth) {
                    $query->whereBetween('tasks.created_at', [$firstMonth, $endMonth]);
                })
                ->count()
        ]);
    }

    public function taskOverdue(Request $request)
    {
        $firstMonth = ($request->firstDate) ? Carbon::createFromFormat('Y-m-d', $request->firstDate)->firstOfMonth() : null;
        $endMonth = ($request->endDate) ? Carbon::createFromFormat('Y-m-d', $request->endDate)->endOfMonth() : null;
        return response()->json(
            [
                "message" => "Succesfully",
                "data" => DB::table('tasks')
                    ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
                    ->join('divs', 'users.flag', '=', 'divs.id')
                    ->join('projects', 'tasks.project_id', '=', 'projects.id')
                    ->where('projects.deleted_at', '=', NULL)
                    ->where('tasks.deleted_at', '=', NULL)
                    //->where('tasks.deadline', '<', Carbon::today())
                    ->where(function ($query) use ($firstMonth, $endMonth) {
                        // $query->when()
                        if ($firstMonth && $endMonth) {
                            $query->whereBetween('tasks.deadline', [$firstMonth, $endMonth]);
                        } else {
                            $query->where('tasks.deadline', '<', Carbon::today());
                        }
                    })
                    ->where('tasks.status_id', '!=', 7)
                    ->when($request->division, function ($query) use ($request) {
                        $query->where('divs.id', $request->division);
                    })
                    ->when($request->firstDate && $request->endDate, function ($query) use ($firstMonth, $endMonth) {
                        $query->whereBetween('tasks.created_at', [$firstMonth, $endMonth]);
                    })
                    ->count()
            ]
        );
    }

    public function totalProject(Request $request)
    {
        $firstMonth = ($request->firstDate) ? Carbon::createFromFormat('Y-m-d', $request->firstDate)->firstOfMonth() : null;
        $endMonth = ($request->endDate) ? Carbon::createFromFormat('Y-m-d', $request->endDate)->endOfMonth() : null;
        return response()->json(
            [
                "message" => "Succesfully",
                "data" => DB::table('projects')
                    ->join('users', 'projects.user_assigned_id', '=', 'users.id')
                    ->join('divs', 'users.flag', '=', 'divs.id')
                    ->where('projects.deleted_at', '=', NULL)
                    ->when($request->division, function ($query) use ($request) {
                        $query->where('divs.id', $request->division);
                    })
                    ->when($request->firstDate && $request->endDate, function ($query) use ($firstMonth, $endMonth) {
                        $query->whereBetween('projects.created_at', [$firstMonth, $endMonth]);
                    })
                    ->count()
            ]
        );
    }

    public function taskByDivision(Request $request)
    {
        $firstMonth = ($request->firstDate) ? Carbon::createFromFormat('Y-m-d', $request->firstDate)->firstOfMonth() : null;
        $endMonth = ($request->endDate) ? Carbon::createFromFormat('Y-m-d', $request->endDate)->endOfMonth() : null;

        $divisions = DB::table('divs')->where('id', "<>", 10)->get();
        $data = [];
        foreach ($divisions as $division) {
            $task = DB::table('tasks')
                ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
                ->join('divs', 'users.flag', '=', 'divs.id')
                ->join('projects', 'tasks.project_id', '=', 'projects.id')
                ->where('projects.deleted_at', '=', NULL)
                ->where('tasks.deleted_at', '=', NULL)
                ->where('divs.id', $division->id)
                ->when($request->firstDate && $request->endDate, function ($query) use ($firstMonth, $endMonth) {
                    $query->whereBetween('tasks.created_at', [$firstMonth, $endMonth]);
                })
                ->count();
            //$data[] = $division['division'];
            array_push($data, [
                "id" => $division->id,
                "division" => $division->division,
                "total" => $task
            ]);
        }

        return response()->json(["message" => "Succesfully", "data" => $data]);
    }
}
