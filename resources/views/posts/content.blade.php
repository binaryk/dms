<div class="col-lg-9">
    <div class="row">
        <!-- Posts column 1-->
        <div class="col-lg-4" ng-repeat="post in ps.posts  | filter : ps.search track by $index">
            <div class="panel">
                <a href="">
                    <img src="[[post.image]]" class="img-responsive">
                </a>
                 <div class="panel-body">
                    <p class="clearfix">
                     <span class="pull-left">
                        <small class="mr-sm">By <a href="">[[ post.author ]]</a>
                        </small>
                        <small class="mr-sm">[[ post.phone ]]</small>
                     </span>
                     <span class="pull-right">
                        <small>
                            <strong>[[post.comments]]</strong>
                            <span>Comments</span>
                        </small>
                     </span>
                    </p>
                    <h4> <a href="">[[post.title]]</a>
                    </h4>
                    <p>
                        [[ post.content ]]
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="panel panel-default">
        <div class="panel-heading">Search</div>
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="input-group">
                    <input type="text" placeholder="Search for..." class="form-control" ng-model="ps.search">
                      <span class="input-group-btn">
                         <button type="button" class="btn btn-default">
                             <em class="fa fa-search"></em>
                         </button>
                      </span>
                </div>
            </form>
        </div>
    </div>
</div>