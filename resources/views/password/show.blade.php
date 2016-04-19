@extends('group.base')
@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Password Detail <a href="{{ route('password.edit', ['id'=>$password->id]) }}" class="pull-right"><i class="fa fa-pencil"></i></a></div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Property</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                           <td>Title</td>
                           <td>{{ $password->title }}</td>
                        </tr>
                        <tr>
                           <td>URL</td>
                           <td><a href="{!! $password->url !!}}" target="_blank">{{ $password->url }}</a></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>{{ $password->username }}&nbsp;<a href="#" class="btn btn-xs btn-default btn-clipboard" data-clipboard-text="{{ $password->username }}"><i class="fa fa-clipboard"></i></a></td>
                        </tr>
                        @if(isset($password->email))
                        <tr>
                            <td>Email</td>
                            <td>{{ $password->email }}&nbsp;<a href="#" class="btn btn-xs btn-default btn-clipboard" data-clipboard-text="{{ $password->email }}"><i class="fa fa-clipboard"></i></a></td>
                        </tr>
                        @endif
                        <tr>
                            <td>Password</td>
                            <td><a href="#" class="btn btn-xs btn-default btn-clipboard" data-clipboard-text="{{ $password->password }}"><i class="fa fa-clipboard"></i></a></td>
                        </tr>
                        @if(isset($password->note))
                        <tr>
                            <td>Note</td>
                            <td>{{ $password->note }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
