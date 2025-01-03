@extends('layouts.app')
@section('content')
    <h1>Tenants</h1>
    <div class="row">
        <div class="col-md-2 mb-3">
            <a href="{{route('user.create',['t'=>'t'])}}" class="btn btn-primary">New tenant</a>
        </div>
        <div class="col-md-4 mb-3">
            <ul class="list-group">
                @if (count($tenants)>0)
                    @foreach ($tenants as $t)
                        <a href="{{route('tenant.show',$t->id)}}" class="list-group-item list-group-item-action {{(($selectedTenant->id??0) == $t->id)?'active':'';}}">
                            <div class="d-flex align-items-start">
                                <div class="me-2">
                                    <span>{!!($t->activeContract()!=null)?'<i class="fa-solid fa-circle-check text-success small"></i> ':'<i class="fa-regular fa-circle text-secondary small"></i>'!!}</span>    
                                </div>
                                <div class="me-auto">
                                    <p class="m-0">{{$t->name_last . ", " . $t->name_first}}</p>
                                    @if($t->name_company!=null)
                                    <p class="m-0 small">{{$t->name_company}}</p>
                                    @endif
                                </div>
                                <div class="">
                                    @if($t->getBalanceRaw() > 0)
                                        <span>{{number_format($t->getBalanceRaw(),2)}}</span>
                                    @else
                                        <span><em class="text-secondary">Up-to-date</em></span>
                                    @endif
                                    
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <li class="list-group-item text-secondary"><em>No tenants here.</em></li>
                @endif
            </ul>
        </div>
        <div class="col-md-6 mb-3">
            <div class="border rounded p-3">
                @switch($pagefn)
                    @case('show')
                        <x-tenants.show :selectedTenant="$selectedTenant" :status="$status" :paymentHistory="$paymentHistory" />
                        @break
                    @case('contracts')
                        <x-tenants.contracts :selectedTenant="$selectedTenant" />
                        @break
                    @default
                        <x-tenants.noselection />
                        @break
                @endswitch
            </div>
        </div>
    </div>
@endsection