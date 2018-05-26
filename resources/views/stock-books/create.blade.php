@extends('layouts.master')

@section('title')

Stock Book- {{ strtoupper($currentUser->healthFacility->name) . " " .strtoupper($currentUser->healthFacility->level) }}

@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-light">

            <h5> <b>{{ strtoupper($currentUser->healthFacility->name) . " " .strtoupper($currentUser->healthFacility->level) }} - Add Stock Stock Book</b> </h5>

            <div class="card-actions">
                <a href="{{ route('stock-cards.index') }}" class="btn">
                    <i class="fa fa-eye"></i>
                </a>

                <a href="{{ URL::current() }}" class="btn">
                    <i class="icon icon-refresh"></i>
                </a>
            </div>
        </div>

        <div class="card-body">
            Coming soon....

            <button type="button" onclick="loadUsers()" class="btn btn-sm btn-info" >Check Registered Users</button>

        </div>
    </div>
@endsection

@section('script')

@endsection
