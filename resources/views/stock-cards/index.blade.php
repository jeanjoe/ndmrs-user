@extends('layouts.master')

@section('title')

Stock Book- {{ $currentUser->healthFacility->name }}

@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-light">

            {{ $currentUser->healthFacility->name }} - Stock Book

            <div class="card-actions">
                <a href="{{ route('stock-books.create') }}" class="btn">
                    <i class="fa fa-plus-circle"></i>
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
