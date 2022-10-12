<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;

class DepartmentController extends Controller
{


    public function index()
    {
        if (request()->ajax()) {
            $data = DB::table('hr_department')
            ->where('hr_department.is_active', 1)
            ->leftjoin('users', 'hr_department.user_id', 'users.id')
            ->select('hr_department.*', 'users.first_name as fname', 'users.last_name as lname')
            ->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                $btn = btn_actions($row->id, 'hr_department', 'hr_department');
                    return $btn;
            })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('hr_department.index');
    }
  
   
}
