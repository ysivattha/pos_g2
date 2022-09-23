<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app()->setLocale(Auth::user()->language);
            return $next($request);
        });
    }
    // read

    public function index()
    {
    
        if (request()->ajax()) 
        {

            $data = \DB::table('cus_customer')
            ->join('cus_customer_type','cus_customer.type_id','cus_customer_type.id')
            ->join('users','cus_customer.user_id','users.id')
            ->select('cus_customer.*','cus_customer_type.c_type','users.username')
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
                    $btn = btn_actions($row->id, 'sto_item', 'sto_item');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('customers.index');
    }
}
