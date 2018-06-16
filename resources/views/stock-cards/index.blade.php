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
        <div class="p-4">
            <canvas id="bar-chart" width="100%" height="50"></canvas>
        </div>
    </div>
@endsection

@section('script')

<script type="text/javascript">

$(document).ready(function () {

var barChart = $('#bar-chart');

if (barChart.length > 0) {
    new Chart(barChart, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Cyan", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(244, 88, 70, 0.5)',
                    'rgba(33, 150, 243, 0.5)',
                    'rgba(0, 188, 212, 0.5)',
                    'rgba(42, 185, 127, 0.5)',
                    'rgba(156, 39, 176, 0.5)',
                    'rgba(253, 178, 68, 0.5)'
                ],
                borderColor: [
                    '#F45846',
                    '#2196F3',
                    '#00BCD4',
                    '#2ab97f',
                    '#9C27B0',
                    '#fdb244'
                ],
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

});

</script>
@endsection
