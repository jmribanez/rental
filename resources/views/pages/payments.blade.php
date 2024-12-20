@extends('layouts.app')
@section('content')
    <h1>Payments</h1>
    <div class="row">
        <div class="col-md-2 mb-3">
            <h5 class="fw-bold">Filters</h5>
        </div>
        <div class="col-md-4 mb-3">
            <ul class="list-group">
                @if (count($payments)>0)
                    @foreach ($payments as $p)
                        <a href="{{route('payment.show', $p->id)}}" class="list-group-item list-group-item-action {{(($selectedPayment->id??0) == $p->id)?'active':'';}}">
                            <div class="d-flex justify-content-between">
                                <span>{{$p->contract->tenant->fullName()}}</span>
                                <span>{{$p->amountToString()}}</span>
                            </div>
                            <div class="d-flex justify-content-between small">
                                <span>{{$p->getDatePayment()}}</span>
                                <span>OR {{$p->or_number}}</span>
                            </div>
                        </a>
                    @endforeach
                @else
                <li class="list-group-item text-secondary"><em>No payments saved.</em></li>
                @endif
            </ul>
        </div>
        <div class="col-md-6 mb-3">
            <div class="border rounded p-3">
                @switch($pagefn)
                    @case('create')
                    <x-payment.create :contract="$contract" />
                    @break
                    @case('show')
                    <x-payment.show :selectedPayment="$selectedPayment" />
                    @break
                    @case('edit')
                    <x-payment.edit :selectedPayment="$selectedPayment" />
                    @break
                    @default
                    <x-payment.noselection />
                    @break
                @endswitch
            </div>
        </div>
    </div>
@endsection