@extends('layouts.default')
@section('title','update profile')

@section('content')
<div class="col-md-offset-2 col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>update profile</h5>
        </div>
        <div class="panel-body">

            @include('shared._errors')

            <div class="gravatar_edit">
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="gravatar img-circle" width="100" height="100" />
            </div>

            <form action="{{ route('users.update',$user->id) }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">name: </label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label for="email">email: </label>
                    <input type="text" name="email" class="form-control" value="{{ $user->email }}" disabled>
                </div>

                <div class="form-group">
                    <label for="password">password: </label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}" >
                </div>

                <div class="form-group">
                    <label for="password_confirmation">password confirm: </label>
                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('password') }}" >
                </div>

                <div class="form-group">
                    <label for="avatar">avatar: </label>
                    <input type="file" name="avatar">

                    @if($user->avatar)
                        <br>
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-circle img-responsive" width="200">
                    @endif
                </div>

                <button type='submit' class="btn btn-primary">update</button>

            </form>
        </div>
    </div>
</div>