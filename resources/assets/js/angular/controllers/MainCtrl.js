'use strict'
console.log('MainCtrl');

function MainCtrl($scope){
    console.log('MainCtrl inside');
}

MainCtrl.$inject = ['$scope'];
controllers.controller('MainCtrl', MainCtrl);