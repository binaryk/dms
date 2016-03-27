/// <reference path="../Afirm"/>
module App{
    declare var $;
    declare var Spinner;

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