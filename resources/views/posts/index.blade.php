@extends('~layout.~template')
@section('ctrl')
    ng-controller = "PostsCtrl as ps"
@stop
@section('content')
    @include('posts.content')
@stop

@section('js')
    @parent
    <script src="https://cdn.jsdelivr.net/gh/abdmob/x2js/xml2json.js"></script>
@stop