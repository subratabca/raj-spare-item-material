@extends('backend.layout.master')

@section('title', 'Admin || Complain List')

@section('breadcum')
    <span class="text-muted fw-light">Admin /</span> Complain List
@endsection

@section('content')
    @include('backend.components.complain.complain-list')
    @include('backend.components.complain.delete')
@endsection