@extends('client.layout.master')

@section('title', 'Client || Complain List')

@section('breadcum')
    <span class="text-muted fw-light">Client /</span> Complain List
@endsection

@section('content')
    @include('client.components.complain.complain-list')
    @include('client.components.complain.reply')
@endsection