<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TrainCourseController extends Controller
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

         $data = \DB::table('hr_training_course')
         ->leftjoin('users','hr_training_course.user_id','users.id')
         ->select('hr_training_course.*','users.first_name')
         ->get();
            
            return datatables()->of($data)
                // ->addColumn('check', function($row){
                //     $input = "<input type='checkbox' id='ch{$row->id}' value='{$row->id}'>";
                //     return $input;
                // })
                ->addColumn('photo', function($row){
                    $url = asset($row->pdf_file);
                    $img = "<img src='{$url}' width='27'>";
                    return $img;
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = btn_actions($row->id, 'hr_training_course', 'hr_training_course');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('training_course.index');
    }
}
