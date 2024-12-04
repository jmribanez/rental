@extends('layouts.app')
@section('content')
    <h1>Tenants</h1>
    <div class="row">
        <div class="col-md-2 mb-3">
            <a href="{{route('user.create')}}" class="btn btn-primary">New tenant</a>
        </div>
        <div class="col-md-4 mb-3">
            <ul class="list-group">
                @if (count($tenants)>0)
                    @foreach ($tenants as $t)
                        <a href="{{route('tenant.show',$t->id)}}" class="list-group-item list-group-item-action {{(($selectedTenant->id??0) == $t->id)?'active':'';}}">{{$t->name_last . ", " . $t->name_first}}</a>
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
                        <x-tenants.show :selectedTenant="$selectedTenant" />
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