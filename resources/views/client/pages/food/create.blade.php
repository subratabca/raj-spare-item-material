@extends('client.layout.master')

@section('title', 'Client || New Food')

@section('breadcum')
    <span class="text-muted fw-light">Client /</span> Create New Food
@endsection

@section('content')
    @include('client.components.food.create')
@endsection