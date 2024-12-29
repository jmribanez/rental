@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center mb-3">
        <h1 class="mb-0 me-auto">Properties</h1>
        <a href="{{route('property.create')}}" class="btn btn-outline-primary">New</a>
        <form action="{{route('property.index')}}" method="get" class="mb-0 ms-3">
            <div class="input-group">
                <input type="text" name="q" id="txtq" class="form-control" required>
                <input type="submit" value="Search" class="btn btn-outline-secondary">
            </div>
        </form>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @if(count($properties)>0)
        @foreach($properties as $property)
            <div class="col">
                <div class="card">
                    <img src="{{($property->photo_url != null)?asset('storage/property_photos/'.$property->photo_url):asset('storage/property_photos/propertynophoto.jpg')}}" style="height: 100px; object-fit:cover;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('property.show',$property->id)}}" class="stretched-link text-decoration-none text-dark">{{$property->name}}</a></h5>
                        <p class="card-text m-0">{{$property->address_street}}</p>
                        <p class="card-text m-0">{{$property->address_city}}</p>
                        <hr class="my-1">
                        @if($property->activeContract() != null)
                        <p class="m-0 small"><i class="fa-solid fa-circle-check text-success"></i> {{$property->activeContract()->tenant->fullName()}}</p>
                        @else
                        <p class="m-0 small text-secondary"><i class="fa-regular fa-circle"></i> Unoccupied</p>
                        @endif
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