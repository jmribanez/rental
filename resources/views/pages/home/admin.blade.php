@extends('layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <h1>Welcome, {{Auth::user()->name_first}}</h1>
    <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-4">
        <div class="col mb-2">
            <div class="border rounded p-3 position-relative">
                <h1>5</h1>
                <p class="m-0"><i class="fa-solid fa-house"></i> <a href="{{route('property.index')}}" class="stretched-link text-decoration-none text-body">Properties</a></p>
            </div>
        </div>
        <div class="col mb-2">
            <div class="border rounded p-3 position-relative">
                <h1>3</h1>
                <p class="m-0"><i class="fa-solid fa-user-group"></i> <a href="{{route('tenant.index')}}" class="stretched-link text-decoration-none text-body">Tenants</a></p>
            </div>
        </div>
        <div class="col mb-2">
            <div class="border rounded p-3 position-relative">
                <h1>1</h1>
                <p class="m-0"><i class="fa-solid fa-user-clock"></i> <a href="{{route('property.index')}}" class="stretched-link text-decoration-none text-body">Behind payment</a></p>
            </div>
        </div>
        <div class="col mb-3">
            <div class="border rounded p-3">
                <h1>564,000.00</h1>
                <p class="m-0"><i class="fa-solid fa-peso-sign"></i> Collection to date</p>
            </div>
        </div>
      </div>
    <div class="row">
        <div class="col-md-6">
            <h3 class="fw-bold">Collections</h3>
            <div id="collections"></div>
        </div>
        <div class="col-md-6">
            <h3 class="fw-bold">Occupancy</h3>
            <div id="occupancy"></div>
        </div>
    </div>
    <script>
        var options1 = {
            chart: {
                type: 'bar',
                height: '400px',
            },
            series: [{
                name: 'collections',
                data: [40000,56000,38000,44000,60000,53000,56000,60000,57000,52000,48000]
            }],
            xaxis: {
                categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul', 'Aug','Sep','Oct','Nov']
            }
        }
        var chart1 = new ApexCharts(document.querySelector("#collections"), options1);
        chart1.render();
        var options2 = {
            chart: {
                type: 'pie',
                height: '400px',
            },
            series: [55, 44],
            labels: ['Occupied', 'Vacant']
        }
        var chart2 = new ApexCharts(document.querySelector("#occupancy"), options2);
        chart2.render();
    </script>
@endsection