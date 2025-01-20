@extends('layouts.app')
@section('content')
    <h1>Report for {{date_format($start_date,"Y-m-d")}} - {{date_format($end_date,"Y-m-d")}}</h1>
@endsection
