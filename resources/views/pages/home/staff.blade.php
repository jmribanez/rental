@extends('layouts.app')
@section('content')
    <h1>Welcome, {{Auth::user()->name_first}}</h1>
    <div class="row">
        <div class="col-md-4 mb-3">

        </div>
        <div class="col-md-4 mb-3">

        </div>
        <div class="col-md-4 mb-3">
            
        </div>
    </div>
@endsection