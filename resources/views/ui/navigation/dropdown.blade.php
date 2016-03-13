<li class="{!! $active!!} ">
    <a href="#{!! $id  !!}" title="{!! $caption !!}" data-toggle="collapse">
        @if(isset($count))<div class="pull-right label label-info">{!! @$count !!}</div>@endif
        <em class="{!! $icon !!}"></em>
        <span data-localize="sidebar.nav.{!! $caption !!}">{!! $caption !!}</span>
    </a>
    <ul id="{!! $id  !!}" class="nav sidebar-subnav collapse @if($active) in @endif" @if($active) style="" @endif>
        <li class="sidebar-subnav-header">{!! $caption !!}</li>
        @foreach($options as $i => $option)
            {!! $option->render() !!}
        @endforeach
    </ul>
</li>