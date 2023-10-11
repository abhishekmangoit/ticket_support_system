@extends('layouts.dashboard')

@push('style')
@endpush

@section('title', 'User Index Page')


@section('content')      


<div class="container" >

<h2>User List</h2>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('warning'))
<div class="alert alert-warning">{{ session('warning') }}</div>
@endif

<a href="{{ route('user.create') }}"><button class="btn btn-success" > Add User </button></a>

<table class="table table-bordered" id="table">

<thead>

<tr>

<th>Name</th>

<th>Email</th>

<th>Status</th>

<th>Role</th>

<th>Action</th>

</tr>

</thead>

<tbody>

@php $user = $user; @endphp

@foreach($user as $value)

<tr>
    
<td>{{ $value->name }}</td>

<td>{{ $value->email }}</td>

<td>
    @if($value->status == 0)
        Inactive 
    @else
        Active 
    @endif
</td>

<td>
    @if($value->role == 3)
        Regular User 
    @elseif($value->role == 2)
        Agent
    @else
        Admin
    @endif
</td>

<td>
<a href="{{ route('user.edit',  $value->id) }}"><button class="btn btn-primary">Edit</button></a>
<form action="{{ route('user.destroy', $value->id) }}" method="POST" style="display:inline">
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

