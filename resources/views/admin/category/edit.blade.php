@extends('layouts.dashboard')
 
@push('style')

@endpush


@section('title', 'Category Edit Form')


@section('content')
<div class="container" >
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary mt-3">
              <div class="card-header">
                <h3 class="card-title">Category Edit Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="categoryForm" action="{{ route('category.update', $category->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{$category->name }}" placeholder="Enter category name">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <div class="form-check">
                    <input  type="radio" name="status" value="1" @if($category->status == '1') checked @endif> Active
                    </div>
                    <div class="form-check">
                    <input  type="radio" name="status" value="0" @if($category->status == '0') checked @endif> Inactive
                    </div>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('category.index') }} "><input type="button" value="Cancel" class="btn btn-primary"></input></a>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@push('script')

<!-- jquery-validation -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('js/category.js') }}"></script>
@endpush