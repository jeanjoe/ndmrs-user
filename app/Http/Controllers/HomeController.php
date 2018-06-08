<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Drug;
use App\Order;
use App\HealthWorker;
use App\FinancialYear;
use App\Cycle;
use Auth;
use App\HealthFacility;

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
      $healthFacilitiesUnder = HealthFacility::with('healthSubDistrict')->where('level',$level)->get();
      return view('health_facilities.index', compact('healthFacilitiesUnder'));
    }

    public function cycles()
    {
        $financialYears = FinancialYear::with('cycles')->get();
        return view('cycles.index', compact('financialYears'));
    }

    public function cycleOrder($id)
    {
        try {
          $cycle = Cycle::with(['orders' => function ($query){
            $query->where('health_facility_id', Auth::user()->health_facility_id)->get();
          }],'financialYear')->findOrFail($id);
          $orderedDrugs = Order::where(['cycle_id' => $id, 'health_worker_id' => Auth::user()->health_facility_id])->pluck('drug_id');

          $drugs = Drug::whereNotIn('id', $orderedDrugs)->pluck('name', 'id');
          // $drugs = Drug::where('level_of_care', 'ALL')->pluck('name', 'id');
          return view('cycles.show', compact('cycle', 'drugs'));
        } catch (\Exception $e) {
          return redirect()->route('cycles')->with(['error' => 'Cannot find this cycle']);
        }

    }
}
