@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center mb-3">
        <h1 class="mb-0 me-auto">{{$property->name}}</h1>
        <a href="{{route('property.create')}}" class="btn btn-outline-secondary">Edit</a>
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
                        <p class="fw-bold m-0">Utilities</p>
                        <div class="d-flex justify-content-between">
                            <span>Angeles Electric Inc.</span>
                            <span>123-456-7890</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>PrimeWater Angeles Inc.</span>
                            <span>123-456-7890</span>
                        </div>
                    </div>
                    <div>
                        <p class="fw-bold m-0">Active Contract</p>
                        <div class="d-flex justify-content-between">
                            <span>Tenant</span>
                            <span>Juan Dela Cruz</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Monthly Rate</span>
                            <span>Php 12,300.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <h3>Contracts</h3>
        </div>
        <div class="col-md-4 mb-3">
            <h3>Transactions</h3>
        </div>
    </div>
@endsection