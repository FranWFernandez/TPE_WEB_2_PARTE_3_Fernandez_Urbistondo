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
    $router->addRoute('productos/:ID'                ,        'GET'         ,        'ProductApiController'     ,    'getProductById');
    $router->addRoute('productos/:ID'                ,        'PUT'         ,        'ProductApiController'     ,    'update');
    $router->addRoute('productos/:ID/:subrecurso'    ,        'GET'         ,        'ProductApiController'     ,    'getProductosById'   );
    $router->addRoute('productos/:ID'                ,        'DELETE'      ,        'ProductApiController'     ,    'delete');


    $router->addRoute('categorias'                   ,        'GET'         ,        'CategoryApiController'    ,    'getAllCategories');
    $router->addRoute('categorias'                   ,        'POST'        ,        'CategoryApiController'    ,    'create');
    $router->addRoute('categorias/:ID'               ,        'GET'         ,        'CategoryApiController'    ,    'getCategoryById');
    $router->addRoute('categorias/:ID'               ,        'PUT'         ,        'CategoryApiController'    ,    'update');
    $router->addRoute('categorias/:ID/:subrecurso'   ,        'GET'         ,        'CategoryApiController'    ,    'getCategoryById'  );
    $router->addRoute('categorias/:ID'               ,        'DELETE'      ,        'CategoryApiController'    ,    'delete');


    $router->addRoute('usuarios/token'               ,         'GET'        ,        'UserApiController'        ,     'getToken');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);