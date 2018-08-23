@extends('layouts.default')
@section('title','password reset')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">password reset</div>
            <div class="panel-body">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? 'has-eror' : '' }}">
                        <label for="email" class="col-md-4 control-label">email: </label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button class="btn btn-primary" type="submit">
                                send email for password reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop