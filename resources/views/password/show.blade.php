@extends('group.base')
@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Password Detail</div>
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
                            <td>{{ $password->username }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $password->email }}</td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>{{ $password->password }}</td>
                        </tr>
                        <tr>
                            <td>Note</td>
                            <td>{{ $password->note }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
