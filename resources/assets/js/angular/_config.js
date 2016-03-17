import angular from "angular";
import contextMenu from "angular-bootstrap-contextmenu";
import ui_bootstrap from "angular-ui-bootstrap";
import ui_tree from 'angular-ui-tree';

var dms = angular.module('dms', ['dms.controllers','dms.directives','dms.services', 'ui.bootstrap.contextMenu','ui.bootstrap','ui.tree'])
    .constant('treeConfig', {
        treeClass: 'angular-ui-tree',
        emptyTreeClass: 'angular-ui-tree-empty',
        hiddenClass: 'angular-ui-tree-hidden',
        nodesClass: 'angular-ui-tree-nodes',
        nodeClass: 'angular-ui-tree-node',
        handleClass: 'angular-ui-tree-handle',
        placeholderClass: 'angular-ui-tree-placeholder',
        dragClass: 'angular-ui-tree-drag',
        dragThreshold: 3,
        levelThreshold: 30,
        defaultCollapsed: false
    })
    .config(function($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    })
    .run(function($rootScope){
        $rootScope.config = _config;
    })