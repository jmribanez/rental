@extends('layouts.app')
@section('content')
    <h1 class="mb-3"><a href="{{route('property.show',$property->id)}}" class="text-dark text-decoration-none">{{$property->name}}</a></h1>
    <div class="row">
        <div class="col-md-4 mb-3">
            <x-property.showcard :property="$property" />
        </div>
        <div class="col-md-8 mb-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="m-0">Contracts</h3>
                <a href="{{route('property.contract.create',$property->id)}}" class="btn btn-sm btn-outline-primary">New</a>
            </div>
            <div class="list-group">
                @if(count($property->contracts)>0)
                @foreach ($property->contracts as $contract)
                <a href="{{route('contract.show',$contract->id)}}" class="list-group-item list-group item-action">
                    <div class="row">
                        <div class="col">{{$contract->tenant->name_first . ' ' . $contract->tenant->name_last}}</div>
                        <div class="col d-none d-lg-block">{{$contract->contractMidDateToString()}}</div>
                        <div class="col-4 col-lg-3 text-end">Php {{$contract->amountrentalToString()}}</div>
                    </div>
                </a>
                @endforeach
                
                @else
                <div class="list-group-item"><em class="text-secondary">No contracts</em></div>
                @endif
            </div>
        </div>
    </div>
@endsection