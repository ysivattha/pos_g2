<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HrPayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app()->setLocale(\Auth::user()->language);
            return $next($request);
        });
    }

    public function index()
    {
    
        if (request()->ajax()) 
        {
           $data = \DB::table('hr_payroll')
           ->leftjoin('users','hr_payroll.user_id','users.id')
           ->where('hr_payroll.is_active',1)
           ->select('hr_payroll.*','users.first_name as fname','users.last_name as lname')
           ->get();
            return datatables()->of($data)
                // ->addColumn('check', function($row){
                //     $input = "<input type='checkbox' id='ch{$row->id}' value='{$row->id}'>";
                //     return $input;
                // })
                // ->addColumn('photo', function($row){
                //     $url = asset($row->pdf_file);
                //     $img = "<img src='{$url}' width='27'>";
                //     return $img;
                // })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = btn_actions($row->id, 'hr_payroll', 'hr_payroll');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('hr_payroll.index');
    }
}
