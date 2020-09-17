<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('config', 'ConfigController')->names('配置管理');
    $router->resource('search_config', 'SearchConfigController')->names('找一找');
    $router->resource('spell_config', 'SpellConfigController')->names('拼拼乐');
    $router->resource('cat', 'CatController')->names('分类管理');
    $router->resource('subject', 'SubjectController')->names('题目管理');

});
