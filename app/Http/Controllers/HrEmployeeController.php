<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HrEmployeeController extends Controller
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

            $data = \DB::table('hr_employee')
            ->join('hr_sex','hr_employee.sex_id','hr_sex.id')
            ->join('hr_position','hr_employee.position_id','hr_position.id')
            ->join('hr_department','hr_employee.department_id','hr_department.id')
            ->join('hr_employee_status','hr_employee.status_id','hr_employee_status.id')
            ->join('users','hr_employee.user_id','users.id')
            ->select('hr_employee.*','hr_sex.sex','hr_employee_status.status','hr_department.department','users.username','hr_position.position')
            ->where('hr_employee.is_active',1)
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
                    $btn = btn_actions($row->id, 'hr-employee', 'hr-employee');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('hr_employee.index');
    }
}
