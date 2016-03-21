<script type="text/ng-template" id="nodes_renderer.html">
    <div ui-tree-handle class="tree-node tree-node-content">
        <a class="btn btn-success btn-xs" ng-if="file.children && file.children.length > 0" data-nodrag ng-click="toggle(this)"><span
                    class="glyphicon"
                    ng-class="{ 'fa-folder-o': collapsed, 'fa-folder-open-o': !collapsed }"></span>
        </a>
        [[ file.name ]]
        <a class="pull-right btn btn-danger btn-xs" data-nodrag ng-click="fs.removeItem(this)" title="Șterge director"><span class="fa fa-remove"></span></a>
        <a class="pull-right btn btn-primary btn-xs" data-nodrag ng-click="fs.open(this)" style="margin-right: 8px;" title="Adaugă un director fiu"><span class="fa fa-plus"></span></a>
        <a class="pull-right btn btn-primary btn-xs" title="Vezi fișiere" data-nodrag ng-click="fs.goToFolder(file.id)" style="margin-right: 8px;"><span class="fa fa-file"></span></a>
    </div>
    <ol ui-tree-nodes="" ng-model="file.children" ng-class="{hidden: collapsed}">
        <li ng-repeat="file in file.children" ui-tree-node ng-include="'nodes_renderer.html'">
        </li>
    </ol>
</script>
<div class="col-sm-6">
    <div ui-tree id="tree-root">
        <ol ui-tree-nodes ng-model="fs.files">
            <li ng-repeat="file in fs.files track by $index" ui-tree-node ng-include="'nodes_renderer.html'"></li>
        </ol>
    </div>
</div>
@section('css')
@parent
<link rel="stylesheet" href="{!! asset('angel/vendor/whirl/dist/whirl.css') !!}">
<link rel="stylesheet" href="{!! asset('angel/vendor/animate.css/animate.min.css') !!}">
<link rel="stylesheet" href="{!! asset('custom/css/file-structure.css') !!}">
<style>
</style>
@stop