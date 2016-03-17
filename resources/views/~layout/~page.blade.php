<!-- Main section-->
<section>
    <!-- Page content-->
    <div class="content-wrapper">
        @yield('heading')
    @if($page)
        @yield('helper-title')
        <h3>{!! $page['title'] !!}
        <small>{!! $page['small'] !!}</small>
        </h3>
        @endif
            @yield('content')
    </div>
</section>