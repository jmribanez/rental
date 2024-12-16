<div>
    <form action="{{route('payment.store')}}" method="post">
        @csrf
        <h3>New payment</h3>
        <p class="m-0 mb-1">For the contract of</p>
        <div class="px-3">
            <div class="d-flex justify-content-between">
                <p class="m-0 fw-bold">{{$contract->tenant->fullName()}}</p>
                <p class="m-0">Php {{$contract->amount_rental}}</p>
            </div>
            <p class="m-0 small mb-3">{{$contract->contractDateToString()}}</p>
        </div>
        <div class="row row-cols-2">
            <div class="col mb-2">
                <label for="txtdatepayment" class="form-label">Date paid<span class="text-danger">*</span></label>
                <input type="date" name="date_payment" id="txtdatepayment" value="{{date('Y-m-d')}}" class="form-control" required>
            </div>
            <div class="col mb-2">
                <label for="txtreceiver" class="form-label">Received by<span class="text-danger">*</span></label>
                <input type="text" id="txtreceiver" value="{{Auth::user()->fullName()}}" class="form-control" disabled>
            </div>
            <div class="col mb-2">
                <label for="txtdatecoveragestart" class="form-label">Covered from<span class="text-danger">*</span></label>
                <input type="date" name="date_coverage_start" id="txtdatecoveragestart" class="form-control" required>
            </div>
            <div class="col mb-2">
                <label for="txtdatecoverageend" class="form-label">Covered until<span class="text-danger">*</span></label>
                <input type="date" name="date_coverage_end" id="txtdatecoverageend" class="form-control" required>
            </div>
            <div class="col mb-2"></div>
        </div>
    </form>
</div>