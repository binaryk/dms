<header class="topnavbar-wrapper">
    <nav role="navigation" class="navbar topnavbar">
        <div class="navbar-header">
            <a href="{!! url('/') !!}" class="navbar-brand">
                <div class="brand-logo">
                    <img src="{!! asset('angel/img/logo.png')!!}" alt="App Logo" class="img-responsive">
                </div>
                <div class="brand-logo-collapsed">
                    <img src="{!! asset('angel/img/logo-single.png')!!}" alt="App Logo" class="img-responsive">
                </div>
            </a>
        </div>
        <div class="nav-wrapper">

            <ul class="nav navbar-nav">
                @if(!Auth::guest())
                <li>
                        <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                            <em class="fa fa-navicon"></em>
                        </a>
                    <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                        <em class="fa fa-navicon"></em>
                    </a>

                </li>
                <li>
                    <a href="{!! route('frontend.user.dashboard') !!}" >
                        <em class="icon-user"></em>
                    </a>
                </li>
                @endif
                    <ul class="nav navbar-nav navbar-right" role="menu">
                        @foreach (array_keys(config('locale.languages')) as $lang)
                            <li>{!! link_to('lang/'.$lang, trans('menus.language-picker.langs.'.$lang)) !!}</li>
                        @endforeach
                    </ul>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" data-search-open="">
                        <em class="icon-magnifier"></em>
                    </a>
                </li>
                <li class="visible-lg">
                    <a href="#" data-toggle-fullscreen="">
                        <em class="fa fa-expand"></em>
                    </a>
                </li>
               @include('~layout.~notifications')
                @if(!Auth::guest())
                    <li>
                        <a href="{!! route('auth.logout') !!}" title="{!! trans('navs.general.logout') !!}" data-toggle-state="offsidebar-open" data-no-persist="true">
                            <em class="icon-notebook"></em>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <form role="search" action="search.html" class="navbar-form">
            <div class="form-group has-feedback">
                <input type="text" placeholder="Type and hit enter ..." class="form-control">
                <div data-search-dismiss="" class="fa fa-times form-control-feedback"></div>
            </div>
            <button type="submit" class="hidden btn btn-default">Submit</button>
        </form>
    </nav>
</header>