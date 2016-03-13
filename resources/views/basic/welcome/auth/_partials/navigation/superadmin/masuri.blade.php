<div class="panel panel-primary">
    
    <div class="panel-heading">
        <i class="fa fa-home"></i> Priorităţi, Domenii de intervenţii, Măsuri
    </div>
    
    <div class="panel-body">
        <div class="row">

            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href=" {{ \URL::route('superadmin.masuri.tipuri-prioritati.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Masuri\Prioritate::count() }}</div>
                                <div class="sub-title">Tipuri de priorităţi</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>

            <!--
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="#">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Masuri\DomeniuInterventie::count() }}</div>
                                <div class="sub-title">Domenii de intervenţii</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>
            -->
            
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ \URL::route('superadmin.masuri.masuri-tipizate.index') }}">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-share-alt fa-4x"></i>
                            <div class="content">
                                <div class="title">{{ App\Models\Masuri\Masura::count() }}</div>
                                <div class="sub-title">Măsuri tipizate</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>

</div>