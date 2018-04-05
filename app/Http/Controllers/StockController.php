<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Drug;
use Validator;
use App\Stock;
use Auth;

class StockController extends Controller
{
    public function __construct()
    {
      # code...
      $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::where('health_facility_id', Auth::user()->health_facility_id)->get();
        $user_health_facility_id = Auth::user()->health_facility_id;
        $selected_drugs = Stock::where('health_facility_id', $user_health_facility_id)->pluck('drug_id');
        // $drugs = Drug::with('drug')->orderBy('name', 'asc')->pluck('name', 'id');
        $drugs = DB::table('drugs')->whereNotIn('id', $selected_drugs )->get();
        return view('stock.index', compact('stocks', 'drugs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user_health_facility_id = Auth::user()->health_facility_id;
      $selected_drugs = Stock::where('health_facility_id', $user_health_facility_id)->pluck('drug_id');
      // $drugs = Drug::with('drug')->orderBy('name', 'asc')->pluck('name', 'id');
      $drugs = DB::table('drugs')->whereNotIn('id', $selected_drugs )->get();
      return view('stock.create', compact('drugs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
      'status' => 'required|string|max:10',
      'health_facility' => 'required|integer',
      'name' => 'required|integer|unique:stocks,health_facility_id,'.$request->health_facility,

    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    try {

        $stock = new Stock();
        $stock->health_facility_id = $request->health_facility ;
        $stock->status = $request->status;
        $stock->drug_id = $request->name;
        $stock->save();

        return back()->with('success', 'Data Insterted successfully');

      } catch (\Exception $e) {
        return back()->with('error', 'Already Registered Stock')->withInput();
      }
    }
    public function store_product(Request $request)
    {
      $validator = Validator::make($request->all(), [
      'status' => 'required|string|max:10',
      'health_facility' => 'required|integer',
      'name' => 'required|integer|unique:stocks,health_facility_id,'.$request->health_facility,

    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    try {

        $stock = new Stock();
        $stock->health_facility_id = $request->health_facility ;
        $stock->status = $request->status;
        $stock->drug_id = $request->name;
        $stock->save();

        return back()->with('success', 'Data Insterted successfully');

      } catch (\Exception $e) {
        return back()->with('error', 'Already Registered Stock')->withInput();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $stock = Stock::find($id);
      $stock->delete();
      return redirect('/stocks')->with('success', $stock->drug->name .' has been deleted!!');
    }
}
