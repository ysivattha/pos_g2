<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HrApprovedNameController extends Controller
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
            $data = \DB::table('hr_approved_name')
            ->leftjoin('users','hr_approved_name.user_id','users.id')
            ->where('hr_approved_name.is_active',1)
            ->select('hr_approved_name.*','users.first_name as fname','users.last_name as lname')
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
           
    }
}
