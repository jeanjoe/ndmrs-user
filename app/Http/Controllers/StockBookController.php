<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockBook;
use Auth;
use App\User;
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
        return view('stock-books.create');
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
          'name' => 'required|alpha_num',
          'start_date' => 'required|date',
          'end_date' => 'required|date'
          ])->validate();

          try {

            $stockBook = new StockBook();
            $stockBook->name = $request['name'];
            $stockBook->start_date = $request['start_date'];
            $stockBook->end_date = $request['end_date'];
            $stockBook->health_facility_id = Auth::user()->health_facility_id;
            $stockBook->user_id = Auth::user()->id;
            $stockBook->save();

            return redirect()->back()->with(['message' => 'Data saved successfully']);
          } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Unable to save Data'])->withInput();
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
