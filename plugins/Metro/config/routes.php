<?php
use Cake\Routing\Router;

Router::plugin('Metro', function ($routes) {
    $routes->fallbacks('DashedRoute');
});
