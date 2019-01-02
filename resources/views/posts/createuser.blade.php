@extends('layouts.app')

@section('content')

    <a href="/displayuser"  class="btn btn-outline-primary">Go Back</a>
    <br>
    <br>
    <h1>Create New User</h1>

    {{-- form from laravel collective --}}
    {{ Form::open(['action' => 'PostsController@storeuser', 'method' => 'POST']) }}
        {{-- name --}}
        <div class="form-group">
            {{-- label for name --}}
            {{Form::label('name', 'Name')}}
            {{-- input text field for name --}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        {{-- phone --}}
        <div class="form-group">
            {{-- label for phone --}}
            {{Form::label('phone', 'Phone')}}
            {{-- input text field for phone --}}
            {{Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'Phone'])}}
        </div>
            {{-- address --}}
        <div class="form-group">
            {{-- label for address --}}
            {{Form::label('address', 'Address')}}
            {{-- input text field for address --}}
            {{Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Address'])}}
        </div>
        {{-- email --}}
        <div class="form-group">
            {{-- label for email --}}
            {{Form::label('email', 'Email')}}
            {{-- input text field for email --}}
            {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
        </div>
        {{-- password --}}
        <div class="form-group">
            {{-- label for password --}}
            {{Form::label('password', 'Password')}}
            {{-- input text field for password --}}
            {{-- {{Form::text('password', '', ['class' => 'form-control', 'placeholder' => 'Password'])}} --}}
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        {{-- Confirm Password --}}
        <div class="form-group">
            {{-- label for Confirm Password --}}
            {{Form::label('confirmpassword', 'Confirm Password')}}
            {{-- input text field for Confirm Password --}}
            {{-- {{Form::text('confirmpassword', '', ['class' => 'form-control', 'placeholder' => 'Confirm Password'])}} --}}
            <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
        </div>
        
        {{-- user type --}}
        <div class="form-group">
            {{-- label for user type --}}
            {{Form::label('user_type', 'User Type')}}
            <br>
            {{-- dropdown for user type --}}
            {{Form::select('user_type', ['customer' => 'Customer', 'designer' => 'Designer', 'moulder' => 'Moulder', 'tailor' => 'Tailor', 'admin' => 'Admin', 'manager' => 'Manager', 'hr' => 'HR'], 'customer')}}
        </div>
        

        <br>
        {{-- Submit button --}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}

@endsection