<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $selectedPayment = null;
        $pagefn = 'index';
        $payments = Payment::orderBy('date_payment','DESC')->get();
        return view('pages.payments')
            ->with('payments', $payments)
            ->with('selectedPayment', $selectedPayment)
            ->with('pagefn', $pagefn);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $selectedPayment = null;
        $contract = Contract::find($request->c);
        if($contract == null) {
            return to_route('payment.index')
                ->with('status', 'danger')
                ->with('message', 'There is no active contract to make a payment for.');
        }
        $pagefn = 'create';
        $payments = Payment::orderBy('date_payment','DESC')->get();
        return view('pages.payments')
            ->with('payments', $payments)
            ->with('selectedPayment', $selectedPayment)
            ->with('pagefn', $pagefn)
            ->with('contract', $contract);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_payment' => 'required',
            'contract_id' => 'required',
            'amount' => 'required',
            'or_number' => 'required',
            'date_coverage_start' => 'required',
            'date_coverage_end' => 'required',
        ]);

        $payment = new Payment();
        $payment->date_payment = $request->date_payment;
        $payment->contract_id = $request->contract_id;
        $payment->user_id = Auth::user()->id;
        $payment->amount = $request->amount;
        $payment->or_number = $request->or_number;
        $payment->date_coverage_start = $request->date_coverage_start;
        $payment->date_coverage_end = $request->date_coverage_end;
        $payment->notes = $payment->notes;
        $payment->save();
        return to_route('property.show',$payment->contract->property->id)
            ->with('status', 'success')
            ->with('message', 'Payment posted for the contract of ' . $payment->contract->tenant->fullName() . ".");
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $pagefn = 'show';
        $payments = Payment::orderBy('date_payment','DESC')->get();
        return view('pages.payments')
            ->with('payments', $payments)
            ->with('selectedPayment', $payment)
            ->with('pagefn', $pagefn);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $pagefn = 'edit';
        $payments = Payment::orderBy('date_payment','DESC')->get();
        return view('pages.payments')
            ->with('payments', $payments)
            ->with('selectedPayment', $payment)
            ->with('pagefn', $pagefn);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'date_payment' => 'required',
            'amount' => 'required',
            'or_number' => 'required',
            'date_coverage_start' => 'required',
            'date_coverage_end' => 'required',
        ]);

        $payment->date_payment = $request->date_payment;
        $payment->amount = $request->amount;
        $payment->or_number = $request->or_number;
        $payment->date_coverage_start = $request->date_coverage_start;
        $payment->date_coverage_end = $request->date_coverage_end;
        $payment->notes = $payment->notes;
        $payment->update();
        return to_route('property.show',$payment->contract->property->id)
            ->with('status', 'success')
            ->with('message', 'Payment updated for the contract of ' . $payment->contract->tenant->fullName() . ".");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
