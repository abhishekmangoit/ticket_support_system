@extends('layouts.dashboard')
 
@push('style')
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('./fancybox/jquery.fancybox-1.3.4.css') }}" media="screen" />
<link rel="stylesheet" href="{{ asset('css/fancybox.css') }}" /> -->
@endpush


@section('title', 'Ticket Edit Form')


@section('content')
<div class="container" >
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@php 
    $user = auth()->user(); 
@endphp

 <!-- Main content -->
 <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Ticket Edit Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="ticketForm" action="{{ route('ticket.update', $ticket->id) }}" method="post" >
                        @method('PUT')
                            @csrf
                            <input type="hidden" name="user" value="{{$user->id}}">
                            <input type="hidden" name="user_id" value="{{$ticket->user_id}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $ticket->title }}" placeholder="Enter ticket title">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category">Category:</label>
                                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" >
                                        <option value="">Select Category</option>
                                        @foreach($category as $category)
                                            <option value="{{$category->id}}" @if($ticket->category->id == $category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach             
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="priority" class="@error('priority') is-invalid @enderror">Priority</label>
                                    <div class="form-check">
                                    <input  type="radio" name="priority" value="1" @if($ticket->priority =='1') checked @endif> High
                                    </div>
                                    <div class="form-check">
                                    <input  type="radio" name="priority" value="0" @if($ticket->priority =='0') checked @endif> Low
                                    </div>
                                    @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <textarea  name="details" class="form-control @error('details') is-invalid @enderror" id="details" value="" placeholder="Enter ticket details"> {{ $ticket->details }} </textarea>
                                    @error('details')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="images">Images:</label>
                                </div>
                                @foreach($ticket->images as $image)
                                    <a id="example2" href="#"><img src="{{ asset($image->image) }}" class="mr-3" alt="" srcset="" style="width: 100px"></a>
                                @endforeach
                                <div class="form-group">
                                    <label for="agent">Agent:</label>
                                    <select name="agent" id="agent" class="form-control @error('agent') is-invalid @enderror" >
                                        <option value="">Select Agent </option>
                                        @foreach($agent as $agent)
                                            <option value="{{$agent->id}}" @if($ticket->agent_id  == $agent->id) selected @endif>{{$agent->name}}</option>
                                        @endforeach             
                                        </select>
                                        @error('agent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('ticket.index') }} "><input type="button" class="btn btn-primary" value="Cancel"></input></a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@push('script')

<!-- jquery-validation -->
<!-- <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('js/ticket.js') }}"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script>
    !window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
</script>
<script type="text/javascript" src="{{ asset('./fancybox/jquery.mousewheel-3.0.4.pack.js') }}"></script>
<script type="text/javascript" src="{{ asset('./fancybox/jquery.fancybox-1.3.4.pack.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $("a#example2").fancybox({
            'overlayShow'	: false,
            'transitionIn'	: 'elastic',
            'transitionOut'	: 'elastic'
        }); 
    });
</script> -->


@endpush