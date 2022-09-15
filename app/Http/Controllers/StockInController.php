<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $data['ins'] = DB::table('stock_in')
        ->join('users','stock_in.user_id','users.id')
        ->select('stock_in.*','users.username')
        ->get();
        return view('stockin.index',$data);
    }
}
