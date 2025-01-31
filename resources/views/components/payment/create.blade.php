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
        <?php
            $coverage_start = ($contract->lastPayment()!=null)?date('Y-m-d', strtotime("+1 day", strtotime($contract->lastPayment()->date_coverage_end))):$contract->date_start;
            $monthdeficit = $contract->getBalanceRaw() % $contract->amount_rental;
            if($monthdeficit != 0) {
                // $coverage_start = date('Y-m-d', strtotime($contract->lastPayment()->date_coverage_start));
                $coverage_start = date('Y-m-d', strtotime("+1 day", strtotime("-1 month", strtotime($contract->lastPayment()->date_coverage_end))));
            }
            // echo date_create($contract->date_end) . ", " . date_create(strtotime("+1 month", strtotime($contract->lastPayment()->date_coverage_end)));
            // $coverage_end = ($contract->lastPayment()!=null)?min(date('Y-m-d',strtotime($contract->date_end)), date('Y-m-d', strtotime("+1 month", strtotime($contract->lastPayment()->date_coverage_end)))):date('Y-m-d', strtotime("-1 day", strtotime("+1 month", strtotime($contract->date_start))));
            $coverage_end = date('Y-m-d', strtotime("-1 day", strtotime("+1 month", strtotime($coverage_start))));
            $minval = $contract->getContractBalance();
            $minval = $contract->amount_rental<$minval?$contract->amount_rental:$minval;
            $minval = ($monthdeficit<$minval)&&($monthdeficit>0)?$monthdeficit:$minval;
        ?>
        @if($contract->getContractBalance() > 0)
        <div class="mb-2">
            <label for="txtamount" class="form-label">Amount<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="number" name="amount" id="txtamount" class="form-control" min="0" max="{{$contract->getContractBalance()}}" value="{{$minval}}" onchange="updateCoverage(event)" required>
                <button type="button" class="btn btn-outline-secondary" onclick="removepc()"><i class="fa-solid fa-minus"></i></button>
                <button type="button" class="btn btn-outline-secondary" onclick="addpc()"><i class="fa-solid fa-plus"></i></button>
            </div>
            <p class="m-0 d-none">Php <span id="pcAmount">{{$contract->amountrentalToString()}}</span></p>
            <p class="m-0 small" id="pcDates"></p>
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
        <p>This contract is fully paid.</p>
        @endif
    </form>
    <script>
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        
        var monthsdue = {{(int)$contract->getMonthsCanPay()}};
        var monthdeficit = {{$monthdeficit}};
        var monthsToPay = (monthdeficit!=0)?0:1;
        var amountRental = {{$contract->amount_rental}};
        var contractBalance = {{$contract->getContractBalance()}};
        var balanceRaw = {{$contract->getBalanceRaw()}};
        // var amountToPay = (amountRental<contractBalance)?amountRental:contractBalance;
        var amountToPay = Math.min(amountRental, contractBalance, monthdeficit);
        var coverage_start = new Date('{{$coverage_start}}');
        // var coverage_end = new Date(new Date(coverage_start).setMonth(coverage_start.getMonth() + 1) - (24*60*60*1000));
        var coverage_end = new Date('{{$coverage_end}}');
        document.getElementById('pcDates').innerHTML = coverage_start.toLocaleString('en-US', options) + " to " + coverage_end.toLocaleString('en-US', options);
        document.getElementById('txtdatecoveragestart').value = coverage_start.toISOString().split('T')[0];
        document.getElementById('txtdatecoverageend').value = coverage_end.toISOString().split('T')[0];
        function addpc() {
            // if(monthsToPay<1)
            //     return;
            monthsToPay++;
            amountToPay = monthsToPay * amountRental;
            if(monthsToPay > monthsdue) {
                monthsToPay = monthsdue;
                amountToPay = monthsToPay * amountRental + Math.min(amountRental, contractBalance, Math.abs(monthdeficit));
            }
            var _butal = amountToPay % amountRental;
            coverage_end = new Date(new Date(coverage_start).setMonth(coverage_start.getMonth() + (monthdeficit>0?1:0) + monthsToPay + ((_butal>monthdeficit)?1:0)) - 86400000);
            // coverage_end = new Date(new Date(coverage_start).setMonth(coverage_start.getMonth() + monthsToPay + (monthdeficit>0?1:0)) - (24*60*60*1000));
            // document.getElementById('pcMonth').innerHTML = monthsToPay + " month" + (monthsToPay>1?'s':'');
            document.getElementById('pcAmount').innerHTML = amountToPay.toLocaleString('en-US', {minimumFractionDigits:2});
            document.getElementById('txtamount').value = amountToPay;
            document.getElementById('pcDates').innerHTML = coverage_start.toLocaleString('en-US', options) + " to " + coverage_end.toLocaleString('en-US', options);
            document.getElementById('txtdatecoverageend').value = coverage_end.toISOString().split('T')[0];
        }

        function removepc() {
            // if(monthsToPay<1)
            //     return;
            monthsToPay--;
            amountToPay = monthsToPay * amountRental;
            if(monthsToPay < 1) {
                if(Math.abs(monthdeficit) > 0) {
                    amountToPay = Math.min(amountRental, contractBalance, Math.abs(monthdeficit));
                    monthsToPay = 0;
                } else {
                    monthsToPay = 1;
                    amountToPay = monthsToPay * amountRental;
                }
            }
            var _butal = amountToPay % amountRental;
            coverage_end = new Date(new Date(coverage_start).setMonth(coverage_start.getMonth() + (monthdeficit>0?1:0) + monthsToPay + ((_butal>monthdeficit)?1:0)) - 86400000);
            // coverage_end = new Date(new Date(coverage_start).setMonth(coverage_start.getMonth() + monthsToPay + (monthdeficit>0?1:0)) - (24*60*60*1000));
            
            // document.getElementById('pcMonth').innerHTML = monthsToPay + " month" + (monthsToPay>1?'s':'');
            document.getElementById('pcAmount').innerHTML = amountToPay.toLocaleString('en-US', {minimumFractionDigits:2});
            document.getElementById('txtamount').value = amountToPay;
            document.getElementById('pcDates').innerHTML = coverage_start.toLocaleString('en-US', options) + " to " + coverage_end.toLocaleString('en-US', options);
            document.getElementById('txtdatecoverageend').value = coverage_end.toISOString().split('T')[0];
        }

        function updateCoverage(e) {
            // var _amount = e.target.value;
            // var _monthsToPay = parseInt(_amount / amountRental);
            // var _daysToPay = parseInt(((_amount / amountRental) - _monthsToPay) * 30.436875);
            // coverage_end = new Date(new Date(coverage_start).setMonth(coverage_start.getMonth() + _monthsToPay) + (86400000*_daysToPay) - 86400000);
            // document.getElementById('pcDates').innerHTML = coverage_start.toLocaleString('en-US', options) + " to " + coverage_end.toLocaleString('en-US', options);
            // document.getElementById('txtdatecoverageend').value = coverage_end.toISOString().split('T')[0];

            var _amount = e.target.value;
            var _monthsToPay = parseInt(_amount / amountRental);
            var _butal = _amount % amountRental;
            console.log('butal: ' + _butal);
            coverage_end = new Date(new Date(coverage_start).setMonth(coverage_start.getMonth() + (monthdeficit>0?1:0) + _monthsToPay + ((_butal>monthdeficit)?1:0)) - 86400000);
            document.getElementById('pcDates').innerHTML = coverage_start.toLocaleString('en-US', options) + " to " + coverage_end.toLocaleString('en-US', options);
            document.getElementById('txtdatecoverageend').value = coverage_end.toISOString().split('T')[0];
        }

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