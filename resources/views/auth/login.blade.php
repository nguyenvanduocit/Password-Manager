@extends('layouts.guest')

@section('main')
    {{ \Session::get('error') }}
<div class="container">
    <a href="{{ route('auth.google') }}" class="btn btn-info">Login using Google Account</a>
</div>
@endsection
