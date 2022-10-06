<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HrEmployeeFileController extends Controller
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
          $data = \DB::table('hr_employee_file')
          ->leftjoin('hr_employee','hr_employee_file.employee_id','hr_employee.id')
          ->leftjoin('hr_attach_type','hr_employee_file.attach_type_id','hr_attach_type.id')
          ->leftjoin('users','hr_employee_file.user_id','users.id')
          ->where('hr_employee_file.*','hr_atach_type.attch_type_name','users.first_name as fname'
          ,'users.last_name as lname')
          ->get();
            return datatables()->of($data)
               
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = btn_actions($row->id, 'hr_absent', 'hr_absent');
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('hr_employee_file.index');
           
    }
}
