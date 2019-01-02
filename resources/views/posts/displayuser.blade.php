{{-- Page to display all user--}}
{{-- Extends main layout --}}
@extends('layouts.app')
{{-- Include the main section --}}
@section('content')

    <a href="/createuser" class="btn btn-primary">Create New User</a>
    <br>
    <br>
    <h1>Users</h1>

    @if(count($users) > 0)
        @foreach($users as $user)
            <div class="card card-body bg-light">
                <h3><a href="/edituser/{{$user->id}}">{{$user->name}}</a></h3>
                <small>Joined on {{$user->created_at}}</small>
            </div>
        @endforeach
        
        {{$users->links()}} 
    @else
        <p>No user found</p>
    @endif

@endsection