@extends('group.base')
@section('content')
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">My groups</div>
        <div class="panel-body">
            <div class="table-responsive">
                @if($groups->count() == 0)
                    <p class="bg-warning">No group found</p>
                    @else
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td><a href="{{ route('password.index',['group'=>$group]) }}">{{ $group->name }}</a></td>
                                <td>{{ $group->description }}</td>
                                <td>
                                    <a href="{{ route('group.edit', ['id'=>$group->id]) }}" class="btn btn-sm btn-warning" title="Edit">E</a>
                                    <a href="{{ route('group.destroy', ["id" => $group->id]) }}" class="btn btn-sm btn-danger"  data-method="DELETE" data-confirm="Are you sure ?" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfooter></tfooter>
                    </table>
                    {!! $groups->render() !!}
                @endif
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
    </div>
@endsection