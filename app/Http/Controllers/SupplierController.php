<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
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

            $data = \DB::table('sup_supplier')
            ->join('sup_supplier_type','sup_supplier.type_id','sup_supplier_type.id')
            ->join('users','sup_supplier.user_id','users.id')
            ->where('sup_supplier.is_active',1)
            ->select('sup_supplier.*','sup_supplier_type.s_type','users.username')
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
                    $btn = btn_actions($row->id, 'sup_supplier', 'sup_supplier');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('supplier.index');
    }
}
