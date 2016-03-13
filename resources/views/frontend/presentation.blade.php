<!-- Page content-->
<div class="content-wrapper">
    <div class="content-heading">
        <!-- START Language list-->
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" data-toggle="dropdown" class="btn btn-default">English</button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right animated fadeInUpShort">
                    <li><a href="#" data-set-lang="en">English</a>
                    </li>
                    <li><a href="#" data-set-lang="es">Spanish</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END Language list    -->
        Dashboard
        <small data-localize="dashboard.WELCOME"></small>
    </div>
    <!-- START widgets box-->
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <!-- START widget-->
            <div class="panel bg-info-light pt b0 widget">
                <div class="ph">
                    <em class="icon-cloud-upload fa-lg pull-right"></em>
                    <div class="h2 mt0">1700</div>
                    <div class="text-uppercase">Uploads</div>
                </div>
                <div data-sparkline="" data-type="line" data-width="100%" data-height="75px" data-line-color="#23b7e5" data-chart-range-min="0" data-fill-color="#23b7e5" data-spot-color="#23b7e5" data-min-spot-color="#23b7e5" data-max-spot-color="#23b7e5"
                     data-highlight-spot-color="#23b7e5" data-highlight-line-color="#23b7e5" values="2,5,3,7,4,5" style="margin-bottom: -2px" data-resize="true"></div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <!-- START widget-->
            <div class="panel widget bg-purple-light pt b0 widget">
                <div class="ph">
                    <em class="icon-globe fa-lg pull-right"></em>
                    <div class="h2 mt0">700
                        <span class="text-sm text-white">GB</span>
                    </div>
                    <div class="text-uppercase">Quota</div>
                </div>
                <div data-sparkline="" data-type="line" data-width="100%" data-height="75px" data-line-color="#7266ba" data-chart-range-min="0" data-fill-color="#7266ba" data-spot-color="#7266ba" data-min-spot-color="#7266ba" data-max-spot-color="#7266ba"
                     data-highlight-spot-color="#7266ba" data-highlight-line-color="#7266ba" values="1,4,5,4,8,7,10" style="margin-bottom: -2px" data-resize="true"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- START widget-->
            <div class="panel widget bg-info-light pt b0 widget">
                <div class="ph">
                    <em class="icon-bubbles fa-lg pull-right"></em>
                    <div class="h2 mt0">500</div>
                    <div class="text-uppercase">Reviews</div>
                </div>
                <div data-sparkline="" data-type="line" data-width="100%" data-height="75px" data-line-color="#23b7e5" data-chart-range-min="0" data-fill-color="#23b7e5" data-spot-color="#23b7e5" data-min-spot-color="#23b7e5" data-max-spot-color="#23b7e5"
                     data-highlight-spot-color="#23b7e5" data-highlight-line-color="#23b7e5" values="4,5,3,10,7,15" style="margin-bottom: -2px" data-resize="true"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- START widget-->
            <div class="panel widget bg-purple-light pt b0 widget">
                <div class="ph">
                    <em class="icon-pencil fa-lg pull-right"></em>
                    <div class="h2 mt0">35</div>
                    <div class="text-uppercase">Annotations</div>
                </div>
                <div data-sparkline="" data-type="line" data-width="100%" data-height="75px" data-line-color="#7266ba" data-chart-range-min="0" data-fill-color="#7266ba" data-spot-color="#7266ba" data-min-spot-color="#7266ba" data-max-spot-color="#7266ba"
                     data-highlight-spot-color="#7266ba" data-highlight-line-color="#7266ba" values="1,3,4,5,7,8" style="margin-bottom: -2px" data-resize="true"></div>
            </div>
        </div>
    </div>
    <!-- END widgets box-->
    <!-- START chart-->
    <div class="row">
        <div class="col-lg-12">
            <!-- START widget-->
            <div id="panelChart9" ng-controller="FlotChartController" class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Website Performance</div>
                </div>
                <div collapse="panelChart9" class="panel-wrapper">
                    <div class="panel-body">
                        <div class="chart-splinev3 flot-chart"></div>
                    </div>
                </div>
            </div>
            <!-- END widget-->
        </div>
    </div>
    <!-- END chart-->
    <div class="row">
        <div class="col-lg-6">
            <!-- START panel tab-->
            <div role="tabpanel" class="panel panel-transparent">
                <!-- Nav tabs-->
                <ul role="tablist" class="nav nav-tabs nav-justified">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="bb0">
                            <em class="fa fa-clock-o fa-fw"></em>Tasks Panel</a>
                    </li>
                    <li role="presentation">
                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" class="bb0">
                            <em class="fa fa-money fa-fw"></em>Transactions Panel</a>
                    </li>
                </ul>
                <!-- Tab panes-->
                <div class="tab-content p0 bg-white">
                    <div id="home" role="tabpanel" class="tab-pane active">
                        <!-- START list group-->
                        <div class="list-group mb0">
                            <a href="#" class="list-group-item bt0">
                                <span class="label label-purple pull-right">just now</span>
                                <em class="fa fa-fw fa-calendar mr"></em>Calendar updated</a>
                            <a href="#" class="list-group-item">
                                <span class="label label-purple pull-right">4 minutes ago</span>
                                <em class="fa fa-fw fa-comment mr"></em>Commented on a post</a>
                            <a href="#" class="list-group-item">
                                <span class="label label-purple pull-right">23 minutes ago</span>
                                <em class="fa fa-fw fa-truck mr"></em>Order 392 shipped</a>
                            <a href="#" class="list-group-item">
                                <span class="label label-purple pull-right">46 minutes ago</span>
                                <em class="fa fa-fw fa-money mr"></em>Invoice 653 has been paid</a>
                            <a href="#" class="list-group-item">
                                <span class="label label-purple pull-right">1 hour ago</span>
                                <em class="fa fa-fw fa-user mr"></em>A new user has been added</a>
                            <a href="#" class="list-group-item">
                                <span class="label label-purple pull-right">2 hours ago</span>
                                <em class="fa fa-fw fa-check mr"></em>Completed task: "pick up dry cleaning"</a>
                            <a href="#" class="list-group-item">
                                <span class="label label-purple pull-right">yesterday</span>
                                <em class="fa fa-fw fa-globe mr"></em>Saved the world</a>
                            <a href="#" class="list-group-item">
                                <span class="label label-purple pull-right">two days ago</span>
                                <em class="fa fa-fw fa-check mr"></em>Completed task: "fix error on sales page"</a>
                            <a href="#" class="list-group-item">
                                <span class="label label-purple pull-right">two days ago</span>
                                <em class="fa fa-fw fa-check mr"></em>Completed task: "fix error on sales page"</a>
                        </div>
                        <!-- END list group-->
                        <div class="panel-footer text-right"><a href="#" class="btn btn-default btn-sm">View All Activity </a>
                        </div>
                    </div>
                    <div id="profile" role="tabpanel" class="tab-pane">
                        <!-- START table responsive-->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Order Date</th>
                                    <th>Order Time</th>
                                    <th>Amount (USD)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>3326</td>
                                    <td>10/21/2013</td>
                                    <td>3:29 PM</td>
                                    <td>$321.33</td>
                                </tr>
                                <tr>
                                    <td>3325</td>
                                    <td>10/21/2013</td>
                                    <td>3:20 PM</td>
                                    <td>$234.34</td>
                                </tr>
                                <tr>
                                    <td>3324</td>
                                    <td>10/21/2013</td>
                                    <td>3:03 PM</td>
                                    <td>$724.17</td>
                                </tr>
                                <tr>
                                    <td>3323</td>
                                    <td>10/21/2013</td>
                                    <td>3:00 PM</td>
                                    <td>$23.71</td>
                                </tr>
                                <tr>
                                    <td>3322</td>
                                    <td>10/21/2013</td>
                                    <td>2:49 PM</td>
                                    <td>$8345.23</td>
                                </tr>
                                <tr>
                                    <td>3321</td>
                                    <td>10/21/2013</td>
                                    <td>2:23 PM</td>
                                    <td>$245.12</td>
                                </tr>
                                <tr>
                                    <td>3320</td>
                                    <td>10/21/2013</td>
                                    <td>2:15 PM</td>
                                    <td>$5663.54</td>
                                </tr>
                                <tr>
                                    <td>3319</td>
                                    <td>10/21/2013</td>
                                    <td>2:13 PM</td>
                                    <td>$943.45</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- END table responsive-->
                        <div class="panel-footer text-right"><a href="#" class="btn btn-default btn-sm">View All Transactions</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END panel tab-->
        </div>
        <div ng-controller="VectorMapController" class="col-lg-6">
            <div class="panel panel-transparent">
                <div data-vector-map="" data-height="450" data-scale='0' data-map-name="world_mill_en"></div>
            </div>
        </div>
    </div>
    <!-- START Widgets-->
    <div class="row">
        <div class="col-lg-3">
            <!-- START loader widget-->
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="#" class="text-muted pull-right">
                        <em class="fa fa-arrow-right"></em>
                    </a>
                    <div class="text-info">Average Monthly Uploads</div>
                    <canvas data-classyloader="" data-percentage="70" data-speed="20" data-font-size="40px" data-diameter="70" data-line-color="#23b7e5" data-remaining-line-color="rgba(200,200,200,0.4)" data-line-width="10"
                            data-rounded-line="true" class="center-block"></canvas>
                    <div data-sparkline="" data-bar-color="#23b7e5" data-height="30" data-bar-width="5" data-bar-spacing="2" values="5,4,8,7,8,5,4,6,5,5,9,4,6,3,4,7,5,4,7" class="text-center"></div>
                </div>
                <div class="panel-footer">
                    <p class="text-muted">
                        <em class="fa fa-upload fa-fw"></em>
                        <span>This Month</span>
                        <span class="text-dark">1000 Gb</span>
                    </p>
                </div>
            </div>
            <!-- END loader widget-->
        </div>
        <div class="col-lg-3">
            <!-- START messages and activity-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Latest activities</div>
                </div>
                <!-- START list group-->
                <div class="list-group">
                    <!-- START list group item-->
                    <div class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                 <span class="fa-stack">
                                    <em class="fa fa-circle fa-stack-2x text-purple"></em>
                                    <em class="fa fa-cloud-upload fa-stack-1x fa-inverse text-white"></em>
                                 </span>
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="text-muted pull-right ml">15m</small>
                                <div class="media-box-heading"><a href="#" class="text-purple m0">NEW FILE</a>
                                </div>
                                <p class="m0">
                                    <small><a href="#">Bootstrap.xls</a>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- END list group item-->
                    <!-- START list group item-->
                    <div class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                 <span class="fa-stack">
                                    <em class="fa fa-circle fa-stack-2x text-info"></em>
                                    <em class="fa fa-file-text-o fa-stack-1x fa-inverse text-white"></em>
                                 </span>
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="text-muted pull-right ml">2h</small>
                                <div class="media-box-heading"><a href="#" class="text-info m0">NEW DOCUMENT</a>
                                </div>
                                <p class="m0">
                                    <small><a href="#">Bootstrap.doc</a>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- END list group item-->
                    <!-- START list group item-->
                    <div class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                 <span class="fa-stack">
                                    <em class="fa fa-circle fa-stack-2x text-danger"></em>
                                    <em class="fa fa-exclamation fa-stack-1x fa-inverse text-white"></em>
                                 </span>
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="text-muted pull-right ml">5h</small>
                                <div class="media-box-heading"><a href="#" class="text-danger m0">BROADCAST</a>
                                </div>
                                <p class="m0"><a href="#">Read</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- END list group item-->
                    <!-- START list group item-->
                    <div class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                 <span class="fa-stack">
                                    <em class="fa fa-circle fa-stack-2x text-success"></em>
                                    <em class="fa fa-clock-o fa-stack-1x fa-inverse text-white"></em>
                                 </span>
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="text-muted pull-right ml">15h</small>
                                <div class="media-box-heading"><a href="#" class="text-success m0">NEW MEETING</a>
                                </div>
                                <p class="m0">
                                    <small>On
                                        <em>10/12/2015 09:00 am</em>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- END list group item-->
                </div>
                <!-- END list group-->
                <!-- START panel footer-->
                <div class="panel-footer clearfix">
                    <a href="#" class="pull-left">
                        <small>Load more</small>
                    </a>
                </div>
                <!-- END panel-footer-->
            </div>
            <!-- END messages and activity-->
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right label label-danger">5</div>
                    <div class="pull-right label label-success">12</div>
                    <div class="panel-title">Team messages</div>
                </div>
                <!-- START list group-->
                <div data-height="230" data-scrollable="" class="list-group">
                    <!-- START list group item-->
                    <a href="#" class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                <img src="img/user/02.jpg" alt="Image" class="media-box-object img-circle thumb32">
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="pull-right">2h</small>
                                <strong class="media-box-heading text-primary">
                                    <span class="circle circle-success circle-lg text-left"></span>Catherine Ellis</strong>
                                <p class="mb-sm">
                                    <small>Cras sit amet nibh libero, in gravida nulla. Nulla...</small>
                                </p>
                            </div>
                        </div>
                    </a>
                    <!-- END list group item-->
                    <!-- START list group item-->
                    <a href="#" class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                <img src="img/user/03.jpg" alt="Image" class="media-box-object img-circle thumb32">
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="pull-right">3h</small>
                                <strong class="media-box-heading text-primary">
                                    <span class="circle circle-success circle-lg text-left"></span>Jessica Silva</strong>
                                <p class="mb-sm">
                                    <small>Cras sit amet nibh libero, in gravida nulla. Nulla facilisi.</small>
                                </p>
                            </div>
                        </div>
                    </a>
                    <!-- END list group item-->
                    <!-- START list group item-->
                    <a href="#" class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                <img src="img/user/09.jpg" alt="Image" class="media-box-object img-circle thumb32">
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="pull-right">4h</small>
                                <strong class="media-box-heading text-primary">
                                    <span class="circle circle-danger circle-lg text-left"></span>Jessie Wells</strong>
                                <p class="mb-sm">
                                    <small>Cras sit amet nibh libero, in gravida nulla. Nulla...</small>
                                </p>
                            </div>
                        </div>
                    </a>
                    <!-- END list group item-->
                    <!-- START list group item-->
                    <a href="#" class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                <img src="img/user/12.jpg" alt="Image" class="media-box-object img-circle thumb32">
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="pull-right">1d</small>
                                <strong class="media-box-heading text-primary">
                                    <span class="circle circle-danger circle-lg text-left"></span>Rosa Burke</strong>
                                <p class="mb-sm">
                                    <small>Cras sit amet nibh libero, in gravida nulla. Nulla...</small>
                                </p>
                            </div>
                        </div>
                    </a>
                    <!-- END list group item-->
                    <!-- START list group item-->
                    <a href="#" class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                <img src="img/user/10.jpg" alt="Image" class="media-box-object img-circle thumb32">
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="pull-right">2d</small>
                                <strong class="media-box-heading text-primary">
                                    <span class="circle circle-danger circle-lg text-left"></span>Michelle Lane</strong>
                                <p class="mb-sm">
                                    <small>Mauris eleifend, libero nec cursus lacinia...</small>
                                </p>
                            </div>
                        </div>
                    </a>
                    <!-- END list group item-->
                </div>
                <!-- END list group-->
                <!-- START panel footer-->
                <div class="panel-footer clearfix">
                    <div class="input-group">
                        <input type="text" placeholder="Search message .." class="form-control input-sm">
                           <span class="input-group-btn">
                              <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i>
                              </button>
                           </span>
                    </div>
                </div>
                <!-- END panel-footer-->
            </div>
        </div>
        <!-- END dashboard sidebar-->
    </div>
    <!-- END Widgets-->
</div>