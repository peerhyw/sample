@extends('layouts.default')

@section('content')
    @if(Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="status_form">
                    @include('shared._status_form')
                </section>
                <h3>weibo feed</h3>
                @include('shared._feed')
            </div>
            <aside class="col-md-4">
                <section class="user_info">
                    @include('shared._user_info',['user' => Auth::user()])
                </section>
                <section class="stats">
                    @include('shared._stats',['user' => Auth::user()])
                </section>
            </aside>
        </div>
    @else
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
    @endif
@stop