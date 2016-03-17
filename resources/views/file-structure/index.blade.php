@extends('~layout.~template')
@section('ctrl')
   ng-controller = "FileStructureCtrl as fs"
@stop
@section('content')
        @include('file-structure.parts.no_files')
        @include('file-structure.parts.dir_name')
        @include('file-structure.parts.files')
        @include('file-structure.parts.modal')
@stop

@include('file-structure.parts.routes')

@section('css')
    @parent
    <link rel="stylesheet" href="{!! asset('components/angular-ui-tree/dist/angular-ui-tree.css') !!}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-tree/2.15.0/angular-ui-tree.min.css">
@stop