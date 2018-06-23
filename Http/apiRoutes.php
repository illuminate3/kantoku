<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'kantoku', 'middleware' => 'api.token'], function (Router $router) {
    $router->post('modules/{module}/publish', [
        'as' => 'api.kantoku.module.publish',
        'uses' => 'ModulesController@publishAssets',
        'middleware' => 'token-can:kantoku.modules.publish',
    ]);
    $router->post('themes/{theme}/publish', [
        'as' => 'api.kantoku.theme.publish',
        'uses' => 'ThemeController@publishAssets',
        'middleware' => 'token-can:kantoku.themes.publish',
    ]);
});
