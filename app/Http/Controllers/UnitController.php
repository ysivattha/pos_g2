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
<<<<<<< HEAD
<<<<<<< HEAD
    
        if (request()->ajax()) 
        {

            $data = DB::table('sto_unit')
            ->join('users','sto_unit.user_id','users.id')
            ->select('sto_unit.*','users.username')
            ->where('sto_unit.is_active',1)
            ->get();
            return datatables()->of($data)
                // ->addColumn('check', function($row){
                //     $input = "<input type='checkbox' id='ch{$row->id}' value='{$row->id}'>";
                //     return $input;
                // })
                // ->addColumn('photo', function($row){
                //     $url = asset($row->photo);
                //     $img = "<img src='{$url}' width='27'>";
                //     return $img;
                // })
=======
        if (request()->ajax()) 
        {
            $data = \DB::table('sto_unit')
            ->where('sto_unit.is_active',1)
            ->leftjoin('users','sto_unit.user_id','users.id')
            ->select('sto_unit.*','users.first_name as fname','users.last_name as lname')
            ->get();
            return datatables()->of($data)
>>>>>>> b04d52fc42c7f57e44bd13a65b3eb22ae93dde51
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = btn_actions($row->id, 'sto_unit', 'sto_unit');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
<<<<<<< HEAD
            }

            return view('unit.index');
=======
=======
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
>>>>>>> parent of b04d52fc (22-09-2022, 8:45PM)
        }
        
        return view('unit.index');
>>>>>>> b04d52fc42c7f57e44bd13a65b3eb22ae93dde51
    }
}
