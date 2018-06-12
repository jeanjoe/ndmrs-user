<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Facades\Log;
use App\Department;
use Auth;
use Validator;

class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
      $departments = Department::with('issueDrugs')->where('health_facility_id', Auth::user()->health_facility_id)->paginate(20);
      return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('departments.create');
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
          'name' => 'required|string'
        ])->validate();

        try {
          $department = new Department();
          $department->health_facility_id = Auth::user()->health_facility_id;
          $department->name = $request['name'];
          $department->save();
          return redirect()->back()->with(['success' => 'Data saved successfully']);

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
        try {
          $department = Department::findOrFail($id);
          return view('departments.edit', compact('department'));
        } catch (\Exception $e) {
          return redirect()->back()->with(['error' => ' Cannot fid this Department']);
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
      Validator::make($request->all(), [
        'name' => 'required|string'
      ])->validate();

      try {
        $department = Department::findOrFail($id);
        $department->name = $request['name'];
        $department->save();
        return redirect()->back()->with(['success' => 'Department Updated successfully']);

      } catch (\Exception $e) {
        return redirect()->back()->with(['error' => 'Unable to Update ' .$e->getMessage()])->withInput();
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
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index')->with(['message' => 'Department deleted Successfully']);
      } catch (\Exception $e) {
        return redirect()->route('departments.index')->with(['error' => 'Unable to find Department with this ID']);
      }
    }
}
