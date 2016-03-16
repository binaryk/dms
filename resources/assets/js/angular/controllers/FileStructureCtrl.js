'use strict'
console.log('File str');

var FileStructureCtrl = function($scope, FileStructureService,$uibModal){
    const that = this;
    that.addDirectory = () =>{
        that.addDir = ! that.addDir;
    }

    that.get = () => {
        FileStructureService.get().then(data => that.files = data.files );
    }

    that.test = () => {
        alert('asas')
    }

    that.open = function (size) {
        var modalInstance = $uibModal.open({
            animation: that.animationsEnabled,
            templateUrl: 'myModalContent.html',
            //controller: 'ModalInstanceCtrl',
            size: size,
            resolve: {
                items: function () {
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

    that.storeDirectory = () => {
    that.form.type = 'director';
    FileStructureService.store(that.form)
        .then(data => {
            if(data.code === 200){
                that.addDir = false;
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
            ['Creeaza subdirector', $itemScope => {
                $scope.selected = $itemScope.item.name;
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
