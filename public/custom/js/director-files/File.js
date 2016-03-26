/// <reference path="../Afirm"/>
var App;
(function (App) {
    var File = (function () {
        function File(impact) {
            this.impact = impact;
            this.imgBox = $('#image-upload-box');
            this.oldBox = $('#image-old-box');
            this.n404Box = $('#file_not_found');
            this.fileExists = (this.n404Box.length === 0);
        }
        File.prototype.init = function () {
            console.log(this.impact);
            this[this.impact]();
        };
        File.prototype.insert = function () {
            console.log('asdad');
            this.imgBox.removeClass('hidden');
            this.oldBox.addClass('hidden');
            this.initFileUpload();
        };
        File.prototype.update = function () {
            this.imgBox.addClass('hidden');
            this.oldBox.removeClass('hidden');
            if (!this.fileExists) {
                console.log('Not found file');
                this.imgBox.removeClass('hidden');
                this.initFileUpload();
            }
        };
        File.prototype.delete = function () {
        };
        File.prototype.initFileUpload = function () {
            var file = $("[name=file]").fileinput({
                'dropZoneEnabled': true,
                'showCaption': false,
                'showUpload': false,
                'showRemove': false,
                'uploadAsync': false
            });
        };
        return File;
    })();
    App.File = File;
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