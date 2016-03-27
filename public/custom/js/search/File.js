/// <reference path="../Afirm"/>
var App;
(function (App) {
    var Handler = (function () {
        function Handler() {
            this.archive = '.btn-archive-action';
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
        };
        return Handler;
    })();
    App.Handler = Handler;
})(App || (App = {}));
//# sourceMappingURL=File.js.map