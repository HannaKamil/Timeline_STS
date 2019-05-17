@extends('layouts.master')
<style>
    .timeline {
        list-style: none;
        padding: 20px 0 20px;
        position: relative;
    }
    .timeline:before {
        top: 0;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 3px;
        background-color: #CCCCCC;
        left: 25px;
        margin-left: -1.5px;
    }
    .timeline > li {
        margin-bottom: 20px;
        position: relative;
    }
    .timeline > li:before,
    .timeline > li:after {
        content: " ";
        display: table;
    }
    .timeline > li:after {
        clear: both;
    }
    .timeline > li:before,
    .timeline > li:after {
        content: " ";
        display: table;
    }
    .timeline > li:after {
        clear: both;
    }
    .timeline > li > .timeline-panel {
        width: calc( 100% - 55px );
        float: right;
        border: 1px solid #d4d4d4;
        border-radius: 22px;
        padding: 10px;
        position: relative;
        -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
    }
    .timeline > li > .timeline-panel:before {
        position: absolute;
        top: 26px;
        left: -15px;
        display: inline-block;
    }
    .timeline > li > .timeline-panel:after {
        position: absolute;
        top: 27px;
        left: -14px;
        display: inline-block;
    }
    .timeline > li > .timeline-badge {
        color: #FFFF99;
        width: 25px;
        height: 25px;
        line-height: 25px;
        font-size: 1.4em;
        text-align: center;
        position: absolute;
        top: 16px;
        left: 13px;

        background-color: #666666;
        z-index: 100;
        border-top-right-radius: 50%;
        border-top-left-radius: 50%;
        border-bottom-right-radius: 50%;
        border-bottom-left-radius: 50%;
    }
    .timeline > li.timeline-inverted > .timeline-panel {
        float: left;
    }
    .timeline > li.timeline-inverted > .timeline-panel:before {
        border-left-width: 0;
        border-right-width: 15px;
        right: -15px;
        right: auto;
    }
    .timeline > li.timeline-inverted > .timeline-panel:after {
        border-left-width: 0;
        border-right-width: 14px;
        left: -14px;
        right: auto;
    }
    .timeline-badge.primary {
        background-color: #006699  !important;
    }
    .timeline-badge.up {
        background-color: #339933 !important;
    }
    .timeline-badge.down {
        background-color: #CC3333 !important;
    }
    .timeline-badge.neutral {
        background-color: #999999 !important;
    }
    .timeline-title {
        margin-top: 0;
        color: inherit;
    }
    .timeline-body > p,
    .timeline-body > ul {
        margin-bottom: 0;
    }
    .timeline-body > p + p {
        margin-top: 5px;
    }
</style>


@section('content')
    <div class="container">
        @include('timeline.flash')
        {{--    //to show the errors valdation from timeline.flash file,,--}}
    </div>


    <form method="post" action="/insert" class="container timeline-badge">
        {{csrf_field()}}
        <div class="form-group shadow-textarea">
            <textarea name="body" class="form-control z-depth-1 ckeditor" rows="3" placeholder="Write something here..." required></textarea>
        </div>

        <button type="submit" style="padding: 5px 15px;" class="btn btn-danger">save</button>

    </form>
    <hr>
    <hr>

{{--    @foreach($timelines as $timeline)--}}
{{--        <table class="container">--}}
{{--            <tr>--}}
{{--                <td>Post NO:{{$timeline->id}}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Publisher: {{$timeline->user->name}}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Post is: {!!$timeline->body!!}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Time: {{$timeline->created_at}}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td><a href="delete/{{$timeline->id}}">Delete</a></td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td><a href="edit/{{$timeline->id}}">Edit</a></td>--}}
{{--            </tr>--}}
{{--            <hr>--}}
{{--        </table>--}}
{{--    @endforeach--}}



    @foreach($timelines as $timeline)

        <div class="container">

            <ul class="timeline">
                <li><!---Time Line Element--->
                    <div class="timeline-badge up"><i class="fa fa-thumbs-up"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h3><div class="badge badge-success">Published By: <i>{{$timeline->user->name}}</i></div></h3>
                        </div>
{{--                        <div class="timeline-heading">--}}
{{--                            <h5 style="font-size: 14px; font-style: italic;">created at: {{ date("F j, Y, g:i a", strtotime($timeline->created_at))}}</h5>--}}
{{--                            <hr>--}}
{{--                        </div>--}}

                        <div class="timeline-heading">
                            <h5 style="font-size: 14px; font-style: italic;">created at: {{$timeline->created_at}}</h5>
                            <hr>
                        </div>
                        <div class="timeline-body"><!---Time Line Body&Content--->
                            <table class="container">
                                <tr>
                                    <td><q>{!!$timeline->body!!}</q></td>
                                </tr>

                            </table>
                            <br>
                            <button class="btn btn-secondary"><a style="text-decoration: none; color: white;" href="delete/{{$timeline->id}}">Delete</a></button>
                            <button class="btn btn-secondary"><a style="text-decoration: none; color: white;" href="edit/{{$timeline->id}}">Edit</a></button>

                        </div>
                    </div>
                </li>
            </ul>
        </div>
    @endforeach


    {{$timelines->links()}}

@endsection

