<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{
    public function index()
    {
        $divs = DB::table('divs')->where('id', "<>", 10)->get();
        return response()->json(["message" => "Successfully", "data" => $divs]);
    }
}
