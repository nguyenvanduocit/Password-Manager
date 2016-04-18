@extends('group.base')
@section('content')
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Edit group</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{{ route('group.update', ['id'=>$group->id]) }}">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required id="name" name="name" placeholder="name" value="{{ old('name')?old('name'):$group->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Description">{{ old('description')?old('description'):$group->description }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
    </div>
@endsection
