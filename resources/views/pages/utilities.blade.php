@extends('layouts.app')
@section('content')
    <h1>Utilities</h1>
    <div class="row">
        <div class="col-md-2 mb-3">
            <a href="{{route('utility.create')}}" class="btn btn-primary">Add utility</a>
        </div>
        <div class="col-md-4 mb-3">
            <ul class="list-group">
            @if (count($utilities)>0)
                @foreach ($utilities as $u)
                    <a href="{{route('utility.show',$u->id)}}" class="list-group-item list-group-item-action {{(($selectedUtility->id??0) == $u->id)?'active':'';}}">{{$u->name}}</a>
                @endforeach
            @else
                <li class="list-group-item text-secondary"><em>No utilities saved.</em></li>
            @endif
            </ul>
            
        </div>
        <div class="col-md-6 mb-3">
            <div class="border rounded p-3">
                @switch($pagefn)
                    @case('create')
                        <x-utilities.create />
                        @break
                    @case('show')
                        <x-utilities.show :selectedUtility="$selectedUtility" />
                        @break
                    @case('edit')
                        <x-utilities.edit :selectedUtility="$selectedUtility" />
                        @break
                    @default
                        <x-utilities.noselection/>
                @endswitch
            </div>
        </div>
    </div>
@endsection