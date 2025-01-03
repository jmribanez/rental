@extends('layouts.app')
@section('content')
    <h1>Welcome, {{Auth::user()->name_first}}</h1>
    <div class="row">
        <div class="col-md-4 mb-3">
            <p class="m-0 me-auto fw-bold mb-2">Contract Details</p>
            @if($contract != null)
            <x-contract.detailedcard :contract="$contract" :status="$status" />
            @else
            <div class="p-3 border rounded">
                <p class="m-0 text-center">No contract</p>
            </div>
            @endif
        </div>
        <div class="col-md-4 mb-3">
            <p class="m-0 fw-bold mb-2">Payments</p>
            @if(count($paymentHistory)>0)
            <div class="list-group">
            @foreach($paymentHistory as $ph)
            <div class="list-group-item">
                <div class="d-flex">
                    <p class="m-0 me-auto">{{date('M j, Y',strtotime($ph['date_payment']))}}</p>
                    <p class="m-0">Php {{number_format($ph['amount'],2)}}</p>
                </div>
                <div class="d-flex small">
                    <p class="m-0 me-auto">{{date('M j, Y',strtotime($ph['date_coverage_start'])) . ' to ' . date('M j, Y',strtotime($ph['date_coverage_end']))}}</p>
                    <p class="m-0">OR {{$ph['or_number']}}</p>
                </div>
            </div>
            @endforeach
            @else
            <div class="list-group-item">
                <em class="text-secondary">No payments made.</em>
            </div>
            @endif
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <p class="m-0 me-auto fw-bold mb-2">Property Details</p>
            @if($contract != null)
                <x-property.showcard :property="$contract->property" />
            @else
            <div class="border p-3 rounded">
                <p class="m-0 text-center">No contract</p>
            </div>
            @endif
        </div>
    </div>
@endsection