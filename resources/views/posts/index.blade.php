@extends('~layout.~template')
@section('ctrl')
    ng-controller = "PostsCtrl as ps"
@stop
@section('content')
    @include('posts.content')
@stop

@section('js')
    @parent
    <script src="https://cdn.rawgit.com/abdmob/x2js/master/xml2json.js"></script>
@stop