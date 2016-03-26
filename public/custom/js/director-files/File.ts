/// <reference path="../Afirm"/>
module App{
    declare var $;
    declare var Spinner;
    export class File{
        protected imgBox;
        protected oldBox;
        protected n404Box;
        protected fileExists;
        constructor(public impact){
            this.imgBox = $('#image-upload-box');
            this.oldBox = $('#image-old-box');
            this.n404Box = $('#file_not_found');
            this.fileExists = (this.n404Box.length === 0);

        }

        init(){
            console.log(this.impact);
            this[this.impact]();
        }

        insert(){
            console.log('asdad');
            this.imgBox.removeClass('hidden');
            this.oldBox.addClass('hidden');
            this.initFileUpload();
        }

        update(){
            this.imgBox.addClass('hidden');
            this.oldBox.removeClass('hidden');
            if(! this.fileExists){
                console.log('Not found file');
                this.imgBox.removeClass('hidden');
                this.initFileUpload();
            }


        }

        delete(){

        }

        initFileUpload(){
            var file = $("[name=file]").fileinput({
                'dropZoneEnabled' : true,
                'showCaption'     : false,
                'showUpload'      : false,
                'showRemove'      : false,
                'uploadAsync'     : false,
            });
        }

    }

    export class Handler{
        archive: string;
        constructor(){
            this.archive = '.btn-archive-action';
            this.init();
        }

        init(){
            console.log('init');
            var _that = this;
            $(_that.archive).on('click', function(){
                Spinner.show();

                const url = $(this).data('route');
                console.log(url);

                $.ajax({
                    url      : url,
                    type     : 'post',
                    success  : function( result )
                    {
                        if(result.code === 200){
                            Spinner.hide(2000, function(){
                                var afirm = new App.Afirm();
                                afirm.onConfirm = function(){
                                    window.location.href = result.arch_path;
                                }
                                afirm.question("Foarte bine!","Arhivarea a avut loc cu succes, doriti sa descarcati arhiva?",'success');
                            });
                        }
                        console.log(result);
                    }
                });
            });
        }
    }
}