'use strict'

const PostsCtrl = function($scope, PostsService, $compile, $location){
    const _that = this;
    this.posts = [];
    this.data = [];
    this.query = {};

    this.query = $location.search();

    this.init = () => {
        $scope.$watch(function(){ return $location.search() }, function(){
            console.log('change',_that.data);
            _that.query = $location.search();
            _that.filters(_that.data);
        });
    }

    setTimeout(_that.init(), 1000);

    this.filters = (data) => {
        console.log('filter',_that.posts, data);
        if(this.query.start && this.query.stop){
            _that.posts = data.slice(_that.query.start,_that.query.stop)
        }else{
            this.query.start = null;
            this.query.stop = null;
            if(this.query.count){
                _that.posts = _.take(data, this.query.count)
            }else{
                this.query.count = null;
                if(this.query.find){
                    _that.posts = [ data[this.query.find] ]
                }else{
                    _that.posts = data;
                }
            }
        }

        console.log('after filter',_that.posts);
    }


    this.onGet = (data) => {
        console.log('OnGetData',data);

        _that.posts =data.records.record;
        _that.data = data.records.record;
        _that.filters(_that.data);
        console.log('_that.posts',_that.posts);
    }
    PostsService.get(_that.onGet)
}


PostsCtrl.$inject = ['$scope','PostsService','$compile', '$location'];
controllers.controller('PostsCtrl', PostsCtrl);
