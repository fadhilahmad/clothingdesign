
{{-- Extends main layout --}}
@extends('layouts.app')

{{-- Include the main section --}}
@section('content')

    {!! Form::open(['action' => ['PostsController@confirmdraft', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

        @can('isCustomer')
            <a href="/posts/{{$post->id}}"  class="btn btn-outline-primary">Go Back</a>
        @endcan
        <br>
        <br>
        <img style="width:270px; height:300px" src="/storage/draft_image/{{$post->draft_image}}">
        <br>
        <br>
        
        <div class="form-group">
            {{-- Put 2 '!!' because we want to convert html to normal text in editor description --}}
            <p>Description: {!!$post->draft_desc!!}</p>
        </div>
        <div class="form-group">
            <label class="radio-inline">
                <input type="radio" name="confirmed" value="Accepted" onclick="disable('reject');" /> Accepted<br>
                <input type="radio" name="confirmed" value="Rejected" onclick="enable('reject');" /> Rejected<br>
            </label>
            <input type="text" name="desc_reject" class="form-control" value="" id="reject" placeholder="Reason" disabled/>
        </div>

        <script type="text/javascript">
        function enable(id) {
            if(id == 'reject'){
                document.getElementById(id).disabled=false;
            }
        }
        function disable(id) {
            if(id == 'reject'){
                document.getElementById(id).disabled=true;
            }
        }
        </script>
        <hr>
        <small>Drafted on {{$post->updated_at}}</small>
        <hr>
        {{-- Submit button --}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    
@endsection
