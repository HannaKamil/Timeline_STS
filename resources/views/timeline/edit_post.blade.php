@extends('layouts.master')
@section('content')

    <form method="post" action="/update/{{$id->id}}" class="container timeline-badge">
        {{csrf_field()}}
        <div class="form-group shadow-textarea">
            <textarea name="body"  class="form-control z-depth-1 ckeditor" rows="3" required>{{$id->body}}</textarea>
        </div>

        <button type="submit" style="padding: 5px 15px;" class="btn btn-danger">Update</button>

    </form>

@endsection
