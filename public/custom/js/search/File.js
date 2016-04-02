/// <reference path="../Afirm"/>
/// <reference path="../binaryk/ui/Modal"/>
var App;
(function (App) {
    var Handler = (function () {
        function Handler(modal) {
            this.email = '.btn-email-action';
            this.archive = '.btn-archive-action';
            this.modal = modal;
            this.init();
        }
        Handler.prototype.init = function () {
            console.log('init');
            var _that = this;
            $(_that.archive).on('click', function () {
                Spinner.show();
                var url = $(this).data('route');
                console.log(url);
                $.ajax({
                    url: url,
                    type: 'post',
                    success: function (result) {
                        if (result.code === 200) {
                            Spinner.hide(2000, function () {
                                var afirm = new App.Afirm();
                                afirm.onConfirm = function () {
                                    window.location.href = result.arch_path;
                                };
                                afirm.question("Foarte bine!", "Arhivarea a avut loc cu succes, doriti sa descarcati arhiva?", 'success');
                            });
                        }
                        console.log(result);
                    }
                });
            });
            this.emailfunc();
        };
        Handler.prototype.emailfunc = function () {
            var _that = this;
            $(_that.email).on('click', function (e) {
                e.preventDefault();
                _that.modal.show();
                var url = $(this).data('route');
                _that.modal['sendLink'] = _that.linkSend.bind(_that, url);
            });
        };
        Handler.prototype.linkSend = function (url) {
            var _that = this;
            console.log(url);
            var email = $('#email').val();
            Spinner.show();
            this.modal.hide();
            $.ajax({
                url: url,
                type: 'post',
                data: { email: email },
                success: function (result) {
                    if (result.code === 200) {
                        Spinner.hide(2000, function () {
                            var afirm = new App.Afirm();
                            afirm.success("Emailul a fost trimis cu success");
                        });
                    }
                    console.log(result);
                }
            });
        };
        return Handler;
    })();
    App.Handler = Handler;
})(App || (App = {}));
//# sourceMappingURL=File.js.map