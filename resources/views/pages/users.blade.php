@extends('layouts.app')
@section('content')
    <h1>Users</h1>
    <div class="row">
        <div class="col-md-2 mb-3">
            <a href="{{route('user.create')}}" class="btn btn-primary">Add user</a>
        </div>
        <div class="col-md-4 mb-3">
            <ul class="list-group">
            @foreach ($users as $user)
                <a href="{{route('user.show',$user->id)}}" class="list-group-item list-group-item-action d-flex {{(($selectedUser->id??0) == $user->id)?'active':'';}}">
                    <span>{{$user->name_last . ", " . $user->name_first}}</span>
                    <span class="ms-auto">{{$user->getRoleNames()[0]}}</span>
                </a>
            @endforeach
            </ul>
        </div>
        <div class="col-md-6 mb-3">
            <div class="border rounded p-3">
                @switch($pagefn)
                    @case('create')
                        <x-users.create :t="$t"/>
                        @break
                    @case('show')
                        <x-users.show :selectedUser="$selectedUser"/>
                        @break
                    @case('edit')
                        <x-users.edit :selectedUser="$selectedUser"/>
                        @break
                    @default
                        <x-users.noselection/>
                @endswitch
                
            </div>
        </div>
    </div>
@endsection