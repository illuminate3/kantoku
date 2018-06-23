<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->bind('module', function ($module) {
    return app(\Nwidart\Modules\Contracts\RepositoryInterface::class)->find($module);
});
$router->bind('theme', function ($theme) {
    return app(\Modules\Kantoku\Manager\ThemeManager::class)->find($theme);
});

$router->group(
    ['prefix' => '/kantoku'],
    function (Router $router) {
        $router->get('modules', [
            'as' => 'admin.kantoku.modules.index',
            'uses' => 'ModulesController@index',
            'middleware' => 'can:kantoku.modules.index',
        ]);
        $router->get('modules/{module}', [
            'as' => 'admin.kantoku.modules.show',
            'uses' => 'ModulesController@show',
            'middleware' => 'can:kantoku.modules.show',
        ]);
        $router->post('modules/update', [
            'as' => 'admin.kantoku.modules.update',
            'uses' => 'ModulesController@update',
            'middleware' => 'can:kantoku.modules.update',
        ]);
        $router->post('modules/disable/{module}', [
            'as' => 'admin.kantoku.modules.disable',
            'uses' => 'ModulesController@disable',
            'middleware' => 'can:kantoku.modules.disable',
        ]);
        $router->post('modules/enable/{module}', [
            'as' => 'admin.kantoku.modules.enable',
            'uses' => 'ModulesController@enable',
            'middleware' => 'can:kantoku.modules.enable',
        ]);

        $router->get('themes', [
            'as' => 'admin.kantoku.themes.index',
            'uses' => 'ThemesController@index',
            'middleware' => 'can:kantoku.themes.index',
        ]);
        $router->get('themes/{theme}', [
            'as' => 'admin.kantoku.themes.show',
            'uses' => 'ThemesController@show',
            'middleware' => 'can:kantoku.themes.show',
        ]);
    }
);
