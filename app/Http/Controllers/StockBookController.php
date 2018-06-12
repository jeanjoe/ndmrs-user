<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Facades\Log;
use App\StockBook;
use App\FinancialYear;
use Auth;
use App\User;
use App\Department;
use App\ReceivedDrug;
use App\IssuedDrug;
use App\Drug;
use App\OrderList;
use Validator;

class StockBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockBooks = StockBook::where('health_facility_id', Auth::user()->health_facility_id)->get();
        return view('stock-books.index', compact('stockBooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $financialYears = FinancialYear::with('cycles')->get();
        return view('stock-books.create', compact('financialYears'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
          'health_facility' => 'required',
          'cycle' => 'required|integer',
          'name' => 'required|alpha_num',
          'start_date' => 'required|date',
          'end_date' => 'required|date'
          ])->validate();

          // // Log::info('Error');
          // dd(Auth::user()->health_facility_id);

          try {

            $stockBook = new StockBook();
            $stockBook->health_facility_id = Auth::user()->health_facility_id;
            $stockBook->health_worker_id = Auth::user()->id;
            $stockBook->name = $request['name'];
            $stockBook->cycle_id = $request['cycle'];
            $stockBook->start_date = $request['start_date'];
            $stockBook->end_date = $request['end_date'];
            $stockBook->save();

            return redirect()->back()->with(['success' => 'Stock Book saved successfully']);
          } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Unable to save Data ' .$e->getMessage()])->withInput();
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
          $stockBook = StockBook::with('healthWorker', 'healthFacility', 'receivedDrugs')->findorfail($id);

          $approvedOrderLists = OrderList::where(['cycle_id' => $stockBook->cycle_id, 'health_facility_id' => Auth::user()->health_facility_id, 'status' => true])->pluck('drug_id');
          $drugs = Drug::whereIn('id', $approvedOrderLists)->pluck('name', 'id');

          $receievedDrugs = ReceivedDrug::where('stock_book_id', $id)->orderBy('created_at', 'desc')->get();
          $receievedDrugIDs = ReceivedDrug::where([['stock_book_id', '=', $id], ['quantity_remaining', '>=', 1]])->pluck('drug_id');
          $selectReceivedDrugs = Drug::whereIn('id', $receievedDrugIDs)->pluck('name', 'id');
          $issuedDrugs = IssuedDrug::where('stock_book_id', $id)->orderBy('created_at', 'desc')->get();
          $departments = Department::where('health_facility_id', Auth::user()->health_facility_id)->pluck('name', 'id');
          return view('stock-books.show', compact('stockBook', 'receievedDrugs', 'selectReceivedDrugs', 'issuedDrugs', 'drugs', 'departments'));
        } catch (\Exception $e) {
          return redirect()->route('stock-books.index')->with(['error' => 'Unable to find this stock book => ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
          $stockBook = StockBook::findorfail($id);
          $financialYears = FinancialYear::with('cycles')->get();
          return view('stock-books.edit', compact('stockBook', 'financialYears'));
        } catch (\Exception $e) {
          return redirect()->route('stock_books.index')->with(['error' => 'Unable to find this stock book']);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
          $stockBook = StockBook::findorfail($id);
          $stockBook->name = $request['name'];
          $stockBook->start_date = $request['start_date'];
          $stockBook->end_date = $request['end_date'];
          $stockBook->save();

          return redirect()->back()->with(['success' => 'Stock Book updated successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->width(['error' => 'Unable to Find this Stock book']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
          $findStockBook = StockBook::findorfail($id);
          $findStockBook->delete();

          return redirect()->back()->with(['success' => 'Data Deleted successfully']);
        } catch (\Exception $e) {
          return redirect()->back()->width(['error' => 'Unable to delete this data']);
        }

    }
}
