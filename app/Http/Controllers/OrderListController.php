<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\OrderList;
use Validator;

class OrderListController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $order = new OrderList();
        $order->drug_id = $request->drug;
        $order->cycle_id = $request->cycle;
        $order->health_facility_id = Auth::user()->health_facility_id;
        $order->health_worker_id = Auth::user()->id;
        $order->quantity = $request->quantity;
        $order->total_cost = $request->total_cost;
        $order->ven = $request->ven;
        $order->status = false;
        $order->save();
        return redirect()->back()->with('success', 'Drug Added to Order List successfully');
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
        try {
          $orderList  = OrderList::findOrFail($id);
          $orderList->forceDelete();
          return redirect()->back()->with(['success' => 'Drug Removed from Order List']);
        } catch (\Exception $e) {
          return redirect()->back()->with(['error' => 'Unable to find this Drug']);
        }

    }
}
