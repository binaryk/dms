<!-- Main section-->
<section>
    <!-- Page content-->
    <div class="content-wrapper">
        @yield('heading')
    @if(isset($page))
        @yield('helper-title')
        <h3>{!! $page['title'] !!}
        <small>{!! $page['small'] !!}</small>
        </h3>
        @endif
            @include('includes.partials.messages')
            @yield('content')
    </div>
</section>