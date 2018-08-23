@extends('layouts.default')
@section('title','update password')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                update password
            </div>

            <div class="panel-body">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="post" action="{{ route('password.update') }}" class="form-horizontal">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">email:</label>

                        <div class="col-md-6">
                            <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">password: </label>

                        <div class="col-md-6">
                            <input type="password" id="password" class="form-control" name="password" required>

                            @if($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">password confirm: </label>
                        <div class="col-md-6">
                            <input type="password" id="password-confirm" class="form-control" name="password_confirmation">

                            @if($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button class="btn btn-primary" type="submit">
                                update password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop