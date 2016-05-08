var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

var paths = {
    'public': elixir.config.publicPath,
    'fontAwesome': './node_modules/font-awesome/',
    'animateCss': './node_modules/animate.css/animate.min.css',
    'jquery': './node_modules/jquery/dist/jquery.min.js',
    'lazyLoad': './node_modules/jquery-lazyload/jquery.lazyload.js'
};

// .vue components hot reload
if (elixir.config.production != true) {
    elixir.config.js.browserify.plugins.push({
        name: "browserify-hmr",
        options: {}
    });
}

elixir(function (mix) {
    mix.sass('app.scss');
    mix.copy(paths.fontAwesome + 'fonts/**', paths.public + '/fonts');
    mix.copy(paths.fontAwesome + 'fonts/**', paths.public + '/build/fonts');
    mix.copy(paths.animateCss, paths.public + '/css/animate.min.css');
    mix.copy(paths.lazyLoad, paths.public + '/js/jquery.lazyload.js');
    mix.copy(paths.jquery, paths.public + '/js/jquery.js');
    mix.version(['css/app.css']);
    mix.browserify('app.js');
    if (elixir.config.production != true) {
        mix.browserSync({
            proxy: 'slayerfat.app'
        });
    }
});
