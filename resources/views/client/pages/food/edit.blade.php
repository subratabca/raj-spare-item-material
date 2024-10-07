@extends('client.layout.master')

@section('title', 'Client || Edit Food')

@section('breadcum')
    <span class="text-muted fw-light">Client /</span> Update Food
@endsection

@section('content')
    @include('client.components.food.edit')
@endsection