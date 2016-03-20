@section('heading')
    @parent
    <div class="btn-group pull-right" ng-hide="fs.addDir">
        <button type="button" class="btn btn-default btn-sm" ng-click="fs.addDirectory()">Creaza director</button>
    </div>
@stop