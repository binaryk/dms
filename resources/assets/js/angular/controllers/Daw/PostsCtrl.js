'use strict'

const PostsCtrl = function($scope, PostsService, $compile, $location){
    const _that = this;
    this.posts = [];
    this.query = {};

    this.query = $location.search();
    this.init = () => {
    }

    this.init();


    this.onGet = (data) => {
        _that.posts = data.records.record;
        if(this.query.start && this.query.stop){
            _that.posts = data.records.record.slice(_that.query.start,_that.query.stop)
        }
        if(this.query.count){
            _that.posts = _.take(data.records.record, this.query.count)
        }
        if(this.query.find){
            _that.posts = [ data.records.record[this.query.find] ]
        }
        console.log(_that.posts);
        //_that.posts = data.records.record;
        //console.log(_that.posts);
    }
    PostsService.get(_that.onGet)
}


PostsCtrl.$inject = ['$scope','PostsService','$compile', '$location'];
controllers.controller('PostsCtrl', PostsCtrl);
