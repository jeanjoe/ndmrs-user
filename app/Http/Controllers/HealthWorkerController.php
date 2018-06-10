<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

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
        //
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
