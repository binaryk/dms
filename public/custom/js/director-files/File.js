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
})(App || (App = {}));
//# sourceMappingURL=File.js.map