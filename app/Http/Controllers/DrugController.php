<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use App\StockBook;
use App\ReceivedDrug;
use App\Cycle;
use App\FinancialYear;
use App\IssuedDrug;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class DrugController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function received()
    {
      $current_date = Carbon::today();
      $stockBooks = StockBook::with('receivedDrugs')->where('health_facility_id', Auth::user()->health_facility_id)->get();
      return view('drugs.received', compact('stockBooks', 'current_date'));
    }

    public function issued()
    {
      $stockBooks = StockBook::with('issuedDrugs')->where('health_facility_id', Auth::user()->health_facility_id)->get();
      return view('drugs.issued', compact('stockBooks'));
    }

    public function expired()
    {
      $expiredDrugs = ReceivedDrug::with('drug')->where('expiry_date', '<=', Carbon::today())->get();
      return view('drugs.expired', compact('expiredDrugs'));
    }

    public function analyzed(Request $request)
    {
      $healthFacility_drug_ID = $request->input('drug');
      $financialYearID = $request->input('financialYear', 1);
      $cycles = Cycle::where('financial_year_id', $financialYearID)->pluck('id');

      $stockBookIDs = StockBook::where('health_facility_id', Auth::user()->health_facility_id)->whereIn('cycle_id', $cycles)->pluck('id');

      $healthFacilities_drugs = IssuedDrug::whereIn('stock_book_id', $stockBookIDs)->get();

      if (empty($healthFacility_drug_ID) && $healthFacilities_drugs->count() > 1) {
        $healthFacility_drug_ID = $healthFacilities_drugs[0]->id;
      }

      $financialYears = FinancialYear::pluck('financial_year', 'id');
      $financialYear = FinancialYear::find($financialYearID);

      $drug = Drug::find($healthFacility_drug_ID);

      $distinctDrugMonths = ReceivedDrug::select(DB::raw('MONTH(receive_date) month'))->with(['drugs' => function ($query) use ($healthFacility_drug_ID) {
        $query->where('drug_id', $healthFacility_drug_ID)->get();
      }])->where('drug_id', $healthFacility_drug_ID )->whereIn('stock_book_id', $stockBookIDs)->groupBy('month')->get();
      //dd($distinctDrugMonths);
      $receivedDrugs = ReceivedDrug::with('drug')->select('drug_id')->distinct()->whereIn('stock_book_id', $stockBookIDs)->get();

      $distinct_stock_Drugs = ReceivedDrug::with('drug', 'quantity', 'quantity_remaining')
        ->select('drug_id')
        ->where('drug_id', $healthFacility_drug_ID)
        ->distinct()
        ->get();
        $expiredDrugs = ReceivedDrug::with('drug')->where([['expiry_date', '<=', Carbon::today()], ['drug_id', $healthFacility_drug_ID]])->get();
      return view('drugs.analyzed', compact('receivedDrugs','expiredDrugs', 'distinct_stock_Drugs', 'financialYear', 'drug', 'financialYears', 'stockBookIDs', 'distinctDrugMonths', 'healthFacility_drug_ID' ));
    }
}
