@extends('~layout.~template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(env('APP_ENV') == 'ps')
                @include('ps.pswelcome')
            @else
                @include('basic.welcome.' . ( Auth::guest() ? 'guest' : 'auth' ) . '.index')
            @endif
        </div>
    </div>

@stop
