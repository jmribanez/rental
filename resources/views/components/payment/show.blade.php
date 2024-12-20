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
            <p class="m-0 small">Notes</p>
            <p class="m-0">{!!$selectedPayment->notes??'<em>No notes saved.</em>'!!}</p>
        </div>
    </div>
    <hr class="my-2">
    <p class="m-0 mb-1">For the contract of</p>
    <div class="px-3">
        <div class="d-flex justify-content-between">
            <p class="m-0 fw-bold">{{$selectedPayment->contract->tenant->fullName()}}</p>
            <p class="m-0">Php {{$selectedPayment->contract->amountrentalToString()}}</p>
        </div>
        <p class="m-0 small mb-3">{{$selectedPayment->contract->contractDateToString()}}</p>
    </div>
    <div class="d-flex justify-content-start">
        <a href="{{route('payment.create',['c'=>$selectedPayment->contract->id])}}" class="btn btn-sm btn-outline-primary me-auto">New payment</a>
        <a href="{{route('payment.edit',$selectedPayment->id)}}" class="btn btn-sm btn-outline-secondary">Edit</a>
    </div>
</div>