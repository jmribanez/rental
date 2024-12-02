@extends('layouts.app')
@section('content')
<h1 class="mb-3"><a href="{{route('property.show',$contract->property->id)}}" class="text-dark text-decoration-none">{{$contract->property->name}}</a></h1>
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card">
            <img src="{{($contract->property->photo_url != null)?asset('storage/property_photos/'.$contract->property->photo_url):asset('storage/property_photos/propertynophoto.jpg')}}" style="height: 150px; object-fit:cover;" class="card-img-top" alt="...">
            <div class="card-body">
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
                <div class="mb-2">
                    <p class="fw-bold m-0">Utilities</p>
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
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <h3 class="m-0 mb-3">Contract</h3>
        <div class="row">
            <div class="col-md-6 mb-2">
                <h5 class="m-0">{{$contract->tenant->name_first . ' ' . $contract->tenant->name_last}}</h5>
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
@endsection