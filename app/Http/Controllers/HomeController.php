<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Drug;
use App\Order;
use App\HealthWorker;
use Auth;
use App\healthFacility;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('hospital')->only('hospitals');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        $healthWorkers = HealthWorker::where('health_facility_id', Auth::user()->id)->get();
        $orders = Order::where('health_facility_id', Auth::user()->id)->get();
        $drugs = Drug::all();
        return view('home',  compact('healthWorkers', 'orders', 'drugs') );
    }

    public function hospitals()
    {
        $drugs = Drug::where('level_of_care', 'HOSPITAL')->get();
        $orders = Order::all();
        $healthWorkers = HealthWorker::all();
        return view('home', compact('drugs', 'orders', 'healthWorkers'));
    }

    public function settings()
    {
        return view('settings');
    }

    public function reports()
    {
        return view('reports.index');
    }

    public function healthWorkers()
    {
        $healthWorkers = User::with('healthFacility')->where('health_facility_id', Auth::user()->health_facility_id)->get();
        return view('pages.healthWorkers', compact('healthWorkers'));
    }
    public function healthFacilitiesUnder($level)
    {
      $healthFacilitiesUnder = healthFacility::with('healthSubDistrict')->where('level',$level)->get();
      return view('health_facilities.index', compact('healthFacilitiesUnder'));
    }


}
