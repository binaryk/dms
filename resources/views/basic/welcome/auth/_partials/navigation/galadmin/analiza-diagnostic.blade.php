<div class="panel panel-primary">
    
    <div class="panel-heading">
        <i class="fa fa-home"></i> {{ Access::user()->gali()->first()->gal }}. Analiza diagnostic a teritoriului GAL
    </div>
    
    <div class="panel-body">
        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ URL::route('galadmin.diagnostic-teritoriu.domenii-relevante.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Admin\Gal\DomeniuRelevant::forgal($current_gal->id)->count() }}</div>
                                <div class="sub-title">Domenii relevante pe localităţi</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ URL::route('galadmin.diagnostic-teritoriu.forme-asociative.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Admin\Gal\FormaAsociativa::forgal($current_gal->id)->count() }}</div>
                                <div class="sub-title">Forme asociative în teritoriul GAL</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ URL::route('galadmin.diagnostic-teritoriu.grupuri-tinta.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Admin\Gal\GrupTinta::forgal($current_gal->id)->count() }}</div>
                                <div class="sub-title">Grupuri ţintă actuale în teritoriul GAL</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>