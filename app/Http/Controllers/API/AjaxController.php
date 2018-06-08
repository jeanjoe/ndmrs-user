<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Drug;
use App\ReceivedDrug;
use Validator;

class AjaxController extends Controller
{
  public function getDrugs()
  {
      try {
        $drugs = Drug::select('name', 'id')->get();
        return response()->json(['drugs' => $drugs, 'success' =>1 ]);
      } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to retrieve drug list']);
      }
  }

  public function receiveDrug(Request $request, $id)
  {
    $validator = Validator($request->all(), [
      'receive_date' => 'required|date',
      'drug' => 'required|integer',
      'stock_book' => 'required|integer',
      'batch_number' => 'required|alpha_num',
      'voucher_no' => 'required|alpha_num',
      'organization' => 'required|string|max:50',
      'quantity' => 'required|integer|min:1|max:1000000',
      'manufacture_date' => 'required|date',
      'expiry_date' => 'required|date'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->messages()]);
    }

    try {
      $receievedDrug = new ReceivedDrug();
      $receievedDrug->user_id = $request['user'];
      $receievedDrug->drug_id = $request['drug'];
      $receievedDrug->stock_book_id = $id;
      $receievedDrug->batch_number = $request['batch_number'];
      $receievedDrug->organization = $request['organization'];
      $receievedDrug->voucher_number = $request['voucher_no'];
      $receievedDrug->quantity = $request['quantity'];
      $receievedDrug->receive_date = $request['receive_date'];
      $receievedDrug->manufacture_date = $request['manufacture_date'];
      $receievedDrug->expiry_date = $request['expiry_date'];
      $receievedDrug->save();

      return response()->json(['message' => 'Drug added', 'success' => 1]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Cannot add Drug => ', 'success' => 0]);
    }

  }

  public function issueDrug(Request $request)
  {

      $validator = Validator($request->all(), [
        'recepient' => 'required|integer',
        'drug' => 'required|integer',
        'quantity_out' => 'required|integer|min:0|max:1000000',
        'issued_date' => 'required|date',
      ]);

      if ($validator->fails()) {
          return response()->json(['errors' => $validator->messages()]);
      }

  }
}
