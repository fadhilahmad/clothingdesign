
{{-- Extends main layout --}}
@extends('layouts.app')

{{-- Include the main section --}}
@section('content')

    @can('isAdmin')
        <a href="/posts"  class="btn btn-outline-primary">Go Back</a>
    @endcan
    @can('isDesigner')
        <a href="/posts"  class="btn btn-outline-primary">Go Back</a>
    @endcan
    @can('isMoulder')
        <a href="/posts"  class="btn btn-outline-primary">Go Back</a>
    @endcan
    @can('isTailor')
        <a href="/posts"  class="btn btn-outline-primary">Go Back</a>
    @endcan
    @can('isCustomer')
        <a href="/dashboard"  class="btn btn-outline-primary">Go Back</a>
    @endcan
    @can('isManager')
        <a href="/posts"  class="btn btn-outline-primary">Go Back</a>
    @endcan
    <br>
    <br>
    <h1>Title: {{$post->title}}</h1>
    <?php 
        if($post->status == 'Submitted' || $post->status == 'Drafted' || $post->status == 'Rejected'){
    ?>
        <img style="width:270px; height:300px" src="/storage/cover_images/{{$post->cover_image}}">
    <?php
        }else{
    ?>
         <img style="width:270px; height:300px" src="/storage/draft_image/{{$post->draft_image}}">
    <?php
        }
    ?>
    {{-- <img style="width:270px; height:300px" src="/storage/cover_images/{{$post->cover_image}}"> --}}
    <br>
    <br>
    @can('isDesigner')
        <a href="{{ route('downloadFile', $post->id) }}" class="btn btn-primary">Download</a>
    @endcan
    @can('isAdmin')
        <a href="{{ route('downloadFile', $post->id) }}" class="btn btn-primary">Download</a>
    @endcan
    @can('isManager')
        <a href="{{ route('downloadFile', $post->id) }}" class="btn btn-primary">Download</a>
    @endcan
    <br>
    <br>
    <div class="form-group">
        {{-- Put 2 '!!' because we want to convert html to normal text in editor description --}}
        <p>Description: {!!$post->description!!}</p>
    </div>
    <div class="form-group">
        <p>Gender: {{$post->gender}}</p>
    </div>
    <div class="form-group">
        <p>Size: {{$post->size}}</p>
    </div>
    <div class="form-group">
        <p>Collar Type: {{$post->collar}}</p>
    </div>
    <div class="form-group">
        <p>Sleeve Type: {{$post->sleeve}}</p>
    </div>
    <div class="form-group">
        <p>Color: {{$post->color}}</p>
    </div>
    <div class="form-group">
        <p>Features: {{$post->features}}</p>
    </div>
    <div class="form-group">
        <p>Material: {{$post->material}}</p>
    </div>
    <div class="form-group">
        <p>Amount: {{$post->amount}}</p>
    </div>
    <div class="form-group">
        <p>Delivery Mode: {{$post->delivery}}</p>
    </div>
    <div class="form-group">
        <p>Status: {{$post->status}}</p>
    </div>
    {{-- display reason status is rejected --}}
    <?php 
    if($post->status == 'Rejected'){
    ?>
        <p>Reason: {{$post->desc_reject}}</p>
    <?php
    }
    ?>
    {{-- display view draft button to customer if order status is drafted --}}
    <?php 
    if($post->status == 'Drafted'){
    ?>
        @can('isCustomer')
            <a href="/posts/{{$post->id}}/draft" class="btn btn-outline-primary">View Draft Image</a>
        @endcan
    <?php
    }
    ?>

    {!!Form::open(['action' => ['PostsController@manageaction', $post->id], 'method' => 'POST'])!!}

        {{-- display confirm design button to designer if order status is drafted --}}
        <?php 
        if($post->status == 'Accepted'){
        ?>
            @can('isDesigner')
                <input type="submit" name="submitbutton" value="Designed" class="btn btn-primary">
            @endcan
        <?php
        }
        ?>
        {{-- display mouldered button to moulder if order status is designed --}}
        <?php 
        if($post->status == 'Designed'){
        ?>
            @can('isMoulder')
                <input type="submit" name="submitbutton" value="Mouldered" class="btn btn-primary">
            @endcan
        <?php
        }
        ?>
        {{-- display tailored button to tailor if order status is mouldered --}}
        <?php 
        if($post->status == 'Mouldered' || $post->status == 'Tailored'){
        ?>
            @can('isTailor')

                <?php 
                if($post->status == 'Mouldered'){
                ?>
                    <input type="submit" name="submitbutton" value="Tailored" class="btn btn-primary">
                <?php
                }else{
                ?>
                    <input type="submit" name="submitbutton" value="Packaged" class="btn btn-primary">
                <?php
                }
                ?>
            @endcan
        <?php
        }
        ?>

    {!!Form::close()!!}
    
    <hr>
    <small>Ordered on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>

    @can('isAdmin')
        <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-primary">Edit</a>

        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!} 
    @endcan
    @can('isManager')
        <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-primary">Edit</a>

        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!} 
    @endcan

    {{-- display design button to designer if order status is submitted --}}
    <?php 
    if($post->status == 'Submitted'){
    ?>
        @can('isDesigner')
            <a href="/posts/{{$post->id}}/design" class="btn btn-outline-primary">Design</a>
        @endcan
    <?php
    }
    ?>

    {{-- display design button to designer if order status is submitted --}}
    <?php 
    if($post->status == 'Rejected'){
    ?>
        @can('isDesigner')
            <a href="/posts/{{$post->id}}/design" class="btn btn-outline-primary">Redesign</a>
        @endcan
    <?php
    }
    ?>

    
@endsection
