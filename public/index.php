<?php

require_once dirname(__DIR__) . '/src/config.php';

// routes()->get('/', function () {
//     return printf("<pre>%s</pre>", print_r(request()->server(), true));
// });
routes()->get('/', 'Pages@welcome');

routes()->get('/add-column', 'Pages@addColumnShow');
routes()->post('/add-column', 'Pages@addColumn');

routes()->get('/data', 'Pages@data');

routes()->get('/upload', 'Pages@uploadShow');
routes()->post('/upload', 'Pages@upload');

if (routes()->handle(request()) === false) {
    view()->show404();
}

exit();
