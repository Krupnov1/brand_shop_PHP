<?php

use app\engine\Request;
use app\engine\Session;
use app\engine\Db;
use app\model\repositories\AdminRepository;
use app\model\repositories\BasketRepository;
use app\model\repositories\MenuRepository;
use app\model\repositories\OrdersRepository;
use app\model\repositories\ProductsRepository;
use app\model\repositories\ReviewsRepository;
use app\model\repositories\UsersRepository;

//define('ROOT_DIR', dirname(__DIR__));
//define('DS', DIRECTORY_SEPARATOR);
//define('ENGINE_DIR', ROOT_DIR . DS . 'engine');
//define('CONTROLLERS_NAMESPACE', "app\\controllers\\");
//define('TEMPLATE_DIR', dirname(__DIR__) . "/views/"); 
//define('PRODUCT_PER_PAGE', 3);

return [
    'root_dir' => dirname(__DIR__),
    'engine_dir' => dirname(__DIR__) . "/engine/",
    'controllers_namespace' => "app\\controllers\\",
    'template_dir' => dirname(__DIR__) . "/views/",
    'product_per_page' => 3,


    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost:3308',
            'login' => 'root',
            'password' => 'root',
            'database' => 'shop',
            'charset' => 'utf8' 
        ],

        'request' => [
            'class' => Request::class,
        ],

        'adminRepository' => [
            'class' => AdminRepository::class,
        ],

        'basketRepository' => [
            'class' => BasketRepository::class,
        ],

        'menuRepository' => [
            'class' => MenuRepository::class,
        ],

        'ordersRepository' => [
            'class' => OrdersRepository::class,
        ],

        'productsRepository' => [
            'class' => ProductsRepository::class,
        ],

        'reviewsRepository' => [
            'class' => ReviewsRepository::class
        ],

        'usersRepository' => [
            'class' => UsersRepository::class
        ],

        'session' => [
            'class' => Session::class
        ]
    ]

];