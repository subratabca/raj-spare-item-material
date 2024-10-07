@extends('client.layout.master')

@section('title', 'Client || Food Details')

@section('breadcum')
    <span class="text-muted fw-light">Client /</span> Food Details
@endsection

@section('content')
    @include('client.components.food.food-details')
@endsection