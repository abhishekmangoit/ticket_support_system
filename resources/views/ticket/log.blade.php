@extends('layouts.dashboard')

@push('style')
@endpush

@section('title', 'Ticket Index Page')


@section('content')      

@php
   $user = auth()->user();
   $logs = $logs;
@endphp

<div class="container" >


@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('warning'))
<div class="alert alert-warning">{{ session('warning') }}</div>
@endif

<a href="{{ route('ticket.index') }}"><button class="btn btn-primary mt-3" > Back </button></a>

<!-- Timeline -->
<!-- Main content -->
<section class="content mt-3">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <div class="time-label">
                @foreach($ticket as $ticket)
                <span class="bg-blue">Logs of Ticket No - {{ $ticket->ticket_number }}</span>
                @endforeach
              </div>
              @foreach($logs as $log)
              <div>
                <i class="fas fa-user bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> {{ $formatDate($log->created_at) }}</span>
                  <h3 class="timeline-header no-border"><a href="#">{{ $log->user->name }}</a> {{ $log->action }}</h3>
                </div>
              </div>
              @endforeach
              
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->


</div>


@endsection

@push('script')
@endpush

