<div class="border rounded p-3 mb-3">
    <p class="m-0 fw-bold">{{$contract->tenant->fullName()}}</p>
    <p class="m-0 small">{{$contract->contractDateToString()}}</p>
    @switch($status)
        @case('Active')
        <p class="m-0 small"><i class="fa-solid fa-circle-check text-success"></i> Active Contract</p>
        @break
        @case('Last')
        <p class="m-0 small"><i class="fa-solid fa-circle-chevron-left text-warning"></i> Last Contract</p>
        @break
        @default
        <p class="m-0 small"><i class="fa-solid fa-circle-check text-secondary"></i> Inactive</p>
        @break
    @endswitch
    <hr class="my-2">
    <div class="d-flex justify-content-between">
        <p class="m-0 fw-bold">Balance</p>
        <p class="m-0"><em>Up-to-date</em></p>
    </div>
    <p class="m-0 small">Last payment: {{$contract->lastPayment()->getDatePayment()}}</p>
    <p class="m-0 small">Covers: {{$contract->lastPayment()->getCoverageDate()}}</p>
</div>