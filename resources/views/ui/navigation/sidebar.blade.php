<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::route('welcome-index') }}">
                    <div class="icon fa fa-paper-plane"></div>
                    <div class="title">GalOnline V.2</div>
                </a>
                <button type="button" class="navbar-expand-toggle pull-right visible-xs"><i class="fa fa-times icon"></i></button>
            </div>
            <ul class="nav navbar-nav">
            @foreach($options as $i => $option)
                {!! $option->render() !!}
            @endforeach    
            </ul>
        </div>
    </nav>
</div>