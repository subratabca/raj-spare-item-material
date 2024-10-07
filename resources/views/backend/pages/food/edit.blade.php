@extends('backend.layout.master')

@section('title', 'Admin || Edit Food')

@section('breadcum')
    <span class="text-muted fw-light">Admin /</span> Update Food
@endsection

@section('content')
    @include('backend.components.food.edit')
@endsection