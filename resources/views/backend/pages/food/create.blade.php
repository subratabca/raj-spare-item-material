@extends('backend.layout.master')

@section('title', 'Admin || New Food')

@section('breadcum')
    <span class="text-muted fw-light">Admin /</span> Create New Food
@endsection

@section('content')
    @include('backend.components.food.create')
@endsection