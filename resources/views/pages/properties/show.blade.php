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
                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="fw-bold m-0">Utilities</p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddUtility" class="small link-underline link-underline-opacity-0"><i class="fa-solid fa-plus"></i> Add</a>
                        </div>
                        @if(count($property->utilities)>0)
                        @foreach ($property->utilities as $pu)
                        <form action="{{route('property.unsetUtility',$property->id)}}" method="post" class="d-flex align-items-center mb-1">
                            @csrf
                            <input type="hidden" name="utility_id" value="{{$pu->id}}">
                            <span><a href="{{route('utility.show',$pu->id)}}" class="text-decoration-none">{{$pu->name}}</a></span>
                            <span class="ms-auto">{{$pu->pivot->account_number}}</span>
                            <button type="submit" class="btn btn-sm btn-link text-danger ms-1 p-0"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                        @endforeach
                        @else
                        <p class="m-0"><em>No utilities added.</em></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="d-flex justify-content-between">
                <h3 class="m-0">Contracts</h3>
                <a href="{{route('property.contract.index',$property->id)}}" class="btn btn-sm btn-outline-secondary">View</a>
            </div>
            <p class="m-0 mb-1 fw-bold">Active Contract</p>
            <div class="border rounded p-3 mb-3">
                <div class="d-flex justify-content-between">
                    <p class="m-0 fw-bold">Juan Dela Cruz</p>
                    <p class="m-0">Php 12,300.00</p>
                </div>
                <p class="m-0 small">January 1, 2024 to December 31, 2024</p>
            </div>
            <p class="m-0 mb-1 fw-bold">Previous Contracts</p>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex justify-content-between">
                        <p class="m-0 fw-bold">{{fake()->firstName() . " " . fake()->lastName()}}</p>
                        <p class="m-0">Php 12,300.00</p>
                    </div>
                    <p class="m-0 small">January 1, 2023 to December 31, 2023</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex justify-content-between">
                        <p class="m-0 fw-bold">{{fake()->firstName() . " " . fake()->lastName()}}</p>
                        <p class="m-0">Php 11,200.00</p>
                    </div>
                    <p class="m-0 small">January 1, 2022 to December 31, 2022</p>
                </a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <h3>Transactions</h3>
            <p class="m-0 mb-1 fw-bold">Balance</p>
            <div class="border rounded p-3 mb-3">
                <div class="d-flex justify-content-between">
                    <p class="m-0 fw-bold">Amount</p>
                    <p class="m-0"><em>Up-to-date</em></p>
                </div>
                <p class="m-0 small">Last payment: November 16, 2024</p>
            </div>
            <p class="m-0 mb-1 fw-bold">Payments</p>
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
            <p class="m-0 mb-1 fw-bold">Invoice</p>
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
        </div>
    </div>
    <div id="modalAddUtility" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="{{route('property.setUtility',$property->id)}}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Utility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="sel_utility_id" class="form-label">Utility provider</label>
                        <select name="utility_id" id="sel_utility_id" class="form-select">
                            @foreach ($available_utilities as $a_u)
                            <option value="{{$a_u->id}}">{{$a_u->type}} - {{$a_u->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="txt_account_number" class="form-label">Account number</label>
                        <input type="text" name="account_number" id="txt_account_number" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Add" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection