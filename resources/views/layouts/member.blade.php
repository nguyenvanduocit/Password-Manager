@extends('layouts.app')
@section('top_menu')
    <ul class="nav navbar-nav">
        <li><a href="{{ route('group.index') }}">Groups</a></li>
        <li><a href="{{ route('password.index') }}">Passwords</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Add new&nbsp;<span class="caret"></span></a>

            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('group.create') }}">New Group</a></li>
                <li><a href="{{ route('password.create') }}">New Password</a></li>
            </ul>
        </li>
    </ul>
@endsection
