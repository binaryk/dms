/// <reference path="../Afirm"/>
/// <reference path="../binaryk/ui/Modal"/>

module App{
    declare var $;
    declare var Spinner;

    export class Handler{
        archive: string;
        email: string;
        modal: App.Ui.Modal;
        constructor(modal : App.Ui.Modal){
            this.email = '.btn-email-action';
            this.archive = '.btn-archive-action';
            this.modal   = modal;
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
            this.emailfunc();
        }

        emailfunc(){
            var _that = this;
            $(_that.email).on('click', function(e){
                e.preventDefault();
                _that.modal.show();
                const url = $(this).data('route');
                _that.modal['sendLink'] = _that.linkSend.bind(_that,url);
            });
        }
        
        linkSend(url){
            const _that = this;
            console.log(url);
            const email = $('#email').val();
            Spinner.show();
            this.modal.hide();
            $.ajax({
                url      : url,
                type     : 'post',
                data     : {email : email},
                success  : function( result )
                {
                    if(result.code === 200){
                        Spinner.hide(2000, () => {
                            var afirm = new App.Afirm();
                            afirm.success("Emailul a fost trimis cu success");
                        });
                    }
                    console.log(result);
                }
            });
        }



    }
}