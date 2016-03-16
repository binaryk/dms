<!DOCTYPE html>
<html lang="en" ng-app="dms">
@include('~layout.~head')
<body>
<div class="wrapper" ng-cloak ng-controller="MainCtrl">
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