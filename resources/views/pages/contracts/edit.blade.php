@extends('layouts.app')
@section('content')
<h1 class="mb-3"><a href="{{route('property.show',$contract->property->id)}}" class="text-dark text-decoration-none">{{$contract->property->name}}</a></h1>
<div class="row">
    <div class="col-md-4 mb-3">
        <x-property.showcard :property="$contract->property" />
    </div>
    <div class="col-md-8 mb-3">
        <h3 class="m-0 mb-3">Edit Contract</h3>
        <form action="{{route('contract.update',$contract->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="sel_tenant" class="form-label">Tenant<span class="text-danger">*</span></label>
                    <select name="tenant" id="sel_tenant" class="form-select">
                        @foreach ($tenants as $tenant)
                        <option value="{{$tenant->id}}" {{($contract->user_id==$tenant->id)?'selected':''}}>{{$tenant->name_first . ' ' . $tenant->name_last}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="txt_date_contract" class="form-label">Contract Date<span class="text-danger">*</span></label>
                    <input type="date" name="date_contract" id="txt_date_contract" class="form-control" value="{{$contract->date_contract}}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="txt_date_start" class="form-label">Start Date<span class="text-danger">*</span></label>
                    <input type="date" name="date_start" id="txt_date_start" class="form-control" value="{{$contract->date_start}}" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="txt_date_end" class="form-label">End Date<span class="text-danger">*</span></label>
                    <input type="date" name="date_end" id="txt_date_end" class="form-control" value="{{$contract->date_end}}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="txt_amount_rental" class="form-label">Rental Amount<span class="text-danger">*</span></label>
                    <input type="number" name="amount_rental" id="txt_amount_rental" class="form-control" value="{{$contract->amount_rental}}" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="txt_amount_security_deposit" class="form-label">Security Deposit<span class="text-danger">*</span></label>
                    <input type="number" name="amount_security_deposit" id="txt_amount_security_deposit" class="form-control" value="{{$contract->amount_security_deposit}}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="txt_amount_electric_deposit" class="form-label">Electric Meter Deposit</label>
                    <input type="number" name="amount_electric_deposit" id="txt_amount_electric_deposit" class="form-control" min="0" value="{{$contract->amount_electric_deposit}}">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="txt_amount_water_deposit" class="form-label">Water Meter Deposit</label>
                    <input type="number" name="amount_water_deposit" id="txt_amount_water_deposit" class="form-control" min="0" value="{{$contract->amount_water_deposit}}">
                </div>
            </div>
            <div class="row">
                {{-- <div class="col mb-2">
                    <label for="txt_invoice_day" class="form-label">Cut-off day<span class="text-danger">*</span></label>
                    <input type="number" name="invoice_day" id="txt_invoice_day" class="form-control" min="1" max="28" value="{{$contract->invoice_day}}" required>
                </div> --}}
                <div class="col mb-2">
                    <label for="sel_agreed_payment_mode" class="form-label">Agreed Payment Mode</label>
                    <select name="agreed_payment_mode" id="sel_agreed_payment_mode" class="form-select">
                        <option disabled {{($contract->agreed_payment_mode == null)?'selected':''}}>Choose</option>
                        <option value="Cash" {{($contract->agreed_payment_mode == 'Cash')?'selected':''}}>Cash</option>
                        <option value="G Cash" {{($contract->agreed_payment_mode == 'G Cash')?'selected':''}}>G Cash</option>
                        <option value="Bank" {{($contract->agreed_payment_mode == 'Bank')?'selected':''}}>Bank</option>
                        <option value="Check" {{($contract->agreed_payment_mode == 'Check')?'selected':''}}>Check</option>
                    </select>
                </div>
                <div class="col mb-3">
                    <label for="file_scanned_contract" class="form-label">Scanned Contract</label>
                    <input type="file" name="scanned_contract_file" id="file_scanned_contract" class="form-control">
                </div>
            </div>
            <div class="d-flex">
                <a href="{{route('property.contract.index',$contract->property->id)}}" class="btn btn-outline-secondary me-auto">Cancel</a>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection