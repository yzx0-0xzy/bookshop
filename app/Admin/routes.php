<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', UserController::class);
    $router->resource('orders', OrderController::class);
    $router->resource('books', BookController::class);
    $router->resource('shippings', ShippingController::class);
    $router->resource('categorys', CategoryController::class);
    $router->resource('comments', CommentController::class);
    $router->resource('order_items', OrderItemController::class);
    $router->resource('owners', OwnerController::class);
    $router->resource('publishers', PublisherController::class);
    $router->resource('schools', SchoolController::class);
    $router->resource('subcategorys', SubcategoryController::class);
    $router->resource('wants', WantController::class);
});
