@extends('~layout.~template')
@section('content')
    <div ng-controller="FileStructureCtrl as fs" ng-cloak>
        @if(count($files) === 0)
            @include('file-structure.parts.no_files')
        @else
            @include('file-structure.parts.files')
        @endif
        @include('file-structure.parts.dir_name')

        @include('file-structure.parts.modal')
    </div>
@stop

@include('file-structure.parts.routes')