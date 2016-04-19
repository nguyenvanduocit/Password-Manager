@extends('group.base')
@section('content')
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Create group</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{{ route('group.store') }}">
                {!! csrf_field() !!}
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{ old('name') }}">
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
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('members') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label">Members</label>
                    <div class="col-sm-10">
                        <select name="members[]" data-tag="true" data-allow-clear="true" aria-multiselectable="true" class="form-control user-select" multiple="multiple" data-placeholder="Select a Member">
                        </select>

                        @if ($errors->has('members'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('members') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('owners') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label">Owners</label>
                    <div class="col-sm-10">
                        <select name="owners[]" data-tag="true" data-allow-clear="true" aria-multiselectable="true" class="form-control user-select" multiple="multiple" data-placeholder="Select a Member">
                            <option selected value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                        </select>

                        @if ($errors->has('owners'))
                            <span class="help-block">
                                <strong>{{ $errors->first('owners') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Create group</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
    </div>
@endsection
