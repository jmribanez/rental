<div class="border rounded p-3 mb-3">
    <div class="d-flex justify-content-between align-items-baseline">
        <p class="m-0 fw-bold">{{$contract->tenant->fullName()}}</p>
        <p class="m-0 small">Php {{$contract->amountrentalToString()}} /mo.</p>
    </div>
    <p class="m-0 small">{{$contract->contractDateToString()}}</p>
    @switch($status)
        @case('Active')
        <p class="m-0 small"><i class="fa-solid fa-circle-check text-success"></i> Active Contract</p>
        @break
        @case('Last')
        <p class="m-0 small"><i class="fa-solid fa-circle-chevron-left text-warning"></i> Last Contract</p>
        @break
        @default
        <p class="m-0 small"><i class="fa-solid fa-circle text-secondary"></i> Old Contract</p>
        @break
    @endswitch
    <hr class="my-2">
    <div class="row">
        <div class="col mb-2">
            <p class="m-0 small">Contract Date</p>
            <p class="m-0">{{date('F j, Y',strtotime($contract->date_contract))}}</p>
        </div>
        <div class="col mb-2">
            <p class="m-0 small">Security Deposit</p>
            <p class="m-0">Php {{number_format($contract->amount_security_deposit, 2)}}</p>
        </div>
    </div>
    <hr class="my-2">
    <div class="mb-3">
        <div class="d-flex justify-content-between">
            <p class="m-0 fw-bold">Balance</p>
            <p class="m-0"><em>Up-to-date</em></p>
        </div>
        @if($contract->lastPayment() != null)
        <p class="m-0 small">Last payment: {{$contract->lastPayment()->getDatePayment()}}</p>
        <p class="m-0 small">Covers: {{$contract->lastPayment()->getCoverageDate()}}</p>
        @else
        <p class="m-0 small">No payment made yet.</p>
        @endif        
    </div>
    <div class="d-flex">
        <a href="{{route('property.contract.index',$contract->property->id)}}" class="btn btn-sm btn-outline-secondary me-auto">Cancel</a>
        <a href="{{route('contract.edit',$contract->id)}}" class="btn btn-sm btn-outline-secondary">Edit</a>
    </div>
</div>