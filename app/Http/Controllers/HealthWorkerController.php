<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\HealthWorker;
use Validator;

class HealthWorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $healthWorkers = User::with('healthFacility')->where('health_facility_id', Auth::user()->health_facility_id)->get();
        return view('health-workers.index', compact('healthWorkers'));
    }

    public function create()
    {
        return view('health-workers.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
          'name' => 'required|string|max:50',
          'email' => 'required|email|unique:health_workers,email',
          'phone' => 'required|max:15|unique:health_workers,phone',
          'gender' => 'required|string',
          'address' => 'required|string|max:50'
        ])->validate();

        try {
          $password = 'secret';

          $healthWorker = new HealthWorker();
          $healthWorker->name = $request->name;
          $healthWorker->phone = $request->phone;
          $healthWorker->email = $request->email;
          $healthWorker->health_facility_id = Auth::user()->health_facility_id;
          $healthWorker->gender = $request->gender;
          $healthWorker->address = $request->address;
          $healthWorker->status = true;
          $healthWorker->password = bcrypt($password);
          $healthWorker->save();

          return back()->with('success', 'New Health Worker Added with Password = '. $password);

        } catch (\Exception $e) {
          return back()->with('error', 'Sorry, Data insertion Failed - '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
          'name' => 'required|string|max:50',
          'email' => 'required|email',
          'phone' => 'required|max:15',
          'gender' => 'required|string',
          'address' => 'required|string|max:50'
        ])->validate();

        try {
          $healthWorker = HealthWorker::findOrFail($id);
          $healthWorker->name = $request->name;
          $healthWorker->phone = $request->phone;
          $healthWorker->email = $request->email;
          $healthWorker->gender = $request->gender;
          $healthWorker->address = $request->address;
          $healthWorker->save();
          return back()->with('success', 'Profile Updated successfully.');

        } catch (\Exception $e) {
          return back()->with('error', 'Sorry, Unable to Update ');
        }

    }

    public function destroy($id)
    {
        //
    }
}
