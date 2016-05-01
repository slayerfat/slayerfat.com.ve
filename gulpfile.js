var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

var paths = {
    'public': elixir.config.publicPath,
    'fontAwesome': './node_modules/font-awesome/'
};

elixir(function (mix) {
    mix.sass('app.scss')
        .copy(paths.fontAwesome + 'fonts/**', paths.public + '/fonts')
        .copy(paths.fontAwesome + 'fonts/**', paths.public + '/build/fonts')
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
