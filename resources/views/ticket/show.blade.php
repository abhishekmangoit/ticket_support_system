@extends('layouts.dashboard')
 
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('./fancybox/jquery.fancybox-1.3.4.css') }}" media="screen" />
<link rel="stylesheet" href="{{ asset('css/fancybox.css') }}" />
@endpush


@section('title', 'Ticket Details Page')


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
                    @foreach($ticket as $ticket)
                    <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Ticket Number : {{$ticket->ticket_number}}</h3>
                            @if($user->role != '3' && $ticket->status == '0')
                            <a href="{{ route('ticket.close', ['id'=>$ticket->id, 'user_id'=>$user->id]) }} "><input type="button" onclick="return confirm('Confirm that you want to close this ticket !')" class="btn ml-3 btn-danger" value="Close Ticket"></input></a>
                            {{-- @elseif($user->role != '3' && $ticket->status != '0')
                            <a href="{{ route('ticket.close', ['id'=>$ticket->id, 'user_id'=>$user->id]) }} "><input type="button" onclick="return confirm('Confirm that you want to open this ticket !')" class="btn ml-3 btn-success" value="Open Ticket"></input></a>
                            @elseif($user->role == '3' && $ticket->status != '0')
                            <a href="{{ route('ticket.close', ['id'=>$ticket->id, 'user_id'=>$user->id]) }} "><input type="button" onclick="return confirm('Confirm that you want to reopen this ticket !')" class="btn ml-3 btn-success" value="Open ticket"></input></a> --}}
                            @endif
                        </div>
                        <!-- /.card-header -->

                            <!-- /.row -->
                       <div class="row ">
                            <div class="col-md-12">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Details
                                    </h3>
                                </div> 
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <blockquote>
                                        <p>Title - {{$ticket->title}}</p>
                                        <p>Category - {{$ticket->category->name}}</p>
                                        <small>{{$ticket->details}}</small>
                                    </blockquote>
                                    @foreach($ticket->images as $image)
                                        <a id="example2" href="{{ asset($image->image) }}"><img src="{{ asset($image->image) }}" class="mr-3" alt="" srcset="" style="width: 100px"></a>
                                    @endforeach
                                </div>
                                <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- ./col -->
                            
                            </div>
                        <!-- Chat of admin lte3 -->

                        @include('ticket.comment')
                            

                        @if($ticket->status == '0')
                        <!-- form start -->
                            <form id="commentForm" action="{{ route('comment.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                <div class="input-group p-3">
                                    <input type="text" name="message" placeholder="Type Message ..." class="form-control @error('message') is-invalid @enderror" id="message"  value="{{ old('message') }}">
                                    <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                    </span>
                                    <!-- <div class="form-group"></div> -->
                                    @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group p-3">
                                    <label for="images">Images:</label>
                                    <input type="file" name="images[]"  id="images" class=" @error('images') is-invalid @enderror" multiple>
                                    @error('images[]')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            <!-- </form> -->

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{ route('ticket.index') }} "><input type="button" class="btn btn-primary" value="Back"></input></a>
                            </div>
                        </form>
                        @else
                            <div class="card-footer">
                                <a href="{{ route('ticket.index') }} "><input type="button" class="btn btn-primary" value="Back"></input></a>
                            </div>
                        @endif
                    </div>
                    @endforeach
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
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script>
    !window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
</script>
<script type="text/javascript" src="{{ asset('./fancybox/jquery.mousewheel-3.0.4.pack.js') }}"></script>
<script type="text/javascript" src="{{ asset('./fancybox/jquery.fancybox-1.3.4.pack.js') }}"></script>
<script src="{{ asset('js/ticket.js') }}"></script>
<script type="text/javascript">
    $("a#example2").fancybox({
        'overlayShow'	: false,
        'transitionIn'	: 'elastic',
        'transitionOut'	: 'elastic'
    });
</script>

@endpush