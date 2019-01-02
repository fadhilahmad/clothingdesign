@extends('layouts.app')

@section('content')

    <a href="/displayuser"  class="btn btn-outline-primary">Go Back</a>
    <br>
    <br>
    <h1>Update User</h1> 

    {{-- form from laravel collective --}}
    {{ Form::open(['action' => ['PostsController@updateuser', $user->id], 'method' => 'POST']) }}
        {{-- name --}}
        <div class="form-group">
            {{-- label for name --}}
            {{Form::label('name', 'Name')}}
            {{-- input text field for name --}}
            {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        {{-- phone --}}
        <div class="form-group">
            {{-- label for phone --}}
            {{Form::label('phone', 'Phone')}}
            {{-- input text field for phone --}}
            {{Form::text('phone', $user->phone, ['class' => 'form-control', 'placeholder' => 'Phone'])}}
        </div>
        {{-- address --}}
        <div class="form-group">
            {{-- label for address --}}
            {{Form::label('address', 'Address')}}
            {{-- input text field for name --}}
            {{Form::text('address', $user->address, ['class' => 'form-control', 'placeholder' => 'Address'])}}
        </div>
        {{-- email --}}
        <div class="form-group">
            {{-- label for email --}}
            {{Form::label('email', 'Email')}}
            {{-- input text field for email --}}
            {{Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
        </div>
        
        {{-- user type --}}
        <div class="form-group">
            {{-- label for user type --}}
            {{Form::label('user_type', 'User Type')}}
            <br>
            {{-- dropdown for user type --}}
            {{Form::select('user_type', ['customer' => 'Customer', 'designer' => 'Designer', 'moulder' => 'Moulder', 'tailor' => 'Tailor', 'admin' => 'Admin', 'manager' => 'Manager', 'hr' => 'HR'], $user->user_type)}}
        </div>
        
        <br>
        {{-- Submit button --}}
        {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
        
    {{ Form::close() }}
    <br>
    {!!Form::open(['action' => ['PostsController@destroyuser', $user->id], 'method' => 'POST'])!!}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!} 

@endsection