@extends('~layout.~template')
@section('ctrl')
   ng-controller = "FileStructureCtrl as fs"
@stop
@section('content')
        <div ng-if="fs.files.length == 0" class="ng-cloak">
            <div role="alert" class="alert alert-warning col-md-6">
                <h3>Atenție!</h3><h4>Încă nu aveți nici un director de lucru. Pentru a crea primul director accesati butonul de mai jos.</h4>
                <button type="button" class="btn btn-default btn-sm pull-left" ng-click="fs.addDirectory()">Crează director</button>
            </div>
        </div>
        @include('file-structure.parts.no_files')
        @include('file-structure.parts.dir_name')
        @include('file-structure.parts.files')
        @include('file-structure.parts.modal')
@stop

@include('file-structure.parts.routes')

@section('css')
    @parent
    <link rel="stylesheet" href="{!! asset('components/angular-ui-tree/dist/angular-ui-tree.css') !!}">
@stop