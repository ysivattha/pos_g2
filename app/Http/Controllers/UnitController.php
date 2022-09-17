<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app()->setLocale(Auth::user()->language);
            return $next($request);
        });
        
    }

    public function index()
    {
        if (request()->ajax()) {
            $unit = DB::table('unit')
            ->join('users','unit.user_id','users.id')
            ->select('unit.*','users.username')
            ->get();
            return datatables()->of($unit)
            ->addIndexColumn()
            ->addColumn('action', function($unit) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" onclick="editData('. $unit->id .')"><i class="fa fa-edit"></i> Edit</a>' . ' <a class="btn btn-danger btn-xs rounded-0 text-white" onclick="deleteData('. $unit->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }
        
        return view('unit.index');
    }
}
