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

var _angularUiTree = require("angular-ui-tree");

var _angularUiTree2 = _interopRequireDefault(_angularUiTree);

var _lodash = require("lodash");

var ld = _interopRequireWildcard(_lodash);

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } else { var newObj = {}; if (obj != null) { for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) newObj[key] = obj[key]; } } newObj.default = obj; return newObj; } }

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var dms = _angular2.default.module('dms', ['dms.controllers', 'dms.directives', 'dms.services', 'ui.bootstrap.contextMenu', 'ui.bootstrap', 'ui.tree']).constant('treeConfig', {
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
}).config(function ($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });
}).run(function ($rootScope) {
    $rootScope.config = _config;
});
'use strict';
var controllers = exports.controllers = _angular2.default.module('dms.controllers', []);
'use strict';
function MainCtrl($scope) {}

MainCtrl.$inject = ['$scope'];
controllers.controller('MainCtrl', MainCtrl);
'use strict';
var FileStructureCtrl = function FileStructureCtrl($scope, FileStructureService, $uibModal, $compile, $location, $rootScope) {
    var that = this;
    that.selectedDirScope = null;

    that.addDirectory = function () {
        that.addDir = !that.addDir;
    };

    that.get = function () {
        FileStructureService.get().then(function (data) {
            that.files = $.map(data.files, function (value) {
                return [value];
            });
            console.log(that.files);
        });
    };

    that.open = function (scope) {
        var _current_dir = scope.$modelValue;
        that.selectedDirScope = _current_dir;
        var modalInstance = $uibModal.open({
            animation: that.animationsEnabled,
            templateUrl: 'addDirector.html',
            controller: 'ModalDirectorCtrl',
            resolve: {
                fss: function fss() {
                    return FileStructureService;
                },
                current_dir: function current_dir() {
                    return _current_dir;
                }
            }
        });
        modalInstance.result.then(function (dirName) {
            if (dirName) {
                that.storeChildDirectory(_current_dir, dirName);
            } else {
                console.log('Only close modal!');
            }
        }, function () {
            console.log('Close modal');
        });
    };

    that.goToFolder = function (id) {
        location.href = 'director-files/' + id;
    };

    that.storeDirectory = function () {
        that.form.type = 'director';
        FileStructureService.store(that.form).then(function (data) {
            if (data.code === 200) {
                console.log(data);
                that.addDir = false;
                that.files.push(data.inserted);
                that.form = {};
                console.log(that.files);
            } else {
                alert('Erorr: ' + data.msg);
            }
        });
    };

    that.storeChildDirectory = function (parent, dirName) {
        console.log('parent', parent);

        var form = {
            parent: parent,
            current: {
                name: dirName,
                type: 'director'
            }
        };

        FileStructureService.store(form).then(function (data) {
            if (data.code === 200) {
                console.log(data.inserted);
                if (parent.children) {
                    parent.children.push(data.inserted);
                } else {
                    parent.children = [data.inserted];
                }
            } else {
                alert('Erorr: ' + data.msg);
            }
        });
    };

    that.removeDir = function ($itemScope) {
        if ($itemScope.$parent['file'] === undefined) {
            delete that.files[$itemScope.file.id];
        } else {
            var parentChildrens = $itemScope.$parent.file.children;
            var index = parentChildrens.indexOf($itemScope.file);
            parentChildrens.splice(index, 1);
        }
    };

    that.removeItem = function (scope) {
        var afirm = new App.Afirm();
        afirm.question('Ștergere director', 'Sunteți sigur că doriți să stergeți acest director ? El (poate) include alte directoare și fișiere', 'warning');
        afirm.onConfirm = function () {
            scope.remove();
            FileStructureService.remove(scope.$modelValue.id).then(function (data) {
                if (data.code === 200) {} else {
                    alert('Erorr');
                }
            });
        };
    };

    $scope.toggle = function (scope) {
        scope.toggle();
    };

    $scope.moveLastToTheBeginning = function () {
        var a = $scope.data.pop();
        $scope.data.splice(0, 0, a);
    };

    that.init = function () {
        that.form = {};
        that.addDir = false;
        that.files = [];
        that.animationsEnabled = true;
        that.menuOptions = [['Creeaza subdirector', function ($itemScope, event) {
            that.selectedDirScope = {
                scope: $itemScope,
                event: event
            };
            that.open($itemScope.file);
        }], null, ['Adauga fisiere', function ($itemScope) {
            $scope.items.splice($itemScope.$index, 1);
        }], null, ['Sterge', function ($itemScope, event) {
            console.log('$scope.$modelValue', $itemScope, $itemScope.$modelValue, event);
            //$itemScope.remove();
            //that.removeDir($itemScope);
        }]];
    };

    this.init();
    this.get();
};

FileStructureCtrl.$inject = ['$scope', 'FileStructureService', '$uibModal', '$compile', '$location', '$rootScope'];
controllers.controller('FileStructureCtrl', FileStructureCtrl);

controllers.controller('ModalDirectorCtrl', function ($scope, $uibModalInstance, fss, current_dir) {
    $scope.name = '';
    $scope.current_name = current_dir.name;
    $scope.store = function () {
        $uibModalInstance.close($scope.name);
    };

    $scope.cancel = function () {
        console.log('cancel');
        $uibModalInstance.close(null);
    };
});

controllers.directive('nestedItem', ['$compile', function ($compile) {
    return {
        restrict: 'A',
        link: function link(scope, element) {
            if (scope.file.children) {
                var html = $compile('<ul><li nested-item ng-repeat="file in file.children" context-menu="fs.menuOptions">[[file.name]]</li></ul>')(scope);
                element.append(html);
            }
        }
    };
}]);

'use strict';

var PostsCtrl = function PostsCtrl($scope, PostsService, $compile, $location) {
    var _this = this;

    var _that = this;
    this.posts = [];
    this.data = [];
    this.query = {};

    this.query = $location.search();

    $scope.$watch('$location.search()', function (newV, old) {
        console.log(newV);
    });

    this.init = function () {
        $scope.$watch(function () {
            return $location.search();
        }, function () {
            console.log('change', _that.data);
            _that.query = $location.search();
            _that.filters(_that.data);
        });
    };

    setTimeout(_that.init(), 1000);

    this.filters = function (data) {
        console.log('filter', _that.posts, data);
        if (_this.query.start && _this.query.stop) {
            _that.posts = data.slice(_that.query.start, _that.query.stop);
        } else {
            _this.query.start = null;
            _this.query.stop = null;
            if (_this.query.count) {
                _that.posts = _.take(data, _this.query.count);
            } else {
                _this.query.count = null;
                if (_this.query.find) {
                    _that.posts = [data[_this.query.find]];
                } else {
                    _that.posts = data;
                }
            }
        }

        console.log('after filter', _that.posts);
    };

    this.onGet = function (data) {
        console.log('OnGetData', data);

        _that.posts = data.records.record;
        _that.data = data.records.record;
        _that.filters(_that.data);
        console.log('_that.posts', _that.posts);
    };
    PostsService.get(_that.onGet);
};

PostsCtrl.$inject = ['$scope', 'PostsService', '$compile', '$location'];
controllers.controller('PostsCtrl', PostsCtrl);

'use strict';

var services = _angular2.default.module('dms.services', []);
'use strict';
services.factory('FileStructureService', ['$rootScope', '$http', function ($rootScope, $http) {
    var mixin = {};

    mixin.store = function (data) {
        var promise = $http.post($rootScope.config.file_structure_store, { data: data }).then(function (response) {
            return response.data;
        });
        return promise;
    };

    mixin.remove = function (data) {
        var promise = $http.post($rootScope.config.file_structure_remove, { data: data }).then(function (response) {
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
services.factory('PostsService', ['$rootScope', '$http', function ($rootScope, $http) {
    var mixin = {};

    mixin.get = function (callback) {
        $http.get('custom/data/posts.xml', { transformResponse: function transformResponse(data) {
                // convert the data to JSON and provide
                // it to the success function below
                var x2js = new X2JS();
                var json = x2js.xml_str2json(data);
                return json;
            }
        }).success(function (data, status) {
            // send the converted data back
            // to the callback function
            callback(data);
        });
    };
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
