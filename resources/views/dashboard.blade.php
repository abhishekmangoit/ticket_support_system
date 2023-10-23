@extends('layouts.dashboard')

@push('style')
@endpush

@section('title', 'Dashboard Page')

@section('content')

@php
    $user = auth()->user();
    $data=$ticketInfo();
@endphp
    
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    <div class="row ">
    <div class="info-box col-md-3 ml-3 mt-3">
        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Total Tickets</span>
            <span class="info-box-number">{{ $data['totalRecords'] }}</span>
        </div>
    </div>
    <div class="info-box col-md-2 ml-3 mt-3">
        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Open </span>
            <span class="info-box-number">{{ $data['openTickets'] }}</span>
        </div>
    </div>
    <div class="info-box col-md-2 ml-3 mt-3">
        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Closed </span>
            <span class="info-box-number">{{ $data['totalRecords']-$data['openTickets'] }}</span>
        </div>
    </div>
    @if($user->role == '1')
    <div class="info-box col-md-3 ml-3 mt-3">
        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Not assigned</span>
            <span class="info-box-number">{{ $data['notAssigned'] }}</span>
        </div>
    </div>
@endif
</div>

<!-- PRODUCT LIST -->
<!-- <div class="card m-3">
    <div class="card-header">
    <h3 class="card-title">Recent Tickets</h3>

    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
        </button>
    </div>
    </div> -->
    <!-- /.card-header -->
    <!-- <div class="card-body p-0">
    <ul class="products-list product-list-in-card pl-2 pr-2">
        @foreach($data['recentTicket'] as $recentTicket)
        <li class="item"> -->
        <!-- <div class="product-info"> -->
            <!-- <a href="javascript:void(0)" class="product-title">Category - {{$recentTicket->category->name}}
            <span class="badge badge-secondary float-right">{{$formatDate($recentTicket->created_at)}}</span></a>
            <span class="product-description">
                Title - {{$recentTicket->title}}
            </span> -->
        <!-- </div> -->
        <!-- </li>
        @endforeach -->
        <!-- /.item -->
    <!-- </ul>
    </div> -->
    <!-- /.card-body -->
    <!-- <div class="card-footer text-center">
    <a href="{{ route('ticket.index') }}" class="uppercase">View All Tickets</a>
    </div> -->
    <!-- /.card-footer -->
<!-- </div> -->
<!-- /.card -->
{{-- </x-app-layout> --}}
@endsection

@push('script')
@endpush
