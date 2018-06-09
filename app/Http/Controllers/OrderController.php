<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Drug;
use App\Order;
use App\FinancialYear;
use Auth;

class OrderController extends Controller
{
      public function __construct()
      {
          $this->middleware('auth');
      }
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
        $orderedDrugs = Order::with('cycle' , 'user', 'drug')->where('health_facility_id', Auth::user()->health_facility_id)->pluck('drug_id');
        $grandTotal = Order::where('health_facility_id', Auth::user()->health_facility_id)->sum('total_cost');
        $orders = Order::has('cycle')->with('drug')->where('health_facility_id', Auth::user()->health_facility_id)->orderBy('created_at', 'desc')->get();
        $drugs = DB::table('drugs')->whereNotIn('id', $orderedDrugs)->orderBy('name','asc')->get();
        $finacial_years = FinancialYear::orderBy('id', 'asc')->get();
        //$strengths = Drug::pluck('strength','id');
        //$cost = Drug::pluck('cost_per_unit', 'id');
        return view('orders.index', compact('drugs', 'finacial_years', 'orders', 'grandTotal'));
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
          $orderedDrugs = Order::where('health_facility_id', Auth::user()->health_facility_id)->pluck('drug_id');
          $grandTotal = Order::where('health_facility_id', Auth::user()->health_facility_id)->sum('total_cost');
          $orders = Order::with('drug')->where('health_facility_id', Auth::user()->health_facility_id)->get();
          $drugs = DB::table('drugs')->whereNotIn('id', $orderedDrugs)->orderBy('name','asc')->get();
          $finacial_years = FinancialYear::orderBy('id', 'asc')->get();
          //$strengths = Drug::pluck('strength','id');
          //$cost = Drug::pluck('cost_per_unit', 'id');
          return view('orders.create', compact('drugs', 'finacial_years', 'orders', 'grandTotal'));

      }


      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request)
      {
          $validation = Validator::make($request->all(), [
            'quantity' => 'required|min:1|integer',
            'total_cost' => 'required',
            'cycle' => 'required',
            'quantity' => 'required',
          ]);

          if ($validation->fails()) {
            # code...
            return redirect()->back()->withInput()->withErrors($validation->messages());
          }

          try {
            $order = new Order();
            $order->drug_id = $request->drug;
            $order->cycle_id = $request->cycle;
            $order->health_facility_id = Auth::user()->health_facility_id;
            $order->health_worker_id = Auth::user()->id;
            $order->quantity = $request->quantity;
            $order->total_cost = $request->total_cost;
            $order->ven = $request->ven;
            $order->status = false;
            $order->save();
            return redirect()->back()->with('success', 'Order Added successfully');
          } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Whooops!!.... Error while saving order ' .$e->getMessage());
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
          //
      }
}
