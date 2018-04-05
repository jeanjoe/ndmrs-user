<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\IssuedProduct;
use App\Stock;

class AjaxController2 extends Controller
{
  public function saveProduct(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'issued_date' => 'required|date',
      'issued_product_name' => 'required|string',
      'issued_stock_id' => 'required|integer',
      'issued_recipient' => 'required|string',
      'issued_voucher_no' => 'required|string',
      'quantity_out' => 'required|integer|min:1',

  ]);

  if ($validator->passes()) {
    //subtract the issued stock from the available stock
    $stock = new Stock();
    $stock = Stock::find($request->issued_stock_id);
    $stock->stock_quantity = ($stock->stock_quantity - $request->quantity_out);
    $stock->save();
      try {
        $issued_product = new IssuedProduct();
        $issued_product->product_name = $request->issued_product_name;
        $issued_product->transDate = $request->issued_date;
        $issued_product->stock_id = $request->issued_stock_id;
        $issued_product->recipient = $request->issued_recipient;
        $issued_product->voucher_no = $request->issued_voucher_no;
        $issued_product->quantity_out = $request->quantity_out;
        $issued_product->save();

        return response()->json(['success'=>'Issued out some drugs.']);
      } catch (\Exception $e) {
        return response()->json(['error'=>$e->getMessage()]);
      }
  }
  return response()->json(['errors'=>$validator->errors()->all()]);
  }
}
