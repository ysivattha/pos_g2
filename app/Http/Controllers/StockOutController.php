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
        $data['ous'] = DB::table('stock_out')
        ->join('users','stock_out.user_id','users.id')
        ->join('customers','stock_out.customer_id','customers.id')
        ->select('stock_out.*','users.username','customers.en_first_name','customers.en_last_name')
        ->get();
        return view('stockout.index',$data);
       
    }
}
