@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
                <br>
                 @if(Auth::user()->role==1)
<a href="{{ route('pendingView') }}" class="btn btnprimary">View all pending requests </a>
@endif

@if(Auth::user()->role==0)
<a href="{{ route('home') }}" class="btn btnprimary">See all pets </a>
@endif
            </div>
        </div>
    </div>
</div>
@endsection
