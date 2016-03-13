<li class="{{$active}} panel panel-default dropdown">
    <a data-toggle="collapse" href="#dropdown-{{ $id  }}">
        <span class="{{ $icon }}"></span><span class="title">{{ $caption }}</span>
    </a>
    <!-- Dropdown level 1 -->
    <div id="dropdown-{{ $id }}" class="panel-collapse collapse">
        <div class="panel-body">
            <ul class="nav navbar-nav">
                @foreach($options as $i => $option)
                    {!! $option->render() !!}
                @endforeach
            </ul>
        </div>
    </div>
</li>