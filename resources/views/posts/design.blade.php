
@extends('layouts.app')

@section('content')

    @can('isDesigner')
        <a href="/posts/{{$post->id}}"  class="btn btn-outline-primary">Go Back</a>
    @endcan
    <h1>Mockup Design</h1>

    {{-- form from laravel collective --}}
    {!! Form::open(['action' => ['PostsController@senddraft', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        {{-- description --}}
        <div class="form-group">
            {{-- label for description --}}
            {{Form::label('description', 'Description')}}
            {{-- input text area field for description and add editor in the array --}}
            {{Form::textarea('draft_desc', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Decription'])}}
        </div>
        
        <div class="form-group">
            {{-- use laravel collective package --}}
            {{Form::file('draft_image')}}
            {{-- <input type="file" name="draft_image[]" multiple> --}}
        </div>

        {{-- spoof 'PUT' request using hidden--}}
        {{-- {{Form::hidden('_method', 'PUT')}} --}}
        <br>
        {{-- Submit button --}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}

@endsection