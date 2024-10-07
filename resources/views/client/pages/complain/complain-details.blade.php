@extends('client.layout.master')

@section('title', 'Client || Complain Details')

@section('breadcum')
    <span class="text-muted fw-light">Client /</span> Complain Details Information
@endsection

@section('content')
    @include('client.components.complain.complain-details')
    @include('client.components.complain.reply')
@endsection