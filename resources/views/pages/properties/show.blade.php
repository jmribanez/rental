@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center mb-3">
        <h1 class="mb-0 me-auto">{{$property->name}}</h1>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <x-property.showcard :property="$property" />
        </div>
        <div class="col-md-4 mb-3">
            <p class="m-0 mb-1 fw-bold">Contract and Balance</p>
            @if($property->activeContract() != null)
                <x-contract.showcard :contract="$property->activeContract()" status="Active" />
            @else
                @if ($property->lastContract() != null)
                    <x-contract.showcard :contract="$property->lastContract()" status="Last" />
                @else
                    <x-contract.nocontract />
                @endif
            @endif
            <div class="d-flex mb-1 align-items-center">
                <p class="m-0 me-auto fw-bold">Payments</p>
                {{-- <a href="#" class="btn btn-sm btn-outline-secondary me-2"><i class="fa-solid fa-bars"></i></a> --}}
                <a href="{{route('property.newPayment',$property->id)}}" class="btn btn-sm btn-primary me-2"><i class="fa-solid fa-plus"></i></a>
            </div>
            <div class="list-group list-group-flush mb-3">
                @if(count($property->getPayments())>0)
                @foreach ($property->getPayments() as $payment)
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
        <div class="col-md-4 mb-3">
            <div class="border rounded p-3">
                @switch($payment_mode)
                    @case('create')
                        <x-payment.create :contract="$property->activeContract()" />
                        @break
                    @case('show')
                        
                        @break
                    @case('edit')
                        
                        @break
                    @default
                        <x-payment.noselection />
                        @break
                @endswitch
            </div>
        </div>
    </div>
    
@endsection