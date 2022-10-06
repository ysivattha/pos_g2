<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HrAbsentController extends Controller
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

         $data =\DB::table('hr_absent')
         ->leftjoin('hr_employee','hr_absent.employee_id','hr_employee.id')
         ->leftjoin('hr_absent_type','hr_absent.absent_type_id','hr_absent_type.id')
         ->leftjoin('users','hr_absent.user_id','users.id')
         ->leftjoin('hr_approved_name','hr_absent.approved_name_id','hr_approved_name.id')
         ->where('hr_absent.is_active',1)
         ->select('hr_absent.*','hr_employee.name_en','hr_absent_type.absent_type_name',
         'users.first_name as fname','users.last_name as lname','hr_approved_name.approved_name')
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
                    $btn = btn_actions($row->id, 'hr_absent', 'hr_absent');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('hr_absent.index');
    }
}
