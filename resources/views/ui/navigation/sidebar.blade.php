<aside class="aside">
    <div class="aside-inner">
        <nav data-sidebar-anyclick-close="" class="sidebar">
            <ul class="nav">
                <li class="nav-heading ">
                    <span data-localize="sidebar.heading.HEADER">Main Navigation</span>
                </li>
                @foreach($options as $i => $option)
                    {!! $option->render() !!}
                @endforeach
            </ul>
        </nav>
    </div>
</aside>