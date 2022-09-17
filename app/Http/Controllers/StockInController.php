<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class StockInController extends Controller
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
        if (request()->ajax()) {
            $stock = DB::table('stock_in')
            ->join('users','stock_in.user_id','users.id')
            ->join('supplier','stock_in.supplier_id','supplier.id')
            ->select('stock_in.*','users.username','supplier.contact_name')
            ->get();
            return datatables()->of($stock)
            ->addIndexColumn()
            ->addColumn('action', function($stock) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" onclick="editData('. $stock->id .')"><i class="fa fa-edit"></i> Edit</a>' . ' <a class="btn btn-danger btn-xs rounded-0 text-white" onclick="deleteData('. $stock->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }

        $data['suppliers'] = DB::table('supplier')->get();
        
        
        return view('stockin.index' , $data);
    }

    public function store(Request $r)
    {
        $per = $r->per;
        $tbl = $r->tbl;

        $data = Validator::make($r->all(), [
            'supplier_id' => 'required',
            'amount' => 'required',
            'discount' => 'required',
            'total' => 'required',
            'tax'=>'required',
            'total_with_tax'=>'required',
            'seller_id'=>'required',
            'paid'=>'required',
            

        ]);
     
        if ($data->passes()) {

                 // if(!check($per, 'i')){
        //     return 0;
        // }
    
        $data = $r->except('_token', 'per', 'tbl');
        $data['user_id'] = Auth::user()->id;
        $data['datetime']=now();
        $i = DB::table($tbl)->insert($data);
            return (int)$i;
        }

        return -1;

     
        // if(!check($per, 'i')){
        //     return 0;
        // }
    
        // $data = $r->except('_token', 'per', 'tbl');
        // $data['user_id'] = Auth::user()->id;
        // $data['datetime']=now();
        // $i = DB::table($tbl)->insert($data);
        //  return (int)$i;
    }
}
