@extends('layouts.dashboard')
 
@push('style')

@endpush


@section('title', 'Ticket Create Form')


@section('content')
<div class="container" >
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@php $user = auth()->user(); @endphp

 <!-- Main content -->
 <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Ticket Create Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="ticketForm" action="{{ route('ticket.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" placeholder="Enter ticket title">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" >
                                        <option value="">{{ old('category') ? old('category') : 'Select Category' }} </option>
                                        @foreach($category as $category)
                                            <option value="{{$category->id}}" >{{$category->name}}</option>
                                        @endforeach             
                                    </select>
                                    @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="priority" class="@error('priority') is-invalid @enderror">Priority</label>
                                    <div class="form-check">
                                    <input  type="radio" name="priority" value="1" @if(old('priority')=='1') checked @endif> High
                                    </div>
                                    <div class="form-check">
                                    <input  type="radio" name="priority" value="0" @if(old('priority')=='0') checked @endif> Low
                                    </div>
                                    @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <textarea  name="details" class="form-control @error('details') is-invalid @enderror" id="details" value="" placeholder="Enter ticket details"> {{ old('details') }} </textarea>
                                    @error('details')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="images">Images:</label>
                                    <input type="file" name="images[]"  id="images" class=" @error('images') is-invalid @enderror" multiple>
                                    @error('images[]')
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
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('js/ticket.js') }}"></script>

@endpush