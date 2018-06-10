<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\HealthFacility;
use App\Order;
use App\OrderList;
use Carbon\Carbon;
use Auth;

class OrderController extends Controller
{
      public function __construct()
      {
          $this->middleware('auth');
      }

      public function index()
      {
        $orders = Order::with('healthFacility' , 'orderLists.cycle.finanancialYear', 'healthWorker')->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
      }


      public function store(Request $request)
      {
          Validator::make($request->all(), [
            'cycle' => 'required',
          ])->validate();

          try {
            DB::beginTransaction();
            //search for health facility name
            $healthFacility = HealthFacility::where('id', Auth::user()->id)->pluck('name');
            $orderCode =  substr($healthFacility, 0, 3) . '' .Carbon::now()->timestamp;

            //save order Commit
            $order = new Order();
            $order->health_facility_id = Auth::user()->health_facility_id;
            $order->health_worker_id = Auth::user()->id;
            $order->order_code = $orderCode;
            $order->status = false;
            $order->save();

            //update order lists set to committed
            OrderList::where(['health_facility_id' => Auth::user()->id, 'cycle_id' => $request['cycle']])->update(['committed' => true, 'commit_code' => $orderCode]);

            DB::commit();

            return redirect()->back()->with('success', 'Order Added successfully');
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Whooops!!.... Error while commiting order ' .$e->getMessage());
          }

      }

      public function show($id)
      {
          try {
            $order = Order::findOrFail($id);
            return view('orders.show', compact('order'));
          } catch (\Exception $e) {
            return redirect()->route('orders.index')->with(['error' => 'Cannot find order with id '. $id]);
          }

      }

      public function destroy($id)
      {
          //
      }
}
