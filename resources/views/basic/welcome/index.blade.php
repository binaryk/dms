@extends('~layout.~template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('basic.welcome.' . ( Auth::guest() ? 'guest' : 'auth' ) . '.index')
        </div>
    </div>

@stop
