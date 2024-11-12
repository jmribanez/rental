@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center mb-3">
        <h1 class="mb-0 me-auto">Properties</h1>
        <a href="{{route('property.create')}}" class="btn btn-outline-primary">New</a>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @if(count($properties)>0)
        @foreach($properties as $property)
            <div class="col">
                <div class="card">
                    <img src="{{($property->photo_url != null)?asset('storage/property_photos/'.$property->photo_url):asset('storage/property_photos/propertynophoto.jpg')}}" style="height: 100px; object-fit:cover;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('property.show',$property->id)}}" class="stretched-link text-decoration-none text-dark">{{$property->name}}</a></h5>
                        <p class="card-text mb-0">{{$property->address_street}}</p>
                        <p class="card-text">{{$property->address_city}}</p>
                    </div>
                </div>
            </div>
        @endforeach
        @else
        <div class="col">
            <h5>No properties listed</h5>
        </div>
        @endif
    </div>
@endsection