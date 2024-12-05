@extends('layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <h1>Welcome, {{Auth::user()->name_first}}</h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
        <div class="col">Column</div>
        <div class="col">Column</div>
        <div class="col">Column</div>
        <div class="col">Column</div>
      </div>
    <div class="row">
        <div class="col-md-6">
            <div id="collections"></div>
        </div>
        <div class="col-md-6">
            <div id="occupancy"></div>
        </div>
    </div>
    <script>
        var options1 = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'collections',
                data: [30,40,35,50,49,60,70,91,125]
            }],
            xaxis: {
                categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
            }
        }
        var chart1 = new ApexCharts(document.querySelector("#collections"), options1);
        chart1.render();
        var options2 = {
            chart: {
                type: 'pie'
            },
            series: [44, 55],
            labels: ['Occupied', 'Vacant']
        }
        var chart2 = new ApexCharts(document.querySelector("#occupancy"), options2);
        chart2.render();
    </script>
@endsection