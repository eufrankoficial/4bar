const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

const basePath = 'public/assets/';
const core = __dirname + '/resources/assets/core/';
const assets = __dirname + '/resources/assets/';
// Página de login
mix.styles([
        core + 'vendor/bootstrap/css/bootstrap.min.css',
        core + 'vendor/font-awesome/css/font-awesome.min.css',
        core + 'vendor/animate-css/vivify.min.css',
        core + '/vendor/sweetalert/sweetalert.css',
        core + 'css/sweetalert2.min.css',
        core + 'css/site.min.css'
    ],
    basePath + 'core/css/login.min.css'
);

//Login scripts
mix.scripts([
        core + 'bundles/libscripts.bundle.js',
        core + 'bundles/vendorscripts.bundle.js',
        core + 'bundles/mainscripts.bundle.js',
        core + 'vendor/sweetalert/sweetalert.min.js',
    ],
    basePath + 'core/js/login.js'
);


//App
mix.styles([
        core + 'vendor/bootstrap/css/bootstrap.min.css',
        core + 'vendor/font-awesome/css/font-awesome.min.css',
        core + 'vendor/animate-css/vivify.min.css',
        core + 'vendor/jvectormap/jquery-jvectormap-2.0.3.css',
        core + 'vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css',
        core + 'vendor/chartist/css/chartist.min.css',
        core + 'css/sweetalert2.min.css',
        core + 'vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css',
        core + 'vendor/bootstrap-tagsinput/bootstrap-tagsinput.css',
        core + 'vendor/multi-select/css/multi-select.css',
        core + 'vendor/bootstrap-multiselect/bootstrap-multiselect.css',
        core + 'vendor/morrisjs/morris.css',
        core + 'vendor/c3/c3.min.css',
        core + 'vendor/chartist/css/chartist.css',
        core + 'vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css',
        core + 'vendor/toastr/toastr.min.css',
        core + 'vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
        core + 'css/site.min.css',
        assets + 'css/custom.css'
    ],
    basePath + 'core/css/app.min.css'
);

//App
mix.scripts([
        core + 'vendor/jquery/jquery-3.3.1.min.js',
        core + 'bundles/libscripts.bundle.js',
        core + 'bundles/vendorscripts.bundle.js',
        core + 'bundles/mainscripts.bundle.js',
        core + 'vendor/sweetalert/sweetalert.min.js',
        core + 'vendor/jquery-inputmask/jquery.inputmask.bundle.js',
        core + 'vendor/jquery.maskedinput/jquery.maskedinput.min.js',
        core + 'vendor/bootstrap-tagsinput/bootstrap-tagsinput.js',
        core + 'vendor/multi-select/js/jquery.multi-select.js',
        core + 'vendor/bootstrap-multiselect/bootstrap-multiselect.js',
        core + 'bundles/c3.bundle.js',
        core + 'bundles/chartist.bundle.js',
        core + 'bundles/knob.bundle.js',
        core + 'vendor/toastr/toastr.min.js',
        core + 'vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        core + 'js/init.plugins.js',
        core + 'js/index.js',
    ],
    basePath + 'core/js/app.min.js'
);

if (mix.inProduction()) {
    mix.version();
}
