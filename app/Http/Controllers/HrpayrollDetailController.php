<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HrpayrollDetailController extends Controller
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

       $data = \DB::table('hr_payroll_detail')
       ->leftjoin('users','hr_payroll_detail.user_id','users.id')
       ->leftjoin('hr_employee_pay_type','hr_payroll_detail.pay_type_id','hr_employee_pay_type.id')
       ->where('hr_employee_pay_type.is_active',1)
       ->select('hr_payroll_detail.*','users.first_name as fname','users.last_name as lname',
       'hr_employee_pay_type.pay_type_name as payname')
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
                    $btn = btn_actions($row->id, 'hr', 'hr');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('hr_payroll_detail.index');
    }
}
