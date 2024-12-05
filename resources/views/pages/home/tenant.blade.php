@extends('layouts.app')
@section('content')
    <h1>Welcome, {{Auth::user()->name_first}}</h1>
    <div class="row">
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
        </div>
        <div class="col-md-4 mb-3">
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
        <div class="col-md-4 mb-3">
            @if(count($contract)>0) <?php $contract = $contract[0]; ?>
            <div class="card">
                <img src="{{($contract->property->photo_url != null)?asset('storage/property_photos/'.$contract->property->photo_url):asset('storage/property_photos/propertynophoto.jpg')}}" style="height: 150px; object-fit:cover;" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$contract->property->name}}</h5>
                    <div class="mb-2">
                        <p class="card-text mb-0">{{$contract->property->address_street}}</p>
                        <p class="card-text">{{$contract->property->address_city}}</p>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <p class="m-0">{{$contract->property->bedrooms??'--'}}</p>
                            <p class="small m-0">Bedrooms</p>
                        </div>
                        <div>
                            <p class="m-0">{{$contract->property->bathrooms??'--'}}</p>
                            <p class="small m-0">Bathrooms</p>
                        </div>
                        <div>
                            <p class="m-0">{{$contract->property->floor_area??'--'}}</p>
                            <p class="small m-0">Floor area</p>
                        </div>
                        <div>
                            <p class="m-0">{{$contract->property->land_size??'--'}}</p>
                            <p class="small m-0">Land size</p>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="d-flex justify-content-start align-items-center">
                            <p class="fw-bold m-0">Utilities</p>
                        </div>
                        @if(count($contract->property->utilities)>0)
                        <ul class="list-group list-group-flush">
                            @foreach ($contract->property->utilities as $pk => $pu)
                            <li class="list-group-item d-flex">
                                <a href="{{route('utility.show',$pu->id)}}" class="text-decoration-none text-dark">{{$pu->name}}</a>
                                <span class="ms-auto">{{$pu->pivot->account_number}}</span>
                            </li>
                            @endforeach
                        </ul>
                        @else
                            <p class="m-0"><em>No utilities added.</em></p>
                        @endif
                    </div>
                    <hr class="my-2">
                    <p class="m-0 mb-1 fw-bold">Active Contract</p>
                    <div class="px-3">
                        <div class="d-flex justify-content-between">
                            <p class="m-0 fw-bold">Juan Dela Cruz</p>
                            <p class="m-0">Php 12,300.00</p>
                        </div>
                        <p class="m-0 small mb-3">January 1, 2024 to December 31, 2024</p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{route('property.contract.index',$contract->property->id)}}" class="btn btn-sm btn-outline-primary">Your Contracts</a>
                    </div>
                </div>
            </div>
            @else
            <div class="border p-3 rounded">
                <p class="m-0 text-center">No contracts</p>
            </div>
            @endif
        </div>
    </div>
@endsection