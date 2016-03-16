var webpack = require('webpack');

module.exports = {
    entry: './public/custom/angular/app.js',
    output: {
        filename: 'public/custom/angular/main.js',
    },
    devtool: 'source-map',
};