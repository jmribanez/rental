@extends('layouts.app')
@section('content')
    <h1 class="mb-3"><a href="{{route('property.show',$property->id)}}" class="text-dark text-decoration-none">{{$property->name}}</a></h1>
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
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="m-0">Contracts</h3>
                <a href="{{route('property.contract.create',$property->id)}}" class="btn btn-sm btn-outline-primary">New</a>
            </div>
            <div class="list-group">
                @if(count($property->contracts)>0)
                @foreach ($property->contracts as $contract)
                <a href="{{route('contract.show',$contract->id)}}" class="list-group-item list-group item-action">
                    <div class="row">
                        <div class="col">{{$contract->tenant->name_first . ' ' . $contract->tenant->name_last}}</div>
                        <div class="col d-none d-lg-block">{{$contract->date_start}} to {{$contract->date_end}}</div>
                        <div class="col-4 col-lg-3 text-end">Php {{$contract->amount_rental}}</div>
                    </div>
                </a>
                @endforeach
                
                @else
                <div class="list-group-item"><em class="text-secondary">No contracts</em></div>
                @endif
            </div>
        </div>
    </div>
@endsection