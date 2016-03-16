"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.directives = exports.controllers = undefined;

var _angular = require("angular");

var _angular2 = _interopRequireDefault(_angular);

var _angularBootstrapContextmenu = require("angular-bootstrap-contextmenu");

var _angularBootstrapContextmenu2 = _interopRequireDefault(_angularBootstrapContextmenu);

var _angularUiBootstrap = require("angular-ui-bootstrap");

var _angularUiBootstrap2 = _interopRequireDefault(_angularUiBootstrap);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

console.log('config');


var dms = _angular2.default.module('dms', ['dms.controllers', 'dms.directives', 'dms.services', 'ui.bootstrap.contextMenu', 'ui.bootstrap']).config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function ($rootScope) {
    $rootScope.config = _config;
});
'use strict';
console.log('controllers');

var controllers = exports.controllers = _angular2.default.module('dms.controllers', []);
'use strict';
console.log('MainCtrl');

function MainCtrl($scope) {
    console.log('MainCtrl inside');
}

MainCtrl.$inject = ['$scope'];
controllers.controller('MainCtrl', MainCtrl);
'use strict';
console.log('File str');

var FileStructureCtrl = function FileStructureCtrl($scope, FileStructureService, $uibModal) {
    var that = this;
    that.addDirectory = function () {
        that.addDir = !that.addDir;
    };

    that.get = function () {
        FileStructureService.get().then(function (data) {
            return that.files = data.files;
        });
    };

    that.test = function () {
        alert('asas');
    };

    that.open = function (size) {
        var modalInstance = $uibModal.open({
            animation: that.animationsEnabled,
            templateUrl: 'myModalContent.html',
            //controller: 'ModalInstanceCtrl',
            size: size,
            resolve: {
                items: function items() {
                    return that.files;
                }
            }
        });
        modalInstance.result.then(function (selectedItem) {
            //$scope.selected = selectedItem;
            console.log('modall');
        }, function () {
            console.log('MoDADSAD');
        });
    };

    that.ok = function () {
        console.log('asdas');

        $uibModalInstance.close('xxx');
    };

    that.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    that.storeDirectory = function () {
        that.form.type = 'director';
        FileStructureService.store(that.form).then(function (data) {
            if (data.code === 200) {
                that.addDir = false;
            } else {
                alert('Erorr');
            }
        });
    };

    that.draw = function () {};

    that.init = function () {
        that.form = {};
        that.addDir = false;
        that.files = [];
        that.animationsEnabled = true;
        that.menuOptions = [['Creeaza subdirector', function ($itemScope) {
            $scope.selected = $itemScope.item.name;
        }], null, ['Adauga fisiere', function ($itemScope) {
            $scope.items.splice($itemScope.$index, 1);
        }], null, ['Sterge', function ($itemScope) {
            that.files.splice($itemScope.$index, 1);
        }]];
    };

    this.init();
    this.get();
    this.draw();
};

FileStructureCtrl.$inject = ['$scope', 'FileStructureService', '$uibModal'];
controllers.controller('FileStructureCtrl', FileStructureCtrl);
controllers.controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, items) {

    $scope.items = items;
    $scope.selected = {
        item: $scope.items[0]
    };

    $scope.ok = function () {
        $uibModalInstance.close($scope.selected.item);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});

'use strict';

var services = _angular2.default.module('dms.services', []);
'use strict';
services.factory('FileStructureService', ['$rootScope', '$http', function ($rootScope, $http) {
    var mixin = {};

    mixin.store = function (data) {
        var rest = {};
        var promise = $http.post($rootScope.config.file_structure_store, { data: data }).then(function (response) {
            return response.data;
        });
        return promise;
    };

    mixin.get = function () {
        var promise = $http.get($rootScope.config.file_structure_get).then(function (response) {
            return response.data;
        });
        return promise;
    };
    /* mixin.find = function(id){
         var todo = {};
         $.post($rootScope.config.todo_find,{todo_id: id}, function(data){
             todo = data;
         });
         return todo;
     }
    
     mixin.put = function(id, data){
         var todo = {};
         console.log($rootScope.config.todo_put);
         $.post($rootScope.config.todo_put,{id: id, data: data}, function(data){
             todo = data;
         });
         return todo;
     }
    
       mixin.delete_ = function(id){
         $.post($rootScope.config.todo_delete,{id: id}, function(data){
             // todo = data;
         });
     }
       mixin.start = function(id){
         $.post($rootScope.config.todo_start,{id: id}, function(data){
             // todo = data;
         });
     }
       mixin.stop = function(id){
         $.post($rootScope.config.todo_stop,{id: id}, function(data){
             // todo = data;
         });
     }
    
     mixin.all = function(){
         var todos = [];
         $.get($rootScope.config.todo_get, function(data){
             todos = data;
         });
         return todos;
     }*/

    return mixin;
}]);
'use strict';

var directives = exports.directives = _angular2.default.module('dms.directives', []);

'use strict';
console.log('directive');

directives.directive('bnInput', function () {
    return {
        restrict: 'EA',
        templateUrl: 'resources/assets/js/angular/directives/bnInput/input.html',
        scope: true,
        controller: function controller($scope) {
            console.log('inside directive bn-input');
            console.log('scope', $scope);
        }
    };
});
//# sourceMappingURL=app.js.map
