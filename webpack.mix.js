let mix = require('laravel-mix');

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.jsx?$/,
                exclude: /(node_modules\/(?!(dom7|swiper)\/).*|bower_components)/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: Config.babel()
                    }
                ]
            }
        ]
    }
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copy(['resources/js/app.js',
		'resources/js/common.js',
	], 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .version();
mix.copy(['resources/js/admin',
	], 'public/adminvue');
   
mix.js('resources/admin/assets/js/app.js', 'public/adminvue/js')
    .sass('resources/admin/assets/sass/app.scss', 'public/adminvue/css')
    .extract([
        'axios',
        'lodash',
        'vue',
        'vue-router',
        'vuex',
        'vue2-datatable-component',
        'vue-awesome-notifications',
        'vue-select',
        'vue-sweetalert2',
        '@casl/ability',
        '@casl/vue',
        'vue-ckeditor2'
    ])
    .version();

mix.autoload({
    'jquery': ['$', 'window.jQuery', 'jQuery'],
    'moment': ['moment','window.moment'],
});
