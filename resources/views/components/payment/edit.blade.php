<div>
    <form action="{{route('payment.update',$selectedPayment->id)}}" method="post">
        @csrf
        @method('PATCH')
        <h3>Edit payment</h3>
        <p class="m-0 mb-1">For the contract of</p>
        <div class="px-3">
            <div class="d-flex justify-content-between">
                <p class="m-0 fw-bold">{{$selectedPayment->contract->tenant->fullName()}}</p>
                <p class="m-0">Php {{$selectedPayment->contract->amountrentalToString()}}</p>
            </div>
            <p class="m-0 small mb-3">{{$selectedPayment->contract->contractDateToString()}}</p>
        </div>
        <div class="row row-cols-2">
            <div class="col mb-2">
                <label for="txtdatepayment" class="form-label">Date paid<span class="text-danger">*</span></label>
                <input type="date" name="date_payment" id="txtdatepayment" value="{{$selectedPayment->date_payment}}" class="form-control" required>
            </div>
            <div class="col mb-2">
                <label for="txtreceiver" class="form-label">Received by<span class="text-danger">*</span></label>
                <input type="text" id="txtreceiver" value="{{$selectedPayment->receiver->fullName()}}" class="form-control" disabled>
            </div>
            <div class="col mb-2">
                <label for="txtdatecoveragestart" class="form-label">Covered from<span class="text-danger">*</span></label>
                <input type="date" name="date_coverage_start" id="txtdatecoveragestart" class="form-control" value="{{$selectedPayment->date_coverage_start}}" required>
            </div>
            <div class="col mb-2">
                <label for="txtdatecoverageend" class="form-label">Covered until<span class="text-danger">*</span></label>
                <input type="date" name="date_coverage_end" id="txtdatecoverageend" class="form-control" value="{{$selectedPayment->date_coverage_end}}" required>
            </div>
            <div class="col mb-2">
                <label for="txtamount" class="form-label">Amount<span class="text-danger">*</span></label>
                <input type="number" name="amount" id="txtamount" class="form-control" min="0" value="{{$selectedPayment->amount}}" required>
            </div>
            <div class="col mb-2">
                <label for="txtornumber" class="form-label">OR Number<span class="text-danger">*</span></label>
                <input type="text" name="or_number" id="txtornumber" class="form-control" value="{{$selectedPayment->or_number}}" required>
            </div>
            <div class="col mb-2">
                <label for="selpaymentmode" class="form-label">Payment Mode<span class="text-danger">*</span></label>
                <select name="payment_mode" id="selpaymentmode" class="form-select" required onchange="watchmode(event)">
                    <option value="Cash">Cash</option>
                    <option value="G Cash">G Cash</option>
                    <option value="Check">Check</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>
            <div class="col mb-2 d-none" id="edCN">
                <label for="txtchecknumber" class="form-label" id="lblCN">Check Number</label>
                <input type="text" name="check_number" id="txtchecknumber" class="form-control">
            </div>
            <div class="col mb-2 d-none" id="edCD">
                <label for="txtcheckdate" class="form-label" id="lblCD">Check Date</label>
                <input type="date" name="check_date" id="txtcheckdate" class="form-control">
            </div>
            <div class="col mb-2 d-none" id="edCB">
                <label for="txtcheckbank" class="form-label" id="lblCB">Check Bank</label>
                <input type="text" name="check_bank" id="txtcheckbank" class="form-control">
            </div>
            <div class="col mb-3">
                <label for="txtnotes" class="form-label">Notes</label>
                <input type="text" name="notes" id="txtnotes" class="form-control" value="{{$selectedPayment->notes}}">
            </div>
        </div>
        
        <div class="d-flex justify-content-end">
            <a href="{{route('payment.show',$selectedPayment->id)}}" class="btn btn-sm btn-outline-secondary me-auto">Cancel</a>
            <input type="submit" value="Save" class="btn btn-sm btn-primary">
        </div>
    </form>
    <script>
        function watchmode(e) {
            var mode = e.target.value;
            switch(mode) {
                case 'G Cash':
                    document.getElementById('edCN').classList.remove('d-none');
                    document.getElementById('edCD').classList.remove('d-none');
                    document.getElementById('lblCN').innerHTML = "Reference Number";
                    document.getElementById('lblCD').innerHTML = "Reference Date";
                    break;
                case 'Check':
                    document.getElementById('edCN').classList.remove('d-none');
                    document.getElementById('edCD').classList.remove('d-none');
                    document.getElementById('lblCN').innerHTML = "Check Number";
                    document.getElementById('lblCD').innerHTML = "Check Date";
                    break;
                case 'Bank Transfer':
                    document.getElementById('edCN').classList.remove('d-none');
                    document.getElementById('edCD').classList.remove('d-none');
                    document.getElementById('lblCN').innerHTML = "Reference Number";
                    document.getElementById('lblCD').innerHTML = "Reference Date";
                    break;
                default:
                    document.getElementById('edCN').classList.add('d-none');
                    document.getElementById('edCD').classList.add('d-none');
                    document.getElementById('edCB').classList.add('d-none');
                    break;
            }
        }
    </script>
</div>