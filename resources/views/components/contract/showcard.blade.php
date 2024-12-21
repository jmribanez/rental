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
    <div class="mb-3">
        <div class="d-flex justify-content-between">
            <p class="m-0 fw-bold">Balance</p>
            <p class="m-0">{{$contract->getBalance()}}</p>
        </div>
        @if($contract->lastPayment() != null)
        <p class="m-0 small">Last payment: {{$contract->lastPayment()->getDatePayment()}}</p>
        <p class="m-0 small">Covers: {{$contract->lastPayment()->getCoverageDate()}}</p>
        @else
        <p class="m-0 small">No payment made yet.</p>
        @endif
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{route('contract.show',$contract->id)}}" class="btn btn-sm btn-outline-secondary">Details</a>
    </div>
</div>