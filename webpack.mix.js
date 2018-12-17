const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');


mix.autoload({
   jquery: ['$', 'window.jQuery']
});

mix.autoload({
   quill: ['window.Quill']
});

const webpack = require('webpack');

new webpack.ProvidePlugin({
  'window.Quill': 'quill/dist/quill.js'
});
