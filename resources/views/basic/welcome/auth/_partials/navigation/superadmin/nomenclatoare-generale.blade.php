<div class="panel panel-primary">
    
    <div class="panel-heading">
        <i class="fa fa-home"></i> Nomenclatoare generale
    </div>
    
    <div class="panel-body">
        <div class="row">

            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ \URL::route('superadmin.nomenclatoare.categorii-parteneri.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Nomenclatoare\Categoriepartener::count() }}</div>
                                <div class="sub-title">Categorii partenri GAL</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ \URL::route('superadmin.nomenclatoare.categorii-ong.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Nomenclatoare\Categorieong::count() }}</div>
                                <div class="sub-title">Categorii ONG</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ \URL::route('superadmin.nomenclatoare.tipuri-domenii-relevante.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Nomenclatoare\Domeniurelevant::count() }}</div>
                                <div class="sub-title">Tipuri domenii relevante</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ \URL::route('superadmin.nomenclatoare.categorii-forme-asociative.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Nomenclatoare\Formaasociativa::count() }}</div>
                                <div class="sub-title">Categorii forme asociative</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ \URL::route('superadmin.nomenclatoare.tipuri-forme-asociative.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Nomenclatoare\Tipformaasociativa::count() }}</div>
                                <div class="sub-title">Tipuri forme asociative</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>    

            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ \URL::route('superadmin.nomenclatoare.tipuri-infrastructuri-sociale.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Nomenclatoare\Tipinfrastructurasociala::count() }}</div>
                                <div class="sub-title">Tipuri infrastructuri sociale</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>