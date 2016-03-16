'use strict'
console.log('File str');

var FileStructureCtrl = function($scope, FileStructureService,$uibModal){
    const that = this;
    that.addDirectory = () =>{
        that.addDir = ! that.addDir;
    }

    that.get = () => {
        FileStructureService.get().then(data => { that.files = data.files; console.log(data); } );

    }

    that.open = function (current_dir) {
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
            that.storeChildDirectory(current_dir, dirName);
        }, function () {
            console.log('MoDADSAD');
        });
    };

    that.storeDirectory = () => {
    that.form.type = 'director';
    FileStructureService.store(that.form)
        .then(data => {
            if(data.code === 200){
                console.log(data);
                that.addDir = false;
                that.files[data.inserted.id] = data.inserted;
                console.log(that.files);
            }else{
                alert('Erorr');
            }
        });
    }

    that.storeChildDirectory = (parent, dirName) => {
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
            }else{
                alert('Erorr');
            }
        });
    }

    that.draw = () => {

    }

    that.init = () => {
        that.form = {};
        that.addDir = false;
        that.files = [];
        that.animationsEnabled = true;
        that.menuOptions = [
            ['Creeaza subdirector', ($itemScope) => {
                that.open($itemScope.file)
            }],
            null,
            ['Adauga fisiere', $itemScope => {
                $scope.items.splice($itemScope.$index, 1);
            }],
            null,
            ['Sterge', $itemScope => {
                that.files.splice($itemScope.$index, 1);
            }]
        ];
    }

    this.init();
    this.get();
    this.draw();
}

FileStructureCtrl.$inject = ['$scope','FileStructureService','$uibModal'];
controllers.controller('FileStructureCtrl', FileStructureCtrl);

controllers.controller('ModalDirectorCtrl', function ($scope, $uibModalInstance, fss, current_dir) {
    $scope.name = '';
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
