@extends('layouts.app')
@section('content')
<h1 class="mb-3"><a href="{{route('property.show',$contract->property->id)}}" class="text-dark text-decoration-none">{{$contract->property->name}}</a></h1>
<div class="row">
    <div class="col-md-4 mb-3">
        <x-property.showcard :property="$contract->property" />
    </div>
    <div class="col-md-4 mb-3">
        <p class="m-0 mb-1 fw-bold">Contract and Balance</p>
        @if($contract->property->activeContract()->id == $contract->id)
            <x-contract.detailedcard :contract="$contract" status="Active" />
        @else
            @if ($contract->property->lastContract()->id == $contract->id)
                <x-contract.detailedcard :contract="$contract" status="Last" />
            @else
                <x-contract.nocontract />
            @endif
        @endif
    </div>
    <div class="col-md-4 mb-3">
        <div class="d-flex mb-1 align-items-center">
            <p class="m-0 me-auto fw-bold">Payments for this contract</p>
            {{-- <a href="#" class="btn btn-sm btn-outline-secondary me-2"><i class="fa-solid fa-bars"></i></a> --}}
            <a href="{{route('payment.create',['c'=>$contract->id])}}" class="btn btn-sm btn-primary me-2"><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="list-group list-group-flush mb-3">
            @if(count($contract->payments)>0)
            @foreach ($contract->payments as $payment)
            <a href="{{route('payment.show',$payment->id)}}" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="m-0">{{$payment->getDatePayment()}}</p>
                    <p class="m-0">Php {{$payment->amountToString()}}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="small m-0">{{$payment->or_number}}</p>
                    <p class="small m-0">{{$payment->getCoverageDate()}}</p>
                </div>
            </a>
            @endforeach
            @else
                <div class="list-group-item">
                    <em>No payments recorded for this property</em>
                </div>
            @endif
        </div>
    </div>
@endsection