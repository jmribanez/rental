@extends('layouts.app')
@section('content')
<h1 class="mb-3"><a href="{{route('property.show',$property->id)}}" class="text-dark text-decoration-none">{{$property->name}}</a></h1>
<div class="row">
    <div class="col-md-4 mb-3">
        <x-property.showcard :property="$property" />
    </div>
    <div class="col-md-8 mb-3">
        <h3 class="m-0 mb-3">New Contract</h3>
        <form action="{{route('property.contract.store',$property->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="sel_tenant" class="form-label">Tenant<span class="text-danger">*</span></label>
                    <select name="tenant" id="sel_tenant" class="form-select @error('tenant') is-invalid @enderror" required>
                        <option disabled selected>Choose a tenant</option>
                        @foreach ($tenants as $tenant)
                        <option value="{{$tenant->id}}">{{$tenant->name_first . ' ' . $tenant->name_last}}</option>
                        @endforeach
                    </select>
                    @error('tenant') <div class="invalid-feedback">Tenant is required.</div> @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="txt_date_contract" class="form-label">Contract Date<span class="text-danger">*</span></label>
                    <input type="date" name="date_contract" id="txt_date_contract" class="form-control" value="{{old('date_contract')}}" required onchange="setStartDay(event)">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="txt_date_start" class="form-label">Start Date<span class="text-danger">*</span></label>
                    <input type="date" name="date_start" id="txt_date_start" class="form-control" value="{{old('date_start')}}" required onchange="setEndToOneYear(event)">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="txt_date_end" class="form-label">End Date<span class="text-danger">*</span></label>
                    <input type="date" name="date_end" id="txt_date_end" class="form-control" value="{{old('date_end')}}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="txt_amount_rental" class="form-label">Rental Amount<span class="text-danger">*</span></label>
                    <input type="number" name="amount_rental" id="txt_amount_rental" class="form-control" min="0" value="{{$property->amount_rental}}" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="txt_amount_security_deposit" class="form-label">Security Deposit<span class="text-danger">*</span></label>
                    <input type="number" name="amount_security_deposit" id="txt_amount_security_deposit" min="0" value="{{$property->amount_rental * 2}}" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="txt_amount_electric_deposit" class="form-label">Electric Meter Deposit</label>
                    <input type="number" name="amount_electric_deposit" id="txt_amount_electric_deposit" class="form-control" min="0">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="txt_amount_water_deposit" class="form-label">Water Meter Deposit</label>
                    <input type="number" name="amount_water_deposit" id="txt_amount_water_deposit" class="form-control" min="0">
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label for="sel_agreed_payment_mode" class="form-label">Agreed Payment Mode</label>
                    <select name="agreed_payment_mode" id="sel_agreed_payment_mode" class="form-select">
                        <option selected disabled>Choose</option>
                        <option value="Cash">Cash</option>
                        <option value="G Cash">G Cash</option>
                        <option value="Bank">Bank</option>
                        <option value="Check">Check</option>
                    </select>
                </div>
                <div class="col mb-3">
                    <label for="file_scanned_contract" class="form-label">Scanned Contract</label>
                    <input type="file" name="scanned_contract_file" id="file_scanned_contract" class="form-control">
                </div>
            </div>
            <div class="d-flex">
                <a href="{{route('property.contract.index',$property->id)}}" class="btn btn-outline-secondary me-auto">Cancel</a>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </form>
    </div>
    <script>
        function setStartDay(e) {
            var start_date = new Date(e.target.value);
            document.getElementById('txt_date_start').value = start_date.toISOString().split('T')[0];
        }
        function setEndToOneYear(e) {
            var start_date = new Date(e.target.value);
            new_date = new Date(start_date.setFullYear(start_date.getFullYear() + 1) - ((24*60*60*1000)));
            document.getElementById('txt_date_end').value = new_date.toISOString().split('T')[0];
        }
    </script>
@endsection