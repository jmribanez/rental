@extends('layouts.app')
@section('content')
<h1 class="mb-3"><a href="{{route('property.show',$contract->property->id)}}" class="text-dark text-decoration-none">{{$contract->property->name}}</a></h1>
<div class="row">
    <div class="col-md-4 mb-3">
        <x-property.showcard :property="$contract->property" />
    </div>
    <div class="col-md-4 mb-3">
        <h3 class="m-0 mb-3">Contract</h3>
        <div class="row">
            <div class="col-md-6 mb-2">
                <h5 class="m-0">{{$contract->tenant->fullName()}}</h5>
                <p class="m-0 small">Tenant</p>
            </div>
            <div class="col-md-6 mb-2">
                <h5 class="m-0">{{$contract->date_contract}}</h5>
                <p class="m-0 small">Contract Date</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2">
                <h5 class="m-0">{{$contract->date_start}}</h5>
                <p class="m-0 small">Start Date</p>
            </div>
            <div class="col-md-6 mb-2">
                <h5 class="m-0">{{$contract->date_end}}</h5>
                <p class="m-0 small">End Date</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2">
                <h5 class="m-0">{{$contract->amount_rental}}</h5>
                <p class="m-0 small">Rental Amount</p>
            </div>
            <div class="col-md-6 mb-2">
                <h5 class="m-0">{{$contract->amount_security_deposit}}</h5>
                <p class="m-0 small">Security Deposit</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-2">
                <h5 class="m-0">{{$contract->invoice_day}}</h5>
                <p class="m-0 small">Cut-off day</p>
            </div>
            <div class="col-md-4 mb-2">
                <h5 class="m-0">{{$contract->agreed_payment_mode??'Not set'}}</h5>
                <p class="m-0 small">Agreed Payment Mode</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5 class="m-0">
                    {!!($contract->scanned_contract_file != null)?'<h5 class="m-0"><a href="'.asset('storage/scanned_contracts/'.$contract->scanned_contract_file).'">View file</a></h5>':'<h5 class="m-0">Not set</h5'!!}
                </h5>
                <p class="m-0 small">Scanned Contract</p>
            </div>
        </div>
        <div class="d-flex">
            <a href="{{route('property.contract.index',$contract->property->id)}}" class="btn btn-outline-secondary me-auto">Cancel</a>
            <a href="{{route('contract.edit',$contract->id)}}" class="btn btn-secondary">Edit</a>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <p class="m-0 mb-1 fw-bold">Balance</p>
        <div class="border rounded p-3 mb-3">
            <div class="d-flex justify-content-between">
                <p class="m-0 fw-bold">Amount</p>
                <p class="m-0"><em>Up-to-date</em></p>
            </div>
            <p class="m-0 small">Last payment: November 16, 2024</p>
        </div>
        <div class="d-flex mb-1 align-items-center">
            <p class="m-0 me-auto fw-bold">Invoice</p>
            <a href="#" class="btn btn-sm btn-outline-secondary me-2"><i class="fa-solid fa-bars"></i></a>
            <a href="#" class="btn btn-sm btn-primary me-2"><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="list-group list-group-flush mb-3">
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="m-0">November 1, 2024</p>
                    <p class="m-0">Php 12,300.00</p>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="m-0">October 1, 2024</p>
                    <p class="m-0">Php 12,300.00</p>
                </div>
            </a>
        </div>
        <div class="d-flex mb-1 align-items-center">
            <p class="m-0 me-auto fw-bold">Payments</p>
            <a href="#" class="btn btn-sm btn-outline-secondary me-2"><i class="fa-solid fa-bars"></i></a>
            <a href="#" class="btn btn-sm btn-primary me-2"><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="list-group list-group-flush mb-3">
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="m-0">November 16, 2024</p>
                    <p class="m-0">Php 12,300.00</p>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="m-0">October 13, 2024</p>
                    <p class="m-0">Php 12,300.00</p>
                </div>
            </a>
        </div>
    </div>
@endsection