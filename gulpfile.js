var elixir = require('laravel-elixir');
var gulp   = require('gulp');
var shell = require("gulp-shell");
var watch = require('gulp-watch');

var controllers = [
    'angular/controllers/controllers.js',
    'angular/controllers/MainCtrl.js',
    'angular/controllers/FileStructureCtrl.js',
];

var directives = [
    'angular/directives/directives.js',
    'angular/directives/bnInput/bn-input.js'
];

var services = [
    'angular/services/services.js',
    'angular/services/FileStructureService.js'
];

var config = [
    'angular/_config.js',
];

gulp.task("webpack", function() {
 gulp.src("").pipe(shell("webpack"));
 gulp.src("").pipe(shell("echo \"compilat\""));
 });



elixir(function(mix) {
    mix
        .task('webpack')
        .babel(config.concat(controllers,services,directives), 'public/custom/angular/app.js')
        .version(["public/custom/angular/app.js"])
        .sass([
            'site/grid.scss',
            'dataTables.comptech.scss',
            'galonline.scss',
            'modal.comptech.scss'
        ],'public/custom/css/main.css')
    ;
});

