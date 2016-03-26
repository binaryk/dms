<div class="row">
    <div class="col-lg-3 col-sm-6">
        <!-- START widget-->
        <a href="{!! route('file_structure.index') !!}">
            <div class="panel widget bg-primary">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-primary-dark pv-lg">
                        <em class="icon-cloud-upload fa-3x"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div class="h2 mt0">{!! $file_count !!}</div>
                        <div class="text-uppercase">Fisiere</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-sm-6">
        <!-- START widget-->
        <div class="panel widget bg-purple">
            <div class="row row-table">
                <div class="col-xs-4 text-center bg-purple-dark pv-lg">
                    <em class="icon-globe fa-3x"></em>
                </div>
                <div class="col-xs-8 pv-lg">
                    <div class="h2 mt0">{!! $storage !!}
                        <small>KB</small>
                    </div>
                    <div class="text-uppercase">Total date</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <!-- START widget-->
        <div class="panel widget bg-green">
            <div class="row row-table">
                <div class="col-xs-4 text-center bg-green-dark pv-lg">
                    <em class="icon-bubbles fa-3x"></em>
                </div>
                <div class="col-xs-8 pv-lg">
                    <div class="h2 mt0">5</div>
                    <div class="text-uppercase">Comentarii</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <!-- START date widget-->
        <div class="panel widget">
            <div class="row row-table">
                <div class="col-xs-4 text-center bg-green pv-lg">
                    <!-- See formats: https://docs.angularjs.org/api/ng/filter/date-->
                    <div data-now="" data-format="MMMM" class="text-sm"></div>
                    <br>
                    <div data-now="" data-format="D" class="h2 mt0"></div>
                </div>
                <div class="col-xs-8 pv-lg">
                    <div data-now="" data-format="dddd" class="text-uppercase"></div>
                    <br>
                    <div data-now="" data-format="h:mm" class="h2 mt0"></div>
                    <div data-now="" data-format="a" class="text-muted text-sm"></div>
                </div>
            </div>
        </div>
        <!-- END date widget    -->
    </div>
</div>