<div>
    <h3>Details</h3>
    <div class="row row-cols-2">
        <div class="col mb-2">
            <p class="m-0 small">Date paid</p>
            <p class="m-0">{{$selectedPayment->getDatePayment()}}</p>
        </div>
        <div class="col mb-2">
            <p class="m-0 small">Received by</p>
            <p class="m-0">{{$selectedPayment->receiver->fullName()}}</p>
        </div>
        <div class="col mb-2">
            <p class="m-0 small">Amount</p>
            <p class="m-0">Php {{$selectedPayment->amountToString()}}</p>
        </div>
        <div class="col mb-2">
            <p class="m-0 small">OR Number</p>
            <p class="m-0">{{$selectedPayment->or_number}}</p>
        </div>
        <div class="col mb-2">
            <p class="m-0 small">Coverage</p>
            <p class="m-0">{{$selectedPayment->getCoverageDate()}}</p>
        </div>
        <div class="col mb-2">
            <p class="m-0 small">Payment Mode</p>
            <p class="m-0">{{$selectedPayment->payment_mode}}</p>
        </div>
        @if($selectedPayment->check_number != null)
        <div class="col mb-2">
            <p class="m-0 small">Reference number</p>
            <p class="m-0">{{$selectedPayment->check_number}}</p>
        </div>
        @endif
        @if($selectedPayment->check_date != null)
        <div class="col mb-2">
            <p class="m-0 small">Reference date</p>
            <p class="m-0">{{$selectedPayment->check_date}}</p>
        </div>
        @endif
        @if($selectedPayment->check_bank != null)
        <div class="col mb-2">
            <p class="m-0 small">Reference bank</p>
            <p class="m-0">{{$selectedPayment->check_bank}}</p>
        </div>
        @endif
        <div class="col mb-2">
            <p class="m-0 small">Notes</p>
            <p class="m-0">{!!$selectedPayment->notes??'<em>No notes saved.</em>'!!}</p>
        </div>
    </div>
    <hr class="my-2">
    <p class="m-0 mb-1">For the contract of</p>
    <div class="px-3 py-2 position-relative bg-secondary-subtle rounded mb-3">
        <div class="d-flex justify-content-between">
            <p class="m-0 fw-bold"><a href="{{route('contract.show', $selectedPayment->contract->id)}}" class="text-dark text-decoration-none stretched-link">{{$selectedPayment->contract->tenant->fullName()}}</a></p>
            <p class="m-0">Php {{$selectedPayment->contract->amountrentalToString()}} /mo</p>
        </div>
        <p class="m-0 small">{{$selectedPayment->contract->contractDateToString()}}</p>
    </div>
    <div class="d-flex justify-content-start">
        <a href="{{route('payment.create',['c'=>$selectedPayment->contract->id])}}" class="btn btn-sm btn-outline-primary me-auto">New payment</a>
        <a href="{{route('payment.edit',$selectedPayment->id)}}" class="btn btn-sm btn-outline-secondary">Edit</a>
    </div>
</div>