<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Product;
use App\Stock;
use App\Drug;

class AjaxController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function ajaxUsers(Request $request)
    {

        // if($request->ajax()){
          $users = User::all();
          return response()->json(['users'=>$users, 'success' => 1], 200);
        // } else {
        //   return redirect()->route('dashboard')->with('error','You are not allowed to access that resource');
        // }
    }

    public function ajaxUsersSave(Request $request)
    {
      return back()->withInput($request->all());
    }

    public function getUsers()
    {
      # code...
      return 'success';
    }

    public function showDrug($id)
    {
      try {
        $drug  = Drug::findOrFail($id);
        return response()->json([ 'success' => 1, 'drug' => $drug]);
      } catch (\Exception $e) {
        return response()->json([ 'success' => 0, 'message' => 'Unable to find drug' ]);        
      }

    }

    //chandiga work starts
    public function saveProduct(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'date' => 'required|date',
        'product_name' => 'required|string',
        'stock_id' => 'required|integer',
        'from' => 'required|string',
        'voucher_no' => 'required|string',
        'batch_number' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'expiry_date' => 'required|date',

    ]);


    if ($validator->passes()) {
      //update the new stock quantity
        $stock = new Stock();
        $stock = Stock::find($request->stock_id);
        $stock->stock_quantity = ($request->quantity + $stock->stock_quantity);
        $stock->save();

        try {
          $product = new Product();
          $product->product_name = $request->product_name;
          $product->transDate = $request->date;
          $product->stock_id = $request->stock_id;
          $product->from = $request->from;
          $product->expiry_date = $request->expiry_date;
          $product->voucher = $request->voucher_no;
          $product->batch_no = $request->batch_number;
          $product->quantity = $request->quantity;
          $product->save();

          return response()->json(['success'=>'Added new records.']);
        } catch (\Exception $e) {
          return response()->json(['error'=>$e->getMessage()]);
        }
    }
    return response()->json(['errors'=>$validator->errors()->all()]);
    }
}
