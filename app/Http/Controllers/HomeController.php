<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Drug;
use App\Order;
use App\OrderList;
use App\HealthWorker;
use App\FinancialYear;
use App\IssuedDrug;
use App\ReceivedDrug;
use App\Department;
use App\Cycle;
use Auth;
use App\HealthFacility;
use App\DepartmentReport;
use Validator;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('hospital')->only('hospitals');
    }

    public function dashboard()
    {
        $healthWorkers = HealthWorker::where('health_facility_id', Auth::user()->health_facility_id)->get();
        $orders = Order::with('orderLists')->where('health_facility_id', Auth::user()->health_facility_id)->get();
        $healthFacility = HealthFacility::where('id', Auth::user()->health_facility_id)->first();
        $level = '';

        if ($healthFacility->level == 'HOSPITAL') {
            $level = 'DH';
        } elseif ($healthFacility->level = 'NATIONAL REFERRAL') {
            $level= 'NRH';
        } elseif ($healthFacility->level = 'REGIONAL REFERRAL') {
            $level= 'RRH';
        } else {
            $level= $healthFacility->level;
        }
        $financialYears = FinancialYear::get();
        $drugs = Drug::all();
        $cycles = Cycle::with(['orderLists' => function ($query){
          $query->where('health_facility_id', Auth::user()->health_facility_id)->get();
        }],'financialYear')->get();
        return view('home',  compact('healthWorkers', 'financialYears', 'level', 'orders', 'drugs', 'cycles') );
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

    public function reports(Request $request)
    {
        $getYear = $request->input('financialYear');
        $financialYears = FinancialYear::with('cycles')->pluck('financial_year', 'id');
        return view('reports.index', compact('financialYears', 'getYear'));
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
          $cycle = Cycle::with(['orderLists' => function ($query){
            $query->where('health_facility_id', Auth::user()->health_facility_id)->get();
          }],'financialYear')->findOrFail($id);
          $orderedDrugs = OrderList::where(['cycle_id' => $id, 'health_worker_id' => Auth::user()->health_facility_id])->pluck('drug_id');

          $findIfOrderExists = Order::where(['cycle_id' => $id, 'health_facility_id' => Auth::user()->health_facility_id])->first();

          $drugs = Drug::whereNotIn('id', $orderedDrugs)->pluck('name', 'id');
          // $drugs = Drug::where('level_of_care', 'ALL')->pluck('name', 'id');
          return view('cycles.show', compact('cycle', 'drugs', 'findIfOrderExists'));
        } catch (\Exception $e) {
          return redirect()->route('cycles')->with(['error' => 'Cannot find this cycle => ' . $e->getMessage()]);
        }

    }

    public function analytics(Request $request)
    {
        try {
          $healthFacilityID = $request->input('health_facility');

          $healthFacilities = HealthFacility::pluck('name', 'id');

          if ($healthFacilityID == '') {
            $healthFacilityID = $healthFacilities[0]->id;
          }

          $healthFacility = HealthFacility::with('order', 'issuedDrugs', 'receivedDrugs')->where('health_facility_id', $healthFacilityID)->first();

          return view('analytics.index', compact('healthFacilities', 'healthFacility'));
        } catch (\Exception $e) {
          return redirect()->route('dashboard')->with(['error' => 'Unable to show Ananlytics']);
        }

    }

    public function edit()
    {
        return view('health-workers.edit');
    }

    public function departmentReport()
    {
      $departments = Department::with(['issueDrugs' => function ($query) {
        $query->where('quantity_remaining', '>=', 1)->get();
      }])->where('health_facility_id', Auth::user()->health_facility_id)->get();
      return view('departments.report', compact('departments'));
    }

    public function allDepartmentReportShow($id)
    {
      $report = DepartmentReport::with('issueDrug')->findOrFail($id);
      return view('departments.show-report', compact('report'));
    }

    public function departmentStoreReport(Request $request)
    {
      Validator::make($request->all(), [
        'quantity_available' => 'required',
        'quantity' => 'required|integer|min:1|max:' .$request->quantity_available,
        'issued_drug' => 'required',
        'comment' => 'nullable|max:200',
      ])->Validate();

      try {
        DB::beginTransaction();

        IssuedDrug::where('id', $request['issued_drug'])->decrement('quantity_remaining', $request['quantity']);

        DB::table('department_drug_reports')->insert([
          'quantity' => $request->quantity,
          'quantity_remaining' => $request->quantity_available - $request->quantity,
          'issued_drug_id' => $request->issued_drug,
          'comment' => $request->comment,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);

        DB::commit();

        return redirect()->back()->with(['success' => 'Report Added successfully']);
      } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with(['error' => 'Unable to save this report']);
      }

    }

    public function allDepartmentReport()
    {
        $reports = DepartmentReport::with('issuedDrug.drug')->paginate(20);
        return view('departments.all-reports', compact('reports'));
    }
}
