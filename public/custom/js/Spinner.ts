module App{
    declare var $;
    export class Spinner{
        spinner: any;
        constructor(subiect: string){
            this.spinner = $(subiect)
        }
        show(){
            this.spinner.show();
        }

        hide(time?:number, callback?:Function){
            const _that = this;
            if(time){
                setTimeout(function(){
                    _that.spinner.hide();
                    callback();
                },time)
            }else{
                _that.spinner.hide();
            }

        }
    }
}