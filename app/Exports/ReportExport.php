<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

use DB;

class ReportExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    public function collection()
    {
        $startDate = request()->input('from');
        $endDate   = request()->input('to') ;
        $status = request()->input('price_id');
        $name = request()->input('name_id');
        $divs = request()->input('divs_id');
        $getTaskReport = DB::table('tasks')
            ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
            ->where('tasks.deleted_at', '=', null)
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->join('divs', 'tasks.flag', '=', 'divs.id')
            ->select(
                'statuses.title as taskStatus',
                'projects.title as projectTitle',
                'tasks.project_id',
                'tasks.id',
                'tasks.title as taskTitle',
                'users.name as userName',
                'tasks.status_id',
                'tasks.updated_at as taskUpdated',
                'tasks.created_at as taskCreated',
                DB::raw('TIMESTAMPDIFF(HOUR, tasks.created_at, tasks.updated_at) AS duration')
            )
            ->where('projects.deleted_at', '=', null)
            ->where(function ($query) use ($status) {
                return $status ? $query->from('tasks')->where('tasks.status_id', $status) : '';
            })
            ->where(function ($query) use ($divs) {
                return $divs ? $query->from('divs')->where('divs.id', $divs) : '';
            })
            ->where(function ($query) use ($name) {
                return $name ? $query->from('users')->where('users.id', $name) : '';
            })
            ->where(function ($query) use ($startDate) {
                return $startDate ? $query->from('tasks')
                ->whereBetween('tasks.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']) : '';
            })
            ->get();
        return collect($getTaskReport);
    }

    public function headings(): array
    {
        return [
            'Status',
            'Title',
            'Project Title',
            'Assigned To',
            'Created Date',
            'Updated Date',
            'Duration',
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->taskStatus,
            $transaction->taskTitle,
            $transaction->projectTitle,
            $transaction->userName,
            date('l, d/m/y H:i:s', strtotime( $transaction->taskCreated )),
            date('l, d/m/y H:i:s', strtotime( $transaction->taskUpdated )),
            (Carbon::parse($transaction->taskCreated)) -> diff((Carbon::parse($transaction->taskUpdated))) -> format('%D : %H : %I : %S'),
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:G1')
                                ->getFont()
                                ->setBold(true)
                                ->setSize(14);
            },
        ];
    }
}
