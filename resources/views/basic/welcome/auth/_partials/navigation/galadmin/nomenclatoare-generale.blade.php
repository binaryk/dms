<div class="panel panel-primary">
    
    <div class="panel-heading">
        <i class="fa fa-home"></i> {{ Access::user()->gali()->first()->gal }}. Nomenclatoare specifice GAL
    </div>
    
    <div class="panel-body">
        <div class="row">

            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ URL::route('galadmin.nomenclatoare.parteneri.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Admin\Gal\Partener::forgal($current_gal->id)->count() }}</div>
                                <div class="sub-title">Parteneri GAL</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ URL::route('galadmin.nomenclatoare.masuri.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Admin\Gal\Masura::forgal($current_gal->id)->count() }}</div>
                                <div class="sub-title">Măsuri aferente GAL</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>

</div>