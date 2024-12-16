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
                <p class="m-0">Php {{$property->activeContract()->amountToString()}}</p>
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