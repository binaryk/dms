console.log('config');
import angular from "angular";
import contextMenu from "angular-bootstrap-contextmenu";
import ui_bootstrap from "angular-ui-bootstrap";

var dms = angular.module('dms', ['dms.controllers','dms.directives','dms.services', 'ui.bootstrap.contextMenu','ui.bootstrap'])
    .config(function($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    })
    .run(function($rootScope){
        $rootScope.config = _config;
    })