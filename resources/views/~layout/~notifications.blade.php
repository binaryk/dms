<!-- START Alert menu-->
<li class="dropdown dropdown-list">
    <a href="#" data-toggle="dropdown">
        <em class="icon-bell"></em>
        <div class="label label-danger">{{ $notifications_count = count($notifications) }}</div>
    </a>
    <!-- START Dropdown menu-->
    <ul class="dropdown-menu animated flipInX">
        <li>
            <!-- START list group-->
            <div class="list-group">
                <!-- list item-->
        @if( ! $notifications_count )
            <a href="#" class="list-group-item">
                <div class="media-box">
                    <div class="pull-left">
                        <em class="fa fa-twitter fa-2x text-info"></em>
                    </div>
                    <div class="media-box-body clearfix">
                        <p class="m0">Nu aveţi notificări noi</p>
                        <p class="m0 text-muted">
                        </p>
                    </div>
                </div>
            </a>
        @else
            <a href="#" class="list-group-item">
                <div class="media-box">
                    <div class="pull-left">
                        <em class="fa fa-twitter fa-2x text-info"></em>
                    </div>
                    <div class="media-box-body clearfix">
                        <p class="m0">New followers</p>
                        <p class="m0 text-muted">
                            <small>1 new follower</small>
                        </p>
                    </div>
                </div>
            </a>
            <!-- list item-->
            <a href="#" class="list-group-item">
                <div class="media-box">
                    <div class="pull-left">
                        <em class="fa fa-envelope fa-2x text-warning"></em>
                    </div>
                    <div class="media-box-body clearfix">
                        <p class="m0">New e-mails</p>
                        <p class="m0 text-muted">
                            <small>You have 10 new emails</small>
                        </p>
                    </div>
                </div>
            </a>
            <!-- list item-->
            <a href="#" class="list-group-item">
                <div class="media-box">
                    <div class="pull-left">
                        <em class="fa fa-tasks fa-2x text-success"></em>
                    </div>
                    <div class="media-box-body clearfix">
                        <p class="m0">Pending Tasks</p>
                        <p class="m0 text-muted">
                            <small>11 pending task</small>
                        </p>
                    </div>
                </div>
            </a>
        @endif
        @if( $notifications_count )
            <a href="#" class="list-group-item">
                <small>Mai multe notificari</small>
                <span class="label label-danger pull-right">{{ $notifications_count }}</span>
            </a>
        @endif
            </div>
            <!-- END list group-->
        </li>
    </ul>
    <!-- END Dropdown menu-->
</li>
<!-- END Alert menu-->