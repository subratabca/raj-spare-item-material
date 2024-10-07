@extends('backend.layout.master')

@section('title', 'Admin || Food Details')

@section('breadcum')
    <span class="text-muted fw-light">Admin /</span> Food Details
@endsection

@section('content')
    @include('backend.components.food.food-details')
@endsection