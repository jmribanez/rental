<div>
    <form action="{{route('payment.store')}}" method="post">
        @csrf
        <h3>New payment</h3>
        <p class="m-0 mb-1">For the contract of</p>
        <div class="px-3">
            <div class="d-flex justify-content-between">
                <p class="m-0 fw-bold">{{$contract->tenant->fullName()}}</p>
                <p class="m-0">Php {{$contract->getBalance()}}</p>
            </div>
            <p class="m-0 small mb-3">{{$contract->contractMidDateToString()}}</p>
            <input type="hidden" name="contract_id" value="{{$contract->id}}">
        </div>
        @if($contract->getBalance() > 0)
        <label class="form-label">Payment Coverage</label>
        <div class="d-flex align-items-start mb-2">
            <div class="btn-group me-3" role="group">
                <button type="button" class="btn btn-outline-primary" onclick="removepc()">-</button>
                <button type="button" class="btn btn-outline-primary" onclick="addpc()">+</button>
            </div>
            <div>
                <p class="m-0 small"><span id="pcMonth">1 month</span></p>
                <p class="m-0">Php <span id="pcAmount">{{$contract->amountrentalToString()}}</span></p>
                <p class="m-0 small" id="pcDates"></p>
            </div>
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
            <input type="hidden" name="date_coverage_start" id="txtdatecoveragestart">
            <input type="hidden" name="date_coverage_end" id="txtdatecoverageend">
            <div class="col mb-2">
                <label for="selpaymentmode" class="form-label">Payment Mode<span class="text-danger">*</span></label>
                <select name="payment_mode" id="selpaymentmode" class="form-select" required onchange="watchmode(event)">
                    <option value="Cash">Cash</option>
                    <option value="G Cash">G Cash</option>
                    <option value="Check">Check</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>
            <div class="col mb-2">
                <label for="txtornumber" class="form-label">OR Number<span class="text-danger">*</span></label>
                <input type="text" name="or_number" id="txtornumber" class="form-control" required>
            </div>
            <div class="col mb-2 d-none" id="edCA">
                <label for="txtamount" class="form-label">Amount<span class="text-danger">*</span></label>
                <input type="number" name="amount" id="txtamount" class="form-control" min="0" value="{{$contract->amount_rental}}" required>
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
                <input type="text" name="notes" id="txtnotes" class="form-control">
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <input type="submit" value="Save" class="btn btn-sm btn-primary">
        </div>
        @else
        <p>This contract is currently up-to-date.</p>
        @endif
    </form>
    <script>
        <?php
            $coverage_start = ($contract->lastPayment()!=null)?date('Y-m-d', strtotime("+1 day", strtotime($contract->lastPayment()->date_coverage_end))):$contract->date_start;
        ?>
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        
        var monthsdue = {{$contract->getMonthsDue()}};
        var monthsToPay = 1;
        var amountRental = {{$contract->amount_rental}};
        var amountToPay = {{$contract->amount_rental}};
        var coverage_start = new Date('{{$coverage_start}}');
        var coverage_end = new Date(new Date(coverage_start).setMonth(coverage_start.getMonth() + 1) - (24*60*60*1000));
        document.getElementById('pcDates').innerHTML = coverage_start.toLocaleString('en-US', options) + " to " + coverage_end.toLocaleString('en-US', options);
        document.getElementById('txtdatecoveragestart').value = coverage_start.toISOString().split('T')[0];
        document.getElementById('txtdatecoverageend').value = coverage_end.toISOString().split('T')[0];
        function addpc() {
            monthsToPay++;
            if(monthsToPay > monthsdue)
                monthsToPay = monthsdue;
            coverage_end = new Date(new Date(coverage_start).setMonth(coverage_start.getMonth() + monthsToPay) - (24*60*60*1000));
            amountToPay = monthsToPay * amountRental;
            document.getElementById('pcMonth').innerHTML = monthsToPay + " month" + (monthsToPay>1?'s':'');
            document.getElementById('pcAmount').innerHTML = amountToPay.toLocaleString('en-US', {minimumFractionDigits:2});
            document.getElementById('txtamount').value = amountToPay;
            document.getElementById('pcDates').innerHTML = coverage_start.toLocaleString('en-US', options) + " to " + coverage_end.toLocaleString('en-US', options);
            document.getElementById('txtdatecoverageend').value = coverage_end.toISOString().split('T')[0];
        }

        function removepc() {
            monthsToPay--;
            if(monthsToPay < 1)
                monthsToPay = 1;
            coverage_end = new Date(new Date(coverage_start).setMonth(coverage_start.getMonth() + monthsToPay) - (24*60*60*1000));
            amountToPay = monthsToPay * amountRental;
            document.getElementById('pcMonth').innerHTML = monthsToPay + " month" + (monthsToPay>1?'s':'');
            document.getElementById('pcAmount').innerHTML = amountToPay.toLocaleString('en-US', {minimumFractionDigits:2});
            document.getElementById('txtamount').value = amountToPay;
            document.getElementById('pcDates').innerHTML = coverage_start.toLocaleString('en-US', options) + " to " + coverage_end.toLocaleString('en-US', options);
            document.getElementById('txtdatecoverageend').value = coverage_end.toISOString().split('T')[0];
        }
        function watchmode(e) {
            var mode = e.target.value;
            switch(mode) {
                case 'G Cash':
                    document.getElementById('edCN').classList.remove('d-none');
                    document.getElementById('edCD').classList.remove('d-none');
                    document.getElementById('edCA').classList.remove('d-none');
                    document.getElementById('lblCN').innerHTML = "Reference Number";
                    document.getElementById('lblCD').innerHTML = "Reference Date";
                    break;
                case 'Check':
                    document.getElementById('edCN').classList.remove('d-none');
                    document.getElementById('edCD').classList.remove('d-none');
                    document.getElementById('edCA').classList.remove('d-none');
                    document.getElementById('lblCN').innerHTML = "Check Number";
                    document.getElementById('lblCD').innerHTML = "Check Date";
                    break;
                case 'Bank Transfer':
                    document.getElementById('edCN').classList.remove('d-none');
                    document.getElementById('edCD').classList.remove('d-none');
                    document.getElementById('edCA').classList.remove('d-none');
                    document.getElementById('lblCN').innerHTML = "Reference Number";
                    document.getElementById('lblCD').innerHTML = "Reference Date";
                    break;
                default:
                    document.getElementById('edCN').classList.add('d-none');
                    document.getElementById('edCD').classList.add('d-none');
                    document.getElementById('edCB').classList.add('d-none');
                    document.getElementById('edCA').classList.add('d-none');
                    break;
            }
        }
    </script>
</div>