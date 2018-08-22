@extends('layouts.default')
@section('title','log in')

@section('content')
<div class="col-md-offset-2 col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>log in</h5>
        </div>
        <div class="panel-body">
            @include('shared._errors')

            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email">email: </label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">password: </label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" name="remember">remember me</label>
                </div>

                <button type="submit" class="btn btn-primary">log in</button>
            </form>

            <hr>

            <p>no account yet? <a href="{{ route('signup') }}">sign up now</a></p>
        </div>
    </div>
</div>
@stop