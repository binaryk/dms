<div class="row">
    @if(Auth::guest())
    <div class="pull-right">
        <div class="btn-group">
            <button type="button" data-toggle="dropdown" class="btn btn-default">Autentificare</button>
            <ul role="menu" class="dropdown-menu dropdown-menu-right animated fadeInUpShort">
                <li><a href="{!! route('auth.login') !!}" data-set-lang="es">Logare</a>
                </li>
                <li><a href="{!! route('auth.register') !!}" data-set-lang="en">Înregistrare</a>
                </li>
            </ul>
        </div>
    </div>
    @endif
    <div class="panel-heading">
        <h3>
            Aceasta este platforma de iCar, din cadrul proiectului PS.
        </h3>
    </div>
    <div class="col-sm-3 col-xs-6 text-center">
        <p>Automobile noi</p>
        <div class="h1">25</div>
    </div>
    <div class="col-sm-3 col-xs-6 text-center">
        <p>Automobile vechi</p>
        <div class="h1">85</div>
    </div>
    <div class="col-sm-3 col-xs-6 text-center">
        <p>Timp procesare</p>
        <div class="h1">380</div>
    </div>
    <div class="col-sm-3 col-xs-6 text-center">
        <p>Buget</p>
        <div class="h1">$ 10,000.00</div>
    </div>
</div>