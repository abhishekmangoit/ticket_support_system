@extends('layouts.dashboard')

@push('style')
 <!-- DataTables -->
 <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('title', 'Category Index Page')


@section('content')      


<div class="container" >

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('warning'))
<div class="alert alert-warning">{{ session('warning') }}</div>
@endif

<a href="{{ route('category.create') }}"><button class="btn btn-success mt-3 mb-3" > Add Category </button></a>

<div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="m-1">
                <label><strong>Status :</strong></label>
                <select id='status' class="form-control" style="width: 200px">
                    <option value="">--Select Status--</option>
                    <option value="">All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="m-1">
                <label><strong>Category :</strong></label>
                <select id='CategorySelect' class="form-control" style="width: 200px">
                    <option value="">--Select Category--</option>
                    <option value="">All</option>
                    @foreach($data as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button id="search" class="btn-sm btn-primary ">search</button>   
    </div>
</div>

<div class="card ">
              <div class="card-header">
                <h3 class="card-title">Category List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped mt-3" id="example1">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Status</th>
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


@endsection

@push('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

<!-- js file link for ajax call on datatable -->
<script type="text/javascript" src="{{ asset('js/categoryIndex.js') }}"></script>

@endpush

