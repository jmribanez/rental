@extends('layouts.app')
@section('content')
    <header class="d-flex align-items-start mb-3">
        <?php $prev_year = clone $start_date; date_modify($prev_year, "-1 year"); ?>
        <?php $next_year = clone $start_date; date_modify($next_year, "+1 year"); ?>
        <?php $prev_date = clone $start_date; date_modify($prev_date, "-1 month"); ?>
        <?php $next_date = clone $start_date; date_modify($next_date, "+1 month"); ?>
        <div class="me-auto">
            <h1 class="m-0">Report for {{date_format($start_date,"F Y")}}</h1>
            <p class="m-0">{{date_format($start_date,"F j, Y")}} to {{date_format($end_date,"F j, Y")}}</p>
        </div>
        <div class="btn-group" role="group">
            <a href="{{route('report',[date_format($prev_year,"Y"),date_format($prev_year,"m")])}}" class="btn btn-outline-secondary"><i class="fa-solid fa-backward-fast"></i></a>
            <a href="{{route('report',[date_format($prev_date,"Y"),date_format($prev_date,"m")])}}" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i></a>
            <a href="{{route('report',[date("Y"),date("m")])}}" class="btn btn-outline-secondary">Today</a>
            <a href="{{route('report',[date_format($next_date,"Y"),date_format($next_date,"m")])}}" class="btn btn-outline-secondary"><i class="fa-solid fa-forward"></i></a>
            <a href="{{route('report',[date_format($next_year,"Y"),date_format($next_year,"m")])}}" class="btn btn-outline-secondary"><i class="fa-solid fa-forward-fast"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col-md-4">
            <h3>Property income</h3>
            <ul class="list-group">
                <?php $grandtotal = 0; ?>
                @if(count($properties)>0)
                @foreach ($properties as $p)
                <a href="{{route('property.show',$p->id)}}" class="list-group-item list-group-item-action d-flex justify-content-between"><p class="m-0">{{$p->name}}</p>
                    <?php $subtotal = $p->getSumPaymentsForDate($start_date, $end_date); $grandtotal += $subtotal ?>
                    <p class="m-0">{{number_format($subtotal,2)}}</p></a>
                @endforeach
                @else
                <li class="list-group-item">No property listed.</li>
                @endif
                <li class="list-group-item list-group-item-secondary fw-bold d-flex justify-content-between"><p class="m-0">TOTAL</p><p class="m-0">{{number_format($grandtotal,2)}}</p></li>
            </ul>
        </div>
        <div class="col-md-4">
            <h3 class="m-0">Delayed payments</h3>
        </div>
        <div class="col-md-4">
            <h3 class="m-0">Tenants with arrears</h3>
        </div>
    </div>
@endsection
