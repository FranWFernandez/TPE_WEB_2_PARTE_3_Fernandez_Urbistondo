<?php 

require_once 'libs/router.php';
require_once 'app/controllers/product.api.controller.php';
require_once 'app/controllers/categories.api.controller.php';
require_once 'app/controllers/user.api.controller.php';
require_once 'app/middlewares/jwt.auth.middleware.php';
    $router = new Router();

    $router->addMiddleware(new JWTAuthMiddleware());

    #                  ENDPOINT                               VERBO                     CONTROLLER                    METODO
    $router->addRoute('productos'                    ,        'GET'         ,        'ProductApiController'     ,    'getAll');
    $router->addRoute('productos'                    ,        'POST'        ,        'ProductApiController'     ,    'create');
    $router->addRoute('productos/:id'                ,        'GET'         ,        'ProductApiController'     ,    'getProductById');
    $router->addRoute('productos/:id'                ,        'PUT'         ,        'ProductApiController'     ,    'update');
    $router->addRoute('productos/:id/:subrecurso'    ,        'GET'         ,        'ProductApiController'     ,    'getProductosById');
    $router->addRoute('productos/:id'                ,        'DELETE'      ,        'ProductApiController'     ,    'delete');


    $router->addRoute('categorias'                   ,        'GET'         ,        'CategoryApiController'    ,    'getAllCategories');
    $router->addRoute('categorias'                   ,        'POST'        ,        'CategoryApiController'    ,    'create');
    $router->addRoute('categorias/:id'               ,        'GET'         ,        'CategoryApiController'    ,    'getCategoryById');
    $router->addRoute('categorias/:id'               ,        'PUT'         ,        'CategoryApiController'    ,    'update');
    $router->addRoute('categorias/:id/:subrecurso'   ,        'GET'         ,        'CategoryApiController'    ,    'getCategoryById'  );
    $router->addRoute('categorias/:id'               ,        'DELETE'      ,        'CategoryApiController'    ,    'delete');


    $router->addRoute('usuarios/token'               ,         'GET'        ,        'UserApiController'        ,     'getToken');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);