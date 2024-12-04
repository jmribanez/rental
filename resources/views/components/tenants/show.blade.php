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
    <div class="row">
        <div class="col-lg-6 mb-2">
            <p class="m-0 mb-1 fw-bold">Balance</p>
            <div class="border rounded p-3">
                <div class="d-flex justify-content-between">
                    <p class="m-0 fw-bold">Amount</p>
                    <p class="m-0"><em>Up-to-date</em></p>
                </div>
                <p class="m-0 small">Last payment: November 16, 2024</p>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <p class="m-0 mb-1 fw-bold">Active Contract</p>
            <div class="border rounded p-3">
                <div class="d-flex justify-content-between">
                    <p class="m-0 fw-bold">Monthly Rent</p>
                    <p class="m-0">Php 12,300.00</p>
                </div>
                <p class="m-0 small">Jan 1, 2024 to Dec 31, 2024</p>
            </div>
        </div>
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
    </div>
    <div class="d-flex mb-1 align-items-center">
        <p class="m-0 me-auto fw-bold">Invoice</p>
        <a href="#" class="btn btn-sm btn-outline-secondary me-2"><i class="fa-solid fa-bars"></i></a>
        <a href="#" class="btn btn-sm btn-primary me-2"><i class="fa-solid fa-plus"></i></a>
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
    </div>
    <div class="d-flex">
        <a href="{{route('tenant.index')}}" class="btn btn-sm btn-outline-secondary me-auto">Cancel</a>
        <a href="{{route('tenant.contracts',$selectedTenant->id)}}" class="btn btn-sm btn-outline-secondary me-2">Contracts</a>
        <a href="{{route('user.show',$selectedTenant->id)}}" class="btn btn-sm btn-outline-secondary">User Details</a>
    </div>
</div>