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
<th>Owner ID</th>
</tr>
</thead>
<tbody>
@foreach($animals as $animal)

<tr>
<td>{{$animal['name']}}</td>
<td>{{$animal['dob']}}</td>
<td>{{$animal['description']}}</td>
<td>{{$animal['availability']}}</td>
<td>{{$animal['user_id']}}</td>
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