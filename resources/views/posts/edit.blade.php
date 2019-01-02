
@extends('layouts.app')

@section('content')

    <a href="/posts/{{$post->id}}"  class="btn btn-outline-primary">Go Back</a>
    <br>
    <br>
    <h1>Edit Order</h1>

    {{-- form from laravel collective --}}
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{-- title --}}
        <div class="form-group">
            {{-- label for title --}}
            {{Form::label('title', 'Title')}}
            {{-- input text field for title --}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        {{-- description --}}
        <div class="form-group">
            {{-- label for description --}}
            {{Form::label('description', 'Description')}}
            {{-- input text area field for description and add editor in the array --}}
            {{Form::textarea('description', $post->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Decription'])}}
        </div>
        {{-- amount --}}
        <div class="form-group">
                {{-- label for amount --}}
                {{Form::label('amount', 'Amount')}}
                {{-- input text field for amount --}}
                {{Form::number('amount', $post->amount, ['class' => 'form-control', 'placeholder' => 'Amount'])}}
            </div>
        {{-- gender --}}
        <div class="form-group">
            {{-- label for gender --}}
            {{Form::label('gender', 'Gender')}}
            <br>
            {{-- radio field for gender --}}
            {{Form::radio('gender', 'male', ($post->gender=="male")? "checked" : "")}} Male
            <br>
            {{Form::radio('gender', 'female', ($post->gender=="female")? "checked" : "")}} Female
            <br>
            {{Form::radio('gender', 'kid', ($post->gender=="kid")? "checked" : "")}} Kid
        </div>
        {{-- size --}}
        <div class="form-group">
            {{-- label for size --}}
            {{Form::label('size', 'Size')}}
            <br>
            {{-- dropdown for size --}}
            {{Form::select('size', ['L' => 'Large', 'M' => 'Medium', 'S' => 'Small'], $post->size)}}
        </div>
        {{-- collar type --}}
        <div class="form-group">
            {{-- label for collar --}}
            {{Form::label('collar', 'Collar Type')}}
            <br>
            {{-- dropdown for collar --}}
            {{Form::select('collar', ['crew neck' => 'Crew Neck', 'v neck' => 'V Neck', 'y neck' => 'Y Neck', 'polo collar' => 'Polo Collar', 'scoop neck' => 'Scoop Neck'], $post->collar)}}
        </div>
        {{-- sleeve type --}}
        <div class="form-group">
            {{-- label for sleeve --}}
            {{Form::label('sleeve', 'Sleeve Type')}}
            <br>
            {{-- dropdown for sleeve --}}
            {{Form::select('sleeve', ['normal sleeves' => 'Normal Sleeves', 'sleeveless' => 'Sleeveless', 'cap sleeves' => 'Cap Sleeves', 'half sleeves' => 'Half Sleeves', 'three quarter sleeves' => 'three quarter Sleeves', 'full-length sleeves' => 'Full-length Sleeves'], $post->sleeve)}}
        </div>
        {{-- color --}}
        <div class="form-group">
            {{-- label for color --}}
            {{Form::label('color', 'Color')}}
            <br>
            {{-- dropdown for color --}}
            {{Form::select('color', ['white' => 'White', 'black' => 'Black', 'yellow' => 'Yellow', 'green' => 'Green', 'blue' => 'Blue'], $post->color)}}
        </div>
        {{-- material --}}
        <div class="form-group">
            {{-- label for material --}}
            {{Form::label('material', 'Material')}}
            <br>
            {{-- dropdown for material --}}
            {{Form::select('material', ['100-cotton' => '100% Cotton', 'ultra-soft' => 'Ultra Soft', 'organic' => 'Organic', 'uv-protection' => 'UV Protection', 'poly-cotton' => 'Poly/Cotton'], $post->material)}}
        </div>
        {{-- features --}}
        <div class="form-group">
            {{-- label for features --}}
            {{Form::label('features', 'Features')}}
            <br>
            {{-- radio field for features  (strpos($post->features, 'pocket') !== false) --}}
            {{Form::checkbox('features[]', 'pocket', (strpos($post->features, 'pocket') !== false)? "checked" : "")}} Pocket
            <br>
            {{Form::checkbox('features[]', 'tie-dye', (strpos($post->features, 'tie-dye') !== false)? "checked" : "")}} Tie-Dye
            <br>
            {{Form::checkbox('features[]', 'v-neck', (strpos($post->features, 'v-neck') !== false)? "checked" : "")}} V-Neck
        </div>

        <div class="form-group">
            {{-- use laravel collective package --}}
            {{Form::file('cover_image')}}
        </div>

        {{-- status --}}
        <div class="form-group">
            {{-- label for status --}}
            {{Form::label('status', 'Status')}}
            <br>
            {{-- dropdown for size --}}
            {{Form::select('status', ['Submitted' => 'Submitted', 'Drafted' => 'Drafted', 'Accepted' => 'Accepted', 
            'Designed' => 'Designed', 'Mouldered' => 'Mouldered', 'Tailored' => 'Tailored', 'Packaged' => 'Packaged',
            'Posted' => 'Posted', 'Delivered' => 'Delivered'], $post->status)}}
        </div>

        {{-- delivery mode --}}
        <div class="form-group">
            {{-- label for delivery mode --}}
            {{Form::label('delivery', 'Delivery Mode')}}
            <br>
            {{-- dropdown for size --}}
            {{Form::select('delivery', ['self-pickup' => 'Self-pickup', 'postage' => 'Postage'], $post->delivery)}}
        </div>

        {{-- spoof 'PUT' request using hidden--}}
        {{Form::hidden('_method', 'PUT')}}
        <br>
        {{-- Submit button --}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}

@endsection