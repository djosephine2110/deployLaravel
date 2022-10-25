<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Exports\ReportExport;
use App\Exports\CalculationsExport;
use DB;
use Carbon\Carbon;
use App\Imports\TransactionsImport;

class ExcelController extends Controller
{
    public function importExportView()
    {
        return view('index');
    }
    
    public function exportExcel($type)
    {
        return \Excel::download(new ReportExport, 'exportdetails.'.$type);
    }
    public function exportExcel2($type)
    {
        return \Excel::download(new ReportExport, 'exportduration.'.$type);
    }
    
    public function importExcel(Request $request)
    {
        \Excel::import(new TransactionsImport, $request->import_file);

        \Session::put('success', 'Your file is imported successfully in database.');
           
        return back();
    }
}
