module App.Ui{
    declare var $;

    export class Modal{
        constructor(public parameters){
            this.listen();
        }

        listen(){
            const _that = this;
            var functions = [];
            $('button[data-modal-action]').map(function(){
                functions.push($(this).data('modal-action'));
                $(this).on('click', function(e){
                    e.preventDefault();
                    let func = $(this).data('modal-action');
                    _that[func]();
                })
            });
        }

        showMessages = ( messages?, type?):void =>
        {
            var html = '';
            for(var i = 0; i < messages.length; i++)
            {
                html += messages[i] + '<br/>';
            }
            $(this.parameters.id + ' .modal-body').append('<div class="alert alert-' + type + '">' + html + '</div>');
        }

        show = (title?, body?, footer?):void =>
        {
            if(typeof title === 'string')
            {
                this.parameters.title = title;
            }
            if(typeof body === 'string')
            {
                this.parameters.body = body;
            }
            if(typeof footer === 'string')
            {
                this.parameters.footer = footer;
            }
            $(this.parameters.id + ' .modal-title').html(this.parameters.title);
            $(this.parameters.id + ' .modal-body').html(this.parameters.body);
            $(this.parameters.id + ' .modal-footer').html(this.parameters.footer);

            $(this.parameters.id).modal('show');
        }

        hide = ():void =>
        {
            $(this.parameters.id).find('input').val('');
            $(this.parameters.id).modal('hide');
        }



    }
}