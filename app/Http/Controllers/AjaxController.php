<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AjaxController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function ajaxUsers(Request $request)
    {

        // if($request->ajax()){
          $users = User::all();
          return response()->json(['users'=>$users, 'success' => 1], 200);
        // } else {
        //   return redirect()->route('dashboard')->with('error','You are not allowed to access that resource');
        // }
    }

    public function ajaxUsersSave(Request $request)
    {
      return back()->withInput($request->all());
    }

    public function getUsers()
    {
      # code...
      return 'success';
    }

    public function showDrug()
    {
      # code...
      return response()->json([ 'success' => 1, 'data' => [1,2,3,4,5,6,7]]);
    }
}
