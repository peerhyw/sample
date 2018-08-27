@extends('layouts.default')
@section('title',$title)

@section('content')
<div class="col-md-offset-2 col-md-8">
    <h1>{{ $title }}</h1>
    <ul class="users">
        @foreach($users as $user)
            <li>
                <div class="nameblock">
                    <div class="imgblock">
                        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar"/>
                    </div>
                    <div class="nametext">
                        <a href="{{ route('users.show',$user->id) }}" class="username">{{ $user->name }}</a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    {!! $users->render() !!}
</div>
@stop