var App;
(function (App) {
    var Spinner = (function () {
        function Spinner(subiect) {
            this.spinner = $(subiect);
        }
        Spinner.prototype.show = function () {
            this.spinner.show();
        };
        Spinner.prototype.hide = function (time, callback) {
            var _that = this;
            if (time) {
                setTimeout(function () {
                    _that.spinner.hide();
                    callback();
                }, time);
            }
            else {
                _that.spinner.hide();
            }
        };
        return Spinner;
    })();
    App.Spinner = Spinner;
})(App || (App = {}));
//# sourceMappingURL=Spinner.js.map