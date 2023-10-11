@extends('layouts.dashboard')

@push('style')
@endpush

@section('title', 'Category Index Page')


@section('content')      


<div class="container" >

<h2>Category List</h2>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('warning'))
<div class="alert alert-warning">{{ session('warning') }}</div>
@endif

<a href="{{ route('category.create') }}"><button class="btn btn-success" > Add Category </button></a>

<table class="table table-bordered" id="table">

<thead>

<tr>

<th>Name</th>

<th>Status</th>

<th>Action</th>

</tr>

</thead>

<tbody>

@php $category = $category; @endphp

@foreach($category as $value)

<tr>
    
<td>{{ $value->name }}</td>

<td>
@if($value->status == 0)
     Inactive 
    @else
     Active 
    @endif
</td>

<td>
<a href="{{ route('category.edit',  $value->id) }}"><button class="btn btn-primary">Edit</button></a>
<form action="{{ route('category.destroy', $value->id) }}" method="POST" style="display:inline">
    @method('DELETE')
    @csrf
    <button type="submit" onclick="return confirm('Confirm that you want to delete it ?')" class="btn btn-danger">Delete</button>
</form>
</td>

</tr>

@endforeach

</tbody>

</table>


</div>


@endsection

@push('script')
@endpush

