<?php

use App\Admin\Controllers\UserController;
use App\Admin\Controllers\CategoriesController;
use App\Admin\Controllers\ProductController;
use App\Admin\Controllers\CartsController;
use App\Admin\Controllers\BillsController;
use App\Admin\Controllers\NotificationsController;
use App\Admin\Controllers\ImageProductsController;

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('categories', CategoriesController::class);
    $router->resource('products', ProductController::class);
    $router->resource('carts', CartsController::class);
    $router->resource('bills', BillsController::class);
    $router->resource('notifications', NotificationsController::class);
    $router->resource('image-products', ImageProductsController::class);


});
