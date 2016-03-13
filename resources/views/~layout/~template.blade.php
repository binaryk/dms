<!DOCTYPE html>
<html lang="en">
@include('~layout.~head')
<body>
<div class="wrapper">
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