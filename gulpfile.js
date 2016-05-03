var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

var paths = {
    'public': elixir.config.publicPath,
    'fontAwesome': './node_modules/font-awesome/',
    'animateCss': './node_modules/animate.css/animate.min.css'
};

elixir(function (mix) {
    mix.sass('app.scss')
        .copy(paths.fontAwesome + 'fonts/**', paths.public + '/fonts')
        .copy(paths.fontAwesome + 'fonts/**', paths.public + '/build/fonts')
        .copy(paths.animateCss, paths.public + '/css/animate.min.css')
        .version([
            'css/app.css'
        ])
        .browserify('app.js')
        .browserSync({
            files: [
                config.appPath + '/**/*.php',
                config.get('public.css.outputFolder') + '/**/*.css',
                config.get('public.js.outputFolder') + '/**/*.js',
                config.get('public.versioning.buildFolder') + '/rev-manifest.json',
                paths.public + '/**/*.vue',
                config.viewPath + '/**/*.php'
            ],
            proxy: 'slayerfat.app'
        });
});
