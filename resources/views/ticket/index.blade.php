@extends('layouts.dashboard')

@push('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('title', 'Ticket Index Page')


@section('content')      

@php
   $user = auth()->user();
   $data = $ticketInfo();
@endphp

<div class="container" >

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('warning'))
<div class="alert alert-warning">{{ session('warning') }}</div>
@endif

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

@if($user->role == '3')
    <a href="{{ route('ticket.create') }}"><button class="btn btn-success mt-3 mb-3" > Create Ticket </button></a>
@endif
@php $category = $category; @endphp
<div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="m-1">
                <label for="priority">Priority:</label>
                <select id="priority" class="form-control" name="priority" style="width: 150px">
                    <option value="">All</option>
                    <option value="0">Low</option>
                    <option value="1">High</option>
                </select>
            </div>
            <div class="m-1">
                <label for="status">Status:</label>
                <select id="status" class="form-control" name="status" style="width: 150px">
                    <option value="">All</option>
                    <option value="0">Open</option>
                    <option value="1">Closed</option>
                </select>
            </div>
            <div class="m-1">
                <label><strong>Category :</strong></label>
                <select id='CategorySelect' class="form-control" style="width: 200px">
                    <option value="">All</option>
                    @foreach($category as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            @if($user->role == '1')
            <div class="m-1">
                <label for="assigned">Assigned:</label>
                <select id="assigned" class="form-control" name="assigned" style="width: 150px">
                    <option value="">All</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            @endif
        </div>
        <button id="search" class="btn-sm btn-primary ">search</button>   
    </div>
</div>


<div class="card mt-3">
              <div class="card-header ">
                <h3 class="card-title ">Ticket List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped mt-3" id="example1">
                  <thead>
                    <tr>
                      <th>Ticket Number</th>
                      <th>Title</th>
                      <th>Date</th>
                      <th>Category</th>
                      <th>Status</th>
                      <th>Priority</th>
                      @if($user->role == '1')
                        <th>Assigned</th>
                      @endif
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>              
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer clearfix">
                
    
              </div> -->
            </div>
            <!-- /.card -->


</div>


</div>


@endsection

@push('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

<!-- js file link for ajax call on datatable -->
<script type="text/javascript" src="{{ asset('js/ticketIndex.js') }}"></script>


@endpush

