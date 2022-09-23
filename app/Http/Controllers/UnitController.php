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
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = btn_actions($row->id, 'sto_unit', 'sto_unit');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('unit.index');
    }
}
