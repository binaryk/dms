<!DOCTYPE html>
<html lang="en" ng-app="dms">
@include('~layout.~head')
<body ng-controller="MainCtrl">
<div class="wrapper" ng-cloak @yield('ctrl')>
    @include('~layout.~top')
    @if(!Auth::guest())
        @include('~layout.~sidebar')
    @endif
    @include('~layout.~page')
    @include('~layout.~footer')
</div>
@include('~layout.~js')
</body>
</html>