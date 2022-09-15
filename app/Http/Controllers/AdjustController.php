<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdjustController extends Controller
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
        $data['stockadjust'] = DB::table('stock_adjust')
        ->join('users','stock_adjust.user_id','users.id')
        ->join('item','stock_adjust.item_id','item.id')
        ->select('stock_adjust.*','users.username','item.product_name','item.barcode')
        ->get();
        return view('stockadjust.index',$data);
    }
}
