@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="panel-body">
                        <a href="/posts/create" class="btn btn-primary">Create Order</a>
                        <br>
                        <br>
                        <h3>Your Order</h3>

                        @if(count($posts) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                </tr>
                                {{-- loop all post for the logged in user --}}
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post->title}}</td>
                                        <td><a href="/posts/{{$post->id}}" class="btn btn-outline-primary">View</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>You have no order</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
