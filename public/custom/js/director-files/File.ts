module App{
    declare var $;
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
}