@extends('client.layout.master')

@section('title', 'Client || Food List')

@section('breadcum')
    <span class="text-muted fw-light">Client /</span> Food List
@endsection

@section('content')
    @include('client.components.food.index')
    @include('client.components.food.delete')
@endsection
