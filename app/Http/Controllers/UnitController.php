<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
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
    $data['unit'] = DB::table('unit')
    ->join('users','unit.user_id','users.id')
    ->select('unit.*','users.username')
    ->get();
    return view('unit.index',$data);
   }
}
