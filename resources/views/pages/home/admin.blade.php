@extends('layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <h1>Welcome, {{Auth::user()->name_first}}</h1>
    <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-4">
        <div class="col mb-2">
            <div class="border rounded p-3 position-relative">
                <h1>{{$counts['properties']}}</h1>
                <p class="m-0"><i class="fa-solid fa-house"></i> <a href="{{route('property.index')}}" class="stretched-link text-decoration-none text-body">Properties</a></p>
            </div>
        </div>
        <div class="col mb-2">
            <div class="border rounded p-3 position-relative">
                <h1>{{number_format($counts['forCollection'],2)}}</h1>
                <p class="m-0"><i class="fa-solid fa-user-clock"></i> <a href="{{route('tenant.index')}}" class="stretched-link text-decoration-none text-body">For collection from {{$counts['tenantsForCollection']}} people</a></p>
            </div>
        </div>
        <div class="col mb-2">
            <div class="border rounded p-3 position-relative">
                <h1>{{number_format($counts['collectionToDate'],2)}}</h1>
                <p class="m-0"><i class="fa-solid fa-peso-sign"></i> Collection to date<a href="{{route('payment.index')}}" class="stretched-link text-decoration-none text-body"></a></p>
            </div>
        </div>
        <div class="col mb-2">
            <div class="border rounded p-3 position-relative">
                <h1>Report</h1>
                <p class="m-0"><i class="fa-solid fa-chart-line"></i> {{date('F Y')}}<a href="{{route('report',[date('Y'),date('m')])}}" class="stretched-link text-decoration-none text-body"></a></p>
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
                data: [
                    @while(count($collectionData[1])>0)
                        '{{array_pop($collectionData[1])}}',
                    @endwhile
                ]
            }],
            xaxis: {
                categories: [
                    @while(count($collectionData[0])>0)
                        '{{array_pop($collectionData[0])}}',
                    @endwhile
                ]
            }
        }
        var chart1 = new ApexCharts(document.querySelector("#collections"), options1);
        chart1.render();
        var options2 = {
            chart: {
                type: 'pie',
                height: '400px',
            },
            series: [{{$counts['occupied']}}, {{$counts['vacant']}}],
            labels: ['Occupied', 'Vacant']
        }
        var chart2 = new ApexCharts(document.querySelector("#occupancy"), options2);
        chart2.render();
    </script>
@endsection