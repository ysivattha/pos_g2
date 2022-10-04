<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrainingController extends Controller
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

        $data = \DB::table('hr_training')
        ->leftjoin('hr_employee','hr_training.employee_id','hr_employee.id')
        ->leftjoin('hr_training_course','hr_training.course_id','hr_training_course.id')
        ->leftjoin('users','hr_training.user_id','users.id')
        ->leftjoin('hr_result_type','hr_training.result_id','hr_result_type.id')
        ->select('hr_training.*','hr_employee.name_en','hr_training_course.course_subject','users.first_name as fname',
        'hr_result_type.result_type_name')
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
                    $btn = btn_actions($row->id, 'hr_training', 'hr_training');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('hr_training.index');
    }
}
