@extends('backend.layout.master')

@section('title', 'Admin || Food List')

@section('breadcum')
    <span class="text-muted fw-light">Admin /</span> Food List
@endsection

@section('content')
    @include('backend.components.food.index')
    @include('backend.components.food.delete')
@endsection
