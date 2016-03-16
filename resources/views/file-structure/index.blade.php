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