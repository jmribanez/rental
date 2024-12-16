@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center mb-3">
        <h1 class="mb-0 me-auto">{{$property->name}}</h1>
        <a href="{{route('property.edit',$property->id)}}" class="btn btn-outline-secondary">Edit</a>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{($property->photo_url != null)?asset('storage/property_photos/'.$property->photo_url):asset('storage/property_photos/propertynophoto.jpg')}}" style="height: 150px; object-fit:cover;" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="mb-2">
                        <p class="card-text mb-0">{{$property->address_street}}</p>
                        <p class="card-text">{{$property->address_city}}</p>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <p class="m-0">{{$property->bedrooms??'--'}}</p>
                            <p class="small m-0">Bedrooms</p>
                        </div>
                        <div>
                            <p class="m-0">{{$property->bathrooms??'--'}}</p>
                            <p class="small m-0">Bathrooms</p>
                        </div>
                        <div>
                            <p class="m-0">{{$property->floor_area??'--'}}</p>
                            <p class="small m-0">Floor area</p>
                        </div>
                        <div>
                            <p class="m-0">{{$property->land_size??'--'}}</p>
                            <p class="small m-0">Land size</p>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="d-flex justify-content-start align-items-center">
                            <p class="fw-bold m-0">Utilities</p>
                        </div>
                        @if(count($property->utilities)>0)
                        <ul class="list-group list-group-flush">
                            @foreach ($property->utilities as $pk => $pu)
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
                    <p class="m-0 mb-1 fw-bold">Landlord</p>
                    <div class="px-3 d-flex justify-contents-start align-items-center">
                        @if ($property->landlord != null)
                            <p class="m-0">{{$property->landlord->fullName()}}</p>
                        @else
                            <p class="m-0"><em>No landlord set.</em></p>
                        @endif
                    </div>
                    <hr class="my-2">
                    <p class="m-0 mb-1 fw-bold">Active Contract</p>
                    <div class="px-3">
                        @if($property->activeContract() != null)
                        <div class="d-flex justify-content-between">
                            <p class="m-0 fw-bold">{{$property->activeContract()->tenant->fullName()}}</p>
                            <p class="m-0">Php {{$property->activeContract()->amount_rental}}</p>
                        </div>
                        <p class="m-0 small mb-3">{{$property->activeContract()->contractDateToString()}}</p>
                        @else
                        <p class="m-0"><em>No active contract</em></p>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{route('property.contract.index',$property->id)}}" class="btn btn-sm btn-outline-primary">Manage Contracts</a>
                    </div>
                </div>
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