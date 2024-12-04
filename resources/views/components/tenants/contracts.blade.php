<div>
    <div class="d-flex align-items-center mb-2">
        <img src="{{($selectedTenant->photo_url != null)?asset('storage/user_photos/'.$selectedTenant->photo_url):asset('storage/user_photos/usernophoto.jpg')}}" alt="user photo" style="width: 70px; height: 70px; object-fit:cover" class="img-thumbnail me-2">
        <div class="flex-grow-1">
            <h3 class="m-0">{{$selectedTenant->name_first . " " . $selectedTenant->name_last}}</h3>
            <div class="row">
                <div class="col-md-6">
                    <i class="fa-regular fa-envelope"></i> {{$selectedTenant->email}}
                </div>
                <div class="col-md-6">
                    <i class="fa-solid fa-phone"></i> {!!$selectedTenant->contact_number??'<em>Not set</em>'!!}
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex mb-1 align-items-center">
        <p class="m-0 me-auto fw-bold">All Tenant Contracts</p>
    </div>
    <div class="list-group mb-3">
    @if(count($selectedTenant->contracts)>0)
        @foreach ($selectedTenant->contracts as $contract)
        <a href="{{route('contract.show',$contract->id)}}" class="list-group-item list-group item-action">
            <div class="row">
                <div class="col">{{$contract->property->name}}</div>
                <div class="col d-none d-lg-block">{{$contract->date_start}} to {{$contract->date_end}}</div>
                <div class="col-4 col-lg-3 text-end">Php {{$contract->amount_rental}}</div>
            </div>
        </a>
        @endforeach
        @else
        <div class="list-group-item"><em class="text-secondary">No contracts</em></div>
    @endif
    </div>
    <div class="d-flex">
        <a href="{{route('tenant.show',$selectedTenant->id)}}" class="btn btn-sm btn-outline-secondary me-auto">Back</a>
    </div>
</div>