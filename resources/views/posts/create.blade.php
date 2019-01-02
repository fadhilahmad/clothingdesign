@extends('layouts.app')

@section('content')

    <h1>Create Order</h1>

    {{-- form from laravel collective --}}
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{-- title --}}
        <div class="form-group">
            {{-- label for title --}}
            {{Form::label('title', 'Title')}}
            {{-- input text field for title --}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        {{-- description --}}
        <div class="form-group">
            {{-- label for description --}}
            {{Form::label('description', 'Description')}}
            {{-- input text area field for description and add editor in the array --}}
            {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Decription'])}}
        </div>
        {{-- amount --}}
        <div class="form-group">
            {{-- label for amount --}}
            {{Form::label('amount', 'Amount')}}
            {{-- input text field for amount --}}
            {{Form::number('amount', '', ['class' => 'form-control', 'placeholder' => 'Amount'])}}
        </div>
        {{-- gender --}}
        <div class="form-group">
            {{-- label for gender --}}
            {{Form::label('gender', 'Gender')}}
            <br>
            {{-- radio field for gender --}}
            {{Form::radio('gender', 'male', true)}} Male
            <br>
            {{Form::radio('gender', 'female')}} Female
            <br>
            {{Form::radio('gender', 'kid')}} Kid
        </div>
        {{-- size --}}
        <div class="form-group">
            {{-- label for size --}}
            {{Form::label('size', 'Size')}}
            <br>
            {{-- dropdown for size --}}
            {{Form::select('size', ['L' => 'Large', 'M' => 'Medium', 'S' => 'Small'], 'S')}}
        </div>
        {{-- collar type --}}
        <div class="form-group">
            {{-- label for collar --}}
            {{Form::label('collar', 'Collar Type')}}
            <br>
            {{-- dropdown for collar --}}
            {{Form::select('collar', ['crew neck' => 'Crew Neck', 'v neck' => 'V Neck', 'y neck' => 'Y Neck', 'polo collar' => 'Polo Collar', 'scoop neck' => 'Scoop Neck'], 'crew neck')}}
        </div>
        {{-- sleeve type --}}
        <div class="form-group">
            {{-- label for sleeve --}}
            {{Form::label('sleeve', 'Sleeve Type')}}
            <br>
            {{-- dropdown for sleeve --}}
            {{Form::select('sleeve', ['normal sleeves' => 'Normal Sleeves', 'sleeveless' => 'Sleeveless', 'cap sleeves' => 'Cap Sleeves', 'half sleeves' => 'Half Sleeves', 'three quarter sleeves' => 'three quarter Sleeves', 'full-length sleeves' => 'Full-length Sleeves'], 'normal sleeves')}}
        </div>
        {{-- color --}}
        <div class="form-group">
            {{-- label for color --}}
            {{Form::label('color', 'Color')}}
            <br>
            {{-- dropdown for color --}}
            {{Form::select('color', ['white' => 'White', 'black' => 'Black', 'yellow' => 'Yellow', 'green' => 'Green', 'blue' => 'Blue'], 'white')}}
        </div>
        {{-- material --}}
        <div class="form-group">
            {{-- label for material --}}
            {{Form::label('material', 'Material')}}
            <br>
            {{-- dropdown for material --}}
            {{Form::select('material', ['100-cotton' => '100% Cotton', 'ultra-soft' => 'Ultra Soft', 'organic' => 'Organic', 'uv-protection' => 'UV Protection', 'poly-cotton' => 'Poly/Cotton'], '100-cotton')}}
        </div>
        {{-- features --}}
        <div class="form-group">
            {{-- label for features --}}
            {{Form::label('features', 'Features')}}
            <br>
            {{-- radio field for features --}}
            {{Form::checkbox('features[]', 'pocket')}} Pocket
            <br>
            {{Form::checkbox('features[]', 'tie-dye')}} Tie-Dye
            <br>
            {{Form::checkbox('features[]', 'v-neck')}} V-Neck
        </div>

        <div class="form-group">
            {{-- use laravel collective package --}} 
            {{Form::file('cover_image')}}
            {{-- <input type="file" name="cover_image[]" multiple> --}}
        </div>

        {{-- delivery mode --}}
        <div class="form-group">
            {{-- label for delivery mode --}}
            {{Form::label('delivery', 'Delivery Mode')}}
            <br>
            {{-- dropdown for size --}}
            {{Form::select('delivery', ['self-pickup' => 'Self-pickup', 'postage' => 'Postage'], 'postage')}}
        </div>

        <br>
        {{-- Submit button --}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}

@endsection