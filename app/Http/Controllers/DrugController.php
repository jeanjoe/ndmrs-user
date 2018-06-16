<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use App\StockBook;
use App\ReceivedDrug;
use Carbon\Carbon;
use Auth;

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
}
