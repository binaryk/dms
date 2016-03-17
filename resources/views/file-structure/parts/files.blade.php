
<script type="text/ng-template" id="nodes_renderer.html">
    <div ui-tree-handle class="tree-node tree-node-content">
        <a class="btn btn-success btn-xs" ng-if="file.children && file.children.length > 0" data-nodrag ng-click="toggle(this)"><span
                    class="glyphicon"
                    ng-class="{
          'fa-folder-o': collapsed,
          'fa-folder-open-o': !collapsed
        }"></span></a>
        [[ file.name ]]
        <a class="pull-right btn btn-danger btn-xs" data-nodrag ng-click="fs.removeItem(this)"><span
                    class="fa fa-remove"></span></a>
        <a class="pull-right btn btn-primary btn-xs" data-nodrag ng-click="fs.open(this)" style="margin-right: 8px;"><span
                    class="fa fa-plus"></span></a>
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
    <style>
        .tree {
            margin-top: 20px;
        }
        .tree ul {
            list-style: none;
            padding-left: 5px;
        }
        .tree ul li {
            padding-left: 16px;
            position: relative;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .tree ul li:before {
            content: '';
            height: 1px;
            width: 10px;
            background-color: #333;
            position: absolute;
            top: 10px;
            left: 0;
            margin: auto;
        }
        .tree ul li:after {
            content: '';
            width: 1px;
            height: 100%;
            background-color: #333;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
        }
        .tree ul li:last-child:after {
            height: 10px;
        }
        .tree ul a {
            cursor: pointer;
        }
        .tree ul a:hover {
            color: #333;
            text-decoration: none;
        }

        .angular-ui-tree-empty{
            display: none;
        }

        .angular-ui-tree-handle {
            background: #f8faff;
            border: 1px solid #dae2ea;
            color: #7c9eb2;
            padding: 3px 10px;
        }

        .angular-ui-tree-handle:hover {
            color: #438eb9;
            background: #f4f6f7;
            border-color: #dce2e8;
        }

        .angular-ui-tree-placeholder {
            background: #f0f9ff;
            border: 2px dashed #bed2db;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        tr.angular-ui-tree-empty {
            height:100px
        }

        .group-title {
            background-color: #687074 !important;
            color: #FFF !important;
        }


        /* --- Tree --- */
        .tree-node {
            border: 1px solid #dae2ea;
            background: #f8faff;
            color: #7c9eb2;
        }

        .nodrop {
            background-color: #f2dede;
        }

        .tree-node-content {
            margin: 1px;
        }
        .tree-handle {
            padding: 10px;
            background: #428bca;
            color: #FFF;
            margin-right: 10px;
        }

        .angular-ui-tree-handle:hover {
        }

        .angular-ui-tree-placeholder {
            background: #f0f9ff;
            border: 2px dashed #bed2db;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

    </style>
    @stop