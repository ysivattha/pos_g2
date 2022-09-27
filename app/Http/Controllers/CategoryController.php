<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
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

            $data = DB::table('sto_category')
            ->join('users','sto_category.user_id','users.id')
            ->select('sto_category.*','users.username')
            ->where('sto_category.is_active',1)
            ->get();
<<<<<<< HEAD
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
                    $btn = btn_actions($row->id, 'sto_category', 'sto_category');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('category.index');
=======
            return datatables()->of($cate)
            ->addIndexColumn()
            ->addColumn('action', function($cate) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" 
                onclick="editData('. $cate->id .')"><i class="fa fa-edit"></i> Edit</a>' . 
                ' <a class="btn btn-danger btn-xs rounded-0 text-white" 
                onclick="deleteData('. $cate->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }
        return view('category.index');
>>>>>>> b04d52fc42c7f57e44bd13a65b3eb22ae93dde51
    }
  

   
}
