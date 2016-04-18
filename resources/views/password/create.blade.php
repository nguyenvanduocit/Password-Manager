@extends('group.base')
@section('content')
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Create email</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{{ route('password.store') }}">
                {!! csrf_field() !!}

                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="username" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('url') ? ' has-error' : '' }}">
                    <label for="username" class="col-sm-2 control-label">URL</label>
                    <div class="col-sm-10">
                        <input type="url" class="form-control" id="url" name="url" placeholder="url" value="{{ old('url') }}">
                        @if ($errors->has('url'))
                            <span class="help-block"><strong>{{ $errors->first('url') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" placeholder="username" value="{{ old('username') }}">
                        @if ($errors->has('username'))
                            <span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="username" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="password" name="email" placeholder="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="username" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="password" name="password" placeholder="password" value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('groups') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label">Groups</label>

                    <div class="col-sm-10">
                        <select name="groups[]" data-tag="true" data-allow-clear="true" aria-multiselectable="true" multiple class="form-control group-select" multiple="multiple">
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('groups'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('groups') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('note') ? ' has-error' : '' }}">
                    <label for="note" class="col-sm-2 control-label">Note</label>
                    <div class="col-sm-10">
                        <textarea name="note" id="note" cols="30" rows="10" class="form-control" placeholder="Description">{{ old('note') }}</textarea>
                        @if ($errors->has('note'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Create</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
    </div>
@endsection
