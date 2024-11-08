@extends('layouts.app')
@section('content')
    <h1>Users</h1>
    <div class="row">
        <div class="col-md-2">
            <button class="btn btn-primary">Add user</button>
        </div>
        <div class="col-md-4">
            <ul class="list-group">
            @foreach ($users as $user)
                <a href="{{route('user.show',$user->id)}}" class="list-group-item list-group-item-action d-flex">
                    <span>{{$user->name_last . ", " . $user->name_first}}</span>
                    <span class="text-muted ms-auto">{{$user->getRoleNames()[0]}}</span>
                </a>
            @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <div class="border rounded p-3">
                <x-users.noselection/>
            </div>
        </div>
    </div>
@endsection