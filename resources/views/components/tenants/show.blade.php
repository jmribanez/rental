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
            <div class="border position-relative rounded p-3">
                <div class="d-flex justify-content-between">
                    <p class="m-0 fw-bold">Amount @if($selectedTenant->lastPayment() != null) <a href="{{route('payment.show',$selectedTenant->lastPayment()->id)}}" class="text-dark text-decoration-none stretched-link"></a> @endif</p>
                    <p class="m-0">@if($selectedTenant->getBalanceRaw()>0) {{number_format($selectedTenant->getBalanceRaw(),2)}} @else <em>Up-to-date</em> @endif</p>
                </div>
                <p class="m-0 small">@if($selectedTenant->lastPayment() != null) Last payment: {{date('M j, Y',strtotime($selectedTenant->lastPayment()->date_payment))}} @else <em>No previous payment.</em> @endif </p>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <p class="m-0 mb-1 fw-bold">Contract</p>
            <div class="border position-relative rounded p-3">
                <?php $contractId = null; ?>
                @switch($status)
                    @case('Active')
                    <div class="d-flex justify-content-between">
                        <p class="m-0 fw-bold"><a href="{{route('contract.show', $selectedTenant->activeContract()->id)}}" class="text-dark text-decoration-none stretched-link">Active</a></p>
                        <p class="m-0">{{$selectedTenant->activeContract()->amountrentalToString()}} /mo</p>
                    </div>
                    <p class="m-0 small">{{$selectedTenant->activeContract()->contractMidDateToString()}}</p>
                    <?php $contractId = $selectedTenant->activeContract()->id; ?>
                    @break
                    @case('Previous')
                    <div class="d-flex justify-content-between">
                        <p class="m-0 fw-bold"><a href="{{route('contract.show', $selectedTenant->lastContract()->id)}}" class="text-dark text-decoration-none stretched-link">Previous</a></p>
                        <p class="m-0">{{$selectedTenant->lastContract()->amountrentalToString()}} /mo</p>
                    </div>
                    <p class="m-0 small">{{$selectedTenant->lastContract()->contractMidDateToString()}}</p>
                    <?php $contractId = $selectedTenant->lastContract()->id; ?>
                    @break
                    @default
                    <div class="d-flex justify-content-start">
                        <p class="m-0 fw-bold">No active or previous contract</p>
                    </div>
                    <p class="m-0 small">--</p>
                    @break
                @endswitch
            </div>
        </div>
    </div>
    <div class="d-flex mb-1 align-items-center">
        <p class="m-0 me-auto fw-bold">Payments</p>
        @if($contractId)
        <a href="{{route('payment.create',['c'=>$contractId])}}" class="btn btn-sm btn-primary me-2"><i class="fa-solid fa-plus"></i></a>
        @endif
    </div>
    <div class="list-group list-group-flush mb-3">
        @if(count($paymentHistory)>0)
        @foreach($paymentHistory as $ph)
        <a href="{{route('payment.show',$ph['id'])}}" class="list-group-item list-group-item-action">
            <div class="d-flex justify-content-between">
                <p class="m-0">{{date('M j, Y',strtotime($ph['date_payment']))}}</p>
                <p class="m-0">Php {{number_format($ph['amount'],2)}}</p>
            </div>
        </a>
        @endforeach
        @else
        <div class="list-group-item">
            <em class="text-secondary">No payments made.</em>
        </div>
        @endif
    </div>
    <div class="d-flex">
        <a href="{{route('tenant.index')}}" class="btn btn-sm btn-outline-secondary me-auto">Cancel</a>
        <a href="{{route('tenant.contracts',$selectedTenant->id)}}" class="btn btn-sm btn-outline-secondary me-2">Contracts</a>
        <a href="{{route('user.show',$selectedTenant->id)}}" class="btn btn-sm btn-outline-secondary">User Details</a>
    </div>
</div>