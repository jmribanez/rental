<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Property $property)
    {
        return view('pages.contracts.index')
            ->with('property',$property);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Property $property)
    {
        $tenants = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', 'Tenant')->toArray()
        );
        return view('pages.contracts.create')
            ->with('property',$property)
            ->with('tenants',$tenants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Property $property)
    {
        //
        $validated = $request->validate([
            'tenant' => 'required',
            'date_contract' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'amount_rental' => 'required',
            'amount_security_deposit' => 'required',
            'invoice_day' => 'required',
        ]);
        $contract = new Contract;
        $contract->property_id = $property->id;
        $contract->user_id = $request->tenant;
        $contract->date_contract = $request->date_contract;
        $contract->date_start = $request->date_start;
        $contract->date_end = $request->date_end;
        $contract->invoice_day = $request->invoice_day;
        $contract->amount_security_deposit = $request->amount_security_deposit;
        $contract->amount_rental = $request->amount_rental;
        $contract->agreed_payment_mode = $request->agreed_payment_mode;
        if($request->hasFile('scanned_contract_file')) {
            $allowedFileExtension = ['pdf'];
            $file = $request->file('scanned_contract_file');
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);
            if($check) {
                $newFileName = substr(bin2hex(random_bytes(ceil(6/2))),0,6);
                $file->storeAs('scanned_contracts', $newFileName . "." . $extension);
                $contract->scanned_contract_file = $newFileName . "." . $extension;
            }
        }
        $contract->save();
        return to_route('contract.show',$contract->id)
            ->with('status', 'success')
            ->with('message', 'Contract created in ' . $property->name . ' for ' . $contract->tenant->name_first . ' ' . $contract->tenant->name_last .'.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        return view('pages.contracts.show')
            ->with('contract',$contract);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        $tenants = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', 'Tenant')->toArray()
        );
        return view('pages.contracts.edit')
            ->with('contract',$contract)
            ->with('tenants',$tenants);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'tenant' => 'required',
            'date_contract' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'amount_rental' => 'required',
            'amount_security_deposit' => 'required',
            'invoice_day' => 'required',
        ]);
        // $contract->user_id = $request->tenant;
        $contract->date_contract = $request->date_contract;
        $contract->date_start = $request->date_start;
        $contract->date_end = $request->date_end;
        $contract->invoice_day = $request->invoice_day;
        $contract->amount_security_deposit = $request->amount_security_deposit;
        $contract->amount_rental = $request->amount_rental;
        $contract->agreed_payment_mode = $request->agreed_payment_mode;
        if($request->hasFile('scanned_contract_file')) {
            $allowedFileExtension = ['pdf'];
            $file = $request->file('scanned_contract_file');
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);
            if($check) {
                Storage::delete('scanned_contracts/'.$contract->scanned_contract_file);
                $newFileName = substr(bin2hex(random_bytes(ceil(6/2))),0,6);
                $file->storeAs('scanned_contracts', $newFileName . "." . $extension);
                $contract->scanned_contract_file = $newFileName . "." . $extension;
            }
        }
        $contract->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
