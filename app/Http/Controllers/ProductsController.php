<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use App\Stock;
use Validator;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
       $validator = Validator::make( $request->all(), [
         // 'drug_code' => 'required|integer',
         'stock_id'=>'required|integer',
         'date' => 'required|date',
         'from' => 'required|string|max:150',
         'quantity' => 'required|integer',
         'product_name' => 'required|string',
         //name' => 'required|string|unique:stocks,health_facility_id,'.$request->product_name,
         //'name' => 'required|string|max:250',product_name

         ] );
         if ($validator->fails()) {
             return back()->withErrors($validator)->withInput();
         }
         try {

             $product = new Product();
             $product->product_name = $request->product_name;
             $product->stock_id = $request->stock_id;
             $product->transDate = $request->date;
             $product->from = $request->from;
             $product->quantity = $request->quantity;
             $product->save();

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
        //
    }
}
