<?php 

require_once 'libs/router.php';
require_once 'app/controllers/product.api.controller.php';
require_once 'app/controllers/user.api.controller.php';
require_once 'app/middlewares/jwt.auth.middleware.php';
    $router = new Router();

    $router->addMiddleware(new JWTAuthMiddleware());

    #                  endpoint          verbo       controller              metodo
    $router->addRoute('productos'     ,  'GET',     'ProductApiController',  'getAll');
    $router->addRoute('productos/:id' ,  'GET',     'ProductApiController',  'get');
    $router->addRoute('productos/:id',   'DELETE',  'ProductApiController',  'delete');
    $router->addRoute('productos',       'POST',    'ProductApiController',  'create');
    $router->addRoute('productos/:id',    'PUT',    'ProductApiController',  'update');

    $router->addRoute('usuarios/token',  'GET',     'UserApiController',     'getToken');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);