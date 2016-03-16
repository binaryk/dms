'use strict'
console.log('directive');

directives.directive('bnInput', function(){
    return {
        restrict: 'EA',
        templateUrl: 'resources/assets/js/angular/directives/bnInput/input.html',
        scope: true,
        controller: function($scope){
            console.log('inside directive bn-input');
            console.log('scope',$scope);
        }
    }
});
