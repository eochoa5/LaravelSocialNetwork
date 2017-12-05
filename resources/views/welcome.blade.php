@extends('layouts.master')

@section('title')
Welcome
@endsection

@section('content')
    @include('includes.message-block')
<section class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <h3>Sign up</h3>
        <form action="{{route('signup')}}" method="post">

        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
            <input class="form-control"  type="text" name="email" id="email" placeholder="email" value="{{Request::old('email')}}">
        </div>
        <div class="form-group">
                <input type="text" class="form-control" name="name" id="name" placeholder="name" value="{{Request::old('name')}}">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="pass" id="pass" placeholder="password" value="{{Request::old('pass')}}">
        </div>

        <button type="submit">Sign up</button>
        <input type="hidden" name="_token" value="{{Session::token()}}">

        </form>

    </div>
</section>
<br>
<section class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <h3>Sign in</h3>
        <form action="{{route('signin')}}" method="post">
            <div class="form-group">
                <input class="form-control" type="text" name="email" id="email" placeholder="email" value="{{Request::old('email')}}">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="pass" id="pass" placeholder="password" value="{{Request::old('pass')}}">
            </div>
            <button type="submit">Sign in</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">

        </form>

    </div>
</section>
@endsection