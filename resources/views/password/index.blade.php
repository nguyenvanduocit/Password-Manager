@extends('group.base')
@section('content')
    <div class="col-md-3">
        <ul class="list-group">
            <a href="{{ route('password.index') }}" class="list-group-item @if(!$selectedGroup) active @endif">All Own Passwords</a>
            @foreach($groups as $group)
                <a href="{{ route('password.index',['group'=>$group]) }}" class="list-group-item @if($selectedGroup && $selectedGroup->id == $group->id) active @endif">{{ $group->name }}</a>
            @endforeach
        </ul>
    </div>
    <div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">Passwords</div>
        <div class="panel-body">
            <div class="table-responsive">
                @include('password.list')
            </div>
        </div>
    </div>
    </div>
@endsection
