'use strict'
services.factory('FileStructureService', ['$rootScope','$http', function($rootScope, $http){
    var mixin = {};

    mixin.store = function(data){
        var promise = $http.post($rootScope.config.file_structure_store, {data: data}).then( response => response.data  );
        return promise;
    }

    mixin.remove = function(data){
        var promise = $http.post($rootScope.config.file_structure_remove, {data: data}).then( response => response.data  );
        return promise;
    }

    mixin.sync = function(data){
        var promise = $http.post($rootScope.config.file_structure_sync, {data: data}).then( response => response.data  );
        return promise;
    }

    mixin.get = function(){
        const promise = $http.get($rootScope.config.file_structure_get).then( response => response.data );
        return promise;
    }
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

}])