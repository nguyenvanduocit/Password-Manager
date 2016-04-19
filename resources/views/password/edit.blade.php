@extends('group.base')
@section('content')
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Update password</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{{ route('password.update',['id'=>$password->id]) }}">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="username" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ old('title')?old('title'):$password->title }}">
                        @if ($errors->has('title'))
                            <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('url') ? ' has-error' : '' }}">
                    <label for="username" class="col-sm-2 control-label">URL</label>
                    <div class="col-sm-10">
                        <input type="url" class="form-control" id="url" name="url" placeholder="url" value="{{ old('url')?old('url'):$password->url }}">
                        @if ($errors->has('url'))
                            <span class="help-block"><strong>{{ $errors->first('url') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" placeholder="username" value="{{ old('username')?old('username'):$password->username }}">
                        @if ($errors->has('username'))
                            <span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="username" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="password" name="email" placeholder="email" value="{{ old('email')?old('email'):$password->email }}">
                        @if ($errors->has('email'))
                            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="username" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="password" value="{{ old('password')?old('password'):$password->password }}">
                        @if ($errors->has('password'))
                            <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('groups') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label">Groups</label>
                    <div class="col-sm-10">
                        <select name="groups[]" data-tag="true" data-allow-clear="true" aria-multiselectable="true" multiple class="form-control group-select" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                            @foreach($groups as $group)
                                <option @if(in_array($group->id, $selectedGroup)) selected @endif value="{{ $group->id }}">{{ $group->name }}</option>
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
                        <textarea name="note" id="note" cols="30" rows="10" class="form-control" placeholder="Description">{{ old('note')?old('note'):$password->note }}</textarea>
                        @if ($errors->has('note'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
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
