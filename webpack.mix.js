const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js');
mix.sass('resources/css/app.scss', 'public/css/app.css').version();
mix.sass('resources/css/sb-admin-2.scss', 'public/css/sb-admin-2.css').version();

mix.copyDirectory('resources/assets/img', 'public/assets/img');
mix.copyDirectory('resources/assets/files', 'public/assets/files');

mix.styles([
    'public/css/social-icons.css',
    'public/css/owl.carousel.css',
    'public/css/owl.theme.css',
    'public/css/prism.css',
    'public/css/main.css',
    'public/css/custom.css',
], 'public/css/all.css').version();

mix.styles('resources/css/bootstrap-datetimepicker.css', 'public/css/bootstrap-datetimepicker.css').version();
mix.styles('resources/css/agent.css', 'public/css/agent.css').version();
mix.styles('resources/css/simplechat.css', 'public/css/simplechat.css').version();

mix.js(
    'public/js/scripts.js', 'public/js/scripts.min.js')
    .js('resources/assets/js/profile.js', 'public/assets/js/profile.js')
    .js('resources/assets/js/custom/custom.js', 'public/assets/js/custom/custom.js')
    .js('resources/assets/js/custom/custom-datatable.js', 'public/assets/js/custom/custom-datatable.js')
    .js('resources/assets/js/agents/create_edit.js', 'public/assets/js/agents/create_edit.js')
    .js('resources/assets/js/agents/agents.js', 'public/assets/js/agents/agents.js')
    .js('resources/assets/js/visitors/visitors.js', 'public/assets/js/visitors/visitors.js')
    .js('resources/js/sb-admin-2.js', 'public/assets/js/sb-admin-2.js')
    .js('resources/assets/js/rooms/create_edit.js', 'public/assets/js/rooms/create_edit.js')
    .js('resources/assets/js/rooms/rooms.js', 'public/assets/js/rooms/rooms.js')
    .js('resources/assets/js/chats/chats.js', 'public/assets/js/chats/chats.js')
    .js('resources/assets/js/users/create_edit.js', 'public/assets/js/users/create_edit.js')
    .js('resources/assets/js/users/users.js', 'public/assets/js/users/users.js')
    .js('resources/assets/js/question-answer/question-answer.js', 'public/assets/js/question-answer/question-answer.js')
    .js('resources/assets/js/recordings/recordings.js', 'public/assets/js/recordings/recordings.js')
    .js('resources/assets/js/video-logs/video-logs.js', 'public/assets/js/video-logs/video-logs.js')
    // .js('resources/js/bootstrap-datetimepicker.js', 'public/assets/js/bootstrap-datetimepicker.js')
    .js('resources/assets/js/configs/configs.js', 'public/assets/js/configs/configs.js')
    .version();


mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css',
    'public/assets/css/bootstrap.min.css');

mix.copy('node_modules/datatables.net-dt/css/jquery.dataTables.min.css',
    'public/assets/css/jquery.dataTables.min.css');
mix.copy('node_modules/datatables.net-dt/images', 'public/assets/images');
mix.copy('node_modules/select2/dist/css/select2.min.css',
    'public/assets/css/select2.min.css');
mix.copy('node_modules/sweetalert/dist/sweetalert.css',
    'public/assets/css/sweetalert.css');
mix.copy('node_modules/izitoast/dist/css/iziToast.min.css',
    'public/assets/css/iziToast.min.css');

mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/css',
    'public/assets/css/@fortawesome/fontawesome-free/css');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts',
    'public/assets/css/@fortawesome/fontawesome-free/webfonts');

mix.babel('node_modules/jquery.nicescroll/dist/jquery.nicescroll.js',
    'public/assets/js/jquery.nicescroll.js');
mix.babel('node_modules/jquery/dist/jquery.min.js',
    'public/assets/js/jquery.min.js');
mix.babel('node_modules/popper.js/dist/umd/popper.min.js',
    'public/assets/js/popper.min.js');
mix.babel('node_modules/bootstrap/dist/js/bootstrap.min.js',
    'public/assets/js/bootstrap.min.js');
mix.babel('node_modules/datatables.net/js/jquery.dataTables.min.js',
    'public/assets/js/jquery.dataTables.min.js');
mix.babel('node_modules/select2/dist/js/select2.min.js',
    'public/assets/js/select2.min.js');
mix.babel('node_modules/sweetalert/dist/sweetalert.min.js',
    'public/assets/js/sweetalert.min.js');
mix.babel('node_modules/izitoast/dist/js/iziToast.min.js',
    'public/assets/js/iziToast.min.js');
