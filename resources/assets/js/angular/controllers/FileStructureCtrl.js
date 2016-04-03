'use strict'
var FileStructureCtrl = function($scope, FileStructureService,$uibModal, $compile){
    const that = this;
    that.selectedDirScope = null;
    that.addDirectory = () =>{
        that.addDir = ! that.addDir;
    }

    that.get = () => {
        FileStructureService.get().then(data => {
            that.files =  $.map(data.files, function(value) {
                return [value];
            });
            console.log(that.files);
        });
    }

    that.open = function (scope) {
        var current_dir = scope.$modelValue
        that.selectedDirScope = current_dir;
        var modalInstance = $uibModal.open({
            animation: that.animationsEnabled,
            templateUrl: 'addDirector.html',
            controller: 'ModalDirectorCtrl',
            resolve: {
                fss: () =>  FileStructureService,
                current_dir: () => current_dir
            }
        });
        modalInstance.result.then(function (dirName) {
            if(dirName){
                that.storeChildDirectory(current_dir, dirName);
            }else{
                console.log('Only close modal!');
            }
        }, () => {
            console.log('Close modal');
        });
    };

    that.goToFolder = (id) => {
        location.href = 'director-files/' + id;
    }

    that.storeDirectory = () => {
        that.form.type = 'director';
        FileStructureService.store(that.form)
            .then(data => {
                if(data.code === 200){
                    console.log(data);
                    that.addDir = false;
                    that.files.push(data.inserted);
                    that.form = {};
                    console.log(that.files);
                }else{
                    alert('Erorr: '+data.msg);
                }
            });
    }

    that.storeChildDirectory = (parent, dirName) => {
        console.log('parent', parent);

        const form = {
            parent: parent,
            current: {
                name: dirName,
                type: 'director'
            }
        };

        FileStructureService.store(form).then(data => {
            if(data.code === 200){
                console.log(data.inserted);
                if(parent.children){
                    parent.children.push(data.inserted);
                }else{
                    parent.children = [ data.inserted ];
                }
            }else{
                alert('Erorr: '+data.msg);
            }
        });
    }

    that.removeDir = ($itemScope) => {
        if($itemScope.$parent['file'] === undefined){
            delete that.files[$itemScope.file.id];
        }else{
            const parentChildrens = $itemScope.$parent.file.children;
            const index  = parentChildrens.indexOf($itemScope.file);
            parentChildrens.splice(index, 1);
        }
    }

    that.removeItem = function (scope) {
        var afirm = new App.Afirm();
        afirm.question('Ștergere director', 'Sunteți sigur că doriți să stergeți acest director ? El (poate) include alte directoare și fișiere','warning');
        afirm.onConfirm = function(){
            scope.remove();
            FileStructureService.remove(scope.$modelValue.id).then(data => {
                if(data.code === 200){
                }else{
                    alert('Erorr');
                }
            });
        }
    };

    $scope.toggle = function (scope) {
        scope.toggle();
    };

    $scope.moveLastToTheBeginning = function () {
        var a = $scope.data.pop();
        $scope.data.splice(0, 0, a);
    };



    that.init = () => {
        that.form = {};
        that.addDir = false;
        that.files = [];
        that.animationsEnabled = true;
        that.menuOptions = [
            ['Creeaza subdirector', ($itemScope, event) => {
                that.selectedDirScope = {
                    scope: $itemScope,
                    event: event
                };
                that.open($itemScope.file)
            }],
            null,
            ['Adauga fisiere', $itemScope => {
                $scope.items.splice($itemScope.$index, 1);
            }],
            null,
            ['Sterge', ($itemScope, event) => {
                console.log('$scope.$modelValue',$itemScope, $itemScope.$modelValue, event);
                //$itemScope.remove();
                //that.removeDir($itemScope);

            }]
        ];
    }

    this.init();
    this.get();
}

FileStructureCtrl.$inject = ['$scope','FileStructureService','$uibModal', '$compile'];
controllers.controller('FileStructureCtrl', FileStructureCtrl);

controllers.controller('ModalDirectorCtrl', function ($scope, $uibModalInstance, fss, current_dir) {
    $scope.name = '';
    $scope.current_name = current_dir.name;
    $scope.store = () => {
        $uibModalInstance.close($scope.name);
    }

    $scope.cancel = () => {
        console.log('cancel');
        $uibModalInstance.close(null);
    }
});

controllers.directive('nestedItem', ['$compile', function($compile){
    return {
        restrict: 'A',
        link: function(scope, element){
            if (scope.file.children){
                var html = $compile('<ul><li nested-item ng-repeat="file in file.children" context-menu="fs.menuOptions">[[file.name]]</li></ul>')(scope);
                element.append(html);
            }
        }
    };
}]);
