@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Adoption Requests</div>
        <div class="card-body">
          <table class="table table-striped">
            @if(Auth::user()->role)

            <thead>
              <tr>
			           <th>User </th>
                <th>Animal ID Number</th>
                <th>Animal Name</th>
                <th>Date of Birth</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($adoptions as $adoption)
              @foreach($animals as $animal)
              @if($animal["id"] == $adoption["animal_id"])
              <tr>
                <td>{{$adoption['user_id']}}</td>
                <td>{{$adoption['animal_id']}}</td>
                <td>{{$animal['name']}}</td>
                <td>{{$animal['dob']}}</td>
                <td>{{$adoption['status']}}</td>

                @if($adoption['status']== 'waiting')
                <td><a href="{{action('App\Http\Controllers\AdoptionController@accept', $adoption["id"])}}" class="btn
                  btn- primary">Accept </a></td>
                  <td><a href="{{action('App\Http\Controllers\AdoptionController@deny', $adoption["id"])}}" class="btn
                    btn- warning">Decline </a></td>
                    @endif

                  </tr>
                  @endif
                  @endforeach
                  @endforeach
                </tbody>
              </table>
              @else

              <thead>
                <tr>
				          <th>User ID</th>
                  <th>Animal ID</th>
                  <th>Animal Name</th>
                  <th>Date Of Birth</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($adoptions as $adoption)
                @foreach($animals as $animal)
                @if($animal["id"] == $adoption["animal_id"])
                <tr>
                  <td>{{$adoption['user_id']}}</td>
                  <td>{{$adoption['animal_id']}}</td>
                  <td>{{$animal['name']}}</td>
                  <td>{{$animal['dob']}}</td>
                  <td>{{$adoption['status']}}</td>

                </tr>
                @endif
                @endforeach
                @endforeach
              </tbody>


              @endif
            </div>

          </div>
        </div>
      </div>
    </div>
    @endsection
