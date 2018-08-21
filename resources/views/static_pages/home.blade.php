@extends('layouts.default')

@section('content')
<div class="jumbotron">
    <h1>Hello Laravel</h1>
    <p class="lead">
        This is <a href="http://laravel-china.org/courses/laravel-essential-training-5.1">Laravel 入门教程</a> sample demo
    </p>
    <p>
        Everything begin from here
    </p>
    <p>
        <a href="{{ route('signup') }}" class="btn btn-lg btn-success" role="button">sign up</a>
    </p>
</div>
@stop