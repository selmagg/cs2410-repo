@extends('layouts.app')
@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 ">
<div class="card">
<div class="card-header">Display all pets</div>
<div class="card-body">
<table class="table table-striped">
<thead>
<tr>
<th>Name</th>
<th>DOB</th>
<th>Description</th>
<th>Availability</th>
<th colspan="3">Action</th>
</tr>
</thead>
<tbody>
@foreach($animals as $animal)

<tr>
<td>{{$animal['name']}}</td>
<td>{{$animal['dob']}}</td>
<td>{{$animal['description']}}</td>
<td>{{$animal['availability']}}</td>
@if(Auth::user()->role==0)
<td><a href="{{route('animals.show', ['animal' => $animal['id'] ] )}}" class="btn btnprimary">Details</a></td>
<td><a href="{{ action('App\Http\Controllers\AdoptionController@store', $animal["id"])}}"class="btn btnwarning">Request</a></td>
<td>
@endif

@if(Auth::user()->role==1)

<td><a href="{{route('animals.show', ['animal' => $animal['id'] ] )}}" class="btn btnprimary">Details</a></td>
<td><a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}" class="btn btnwarning">Edit</a></td>

<td>
<form action="{{ action([App\Http\Controllers\AnimalController::class, 'destroy'],
['animal' => $animal['id']]) }}" method="post">
 @csrf
<input name="_method" type="hidden" value="DELETE">
<button class="btn btn-danger" type="submit"> Delete</button>
@endif
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
@endsection