<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StockOutController extends Controller
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
            $stock = DB::table('stock_out')
            ->join('users','stock_out.user_id','users.id')
            ->join('customer','stock_out.customer_id','customer.id')
            ->select('stock_out.*','customer.contact_name','users.username')
            ->get();
            return datatables()->of($stock)
            ->addIndexColumn()
            ->addColumn('action', function($stock) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" onclick="editData('. $stock->id .')"><i class="fa fa-edit"></i> Edit</a>' . ' <a class="btn btn-danger btn-xs rounded-0 text-white" onclick="deleteData('. $stock->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }
        
        return view('stockout.index');
    }
}
