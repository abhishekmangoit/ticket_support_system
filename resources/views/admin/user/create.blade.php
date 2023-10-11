@extends('layouts.dashboard')
 
@push('style')

@endpush


@section('name', 'User Register Form')


@section('content')
<div class="container" >
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif


<div class="col-md-3 mb-3 ml-3">
<a href="{{ route('user.index') }} "><button class="btn btn-primary">Cancel</button></a>
</div>
 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User Register Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="userForm" action="{{ route('user.store') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" placeholder="Enter user name">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="Enter user email">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}" placeholder="Enter user email">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" id="confirmPassword" value="{{ old('confirmPassword') }}" placeholder="Enter user email">
                    @error('confirmPassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="status" class="@error('status') is-invalid @enderror">Status</label>
                    <div class="form-check">
                    <input  type="radio" name="status" value="1" @if(old('status')=='1') checked @endif> Active
                    </div>
                    <div class="form-check">
                    <input  type="radio" name="status" value="0" @if(old('status')=='0') checked @endif> Inactive
                    </div>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="role" class="@error('role') is-invalid @enderror">Role</label>
                    <div class="form-check">
                    <input  type="radio" name="role" value="3" @if(old('role')=='3') checked @endif> Regular User
                    </div>
                    <div class="form-check">
                    <input  type="radio" name="role" value="2" @if(old('role')=='2') checked @endif> Agent
                    </div>
                    <div class="form-check">
                    <input  type="radio" name="role" value="1" @if(old('role')=='1') checked @endif> Admin
                    </div>
                    @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
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
<script src="{{ asset('js/user.js') }}"></script>

@endpush