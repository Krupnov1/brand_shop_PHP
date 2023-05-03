<?php

namespace app\controllers;

use app\engine\Request;
use app\model\Products;
use app\model\repositories\ProductsRepository;
use app\engine\App;
use app\controllers\Controller;
use app\engine\Db;

class ProductController extends Controller {


    public function actionIndex() {
        echo $this->render('index', [
            'title' => 'Главная'
        ]); 
    }
    
    public function actionCatalog() {
        $page = App::call()->request->getParams()['page'] ?: 0; 
        $catalog = App::call()->productsRepository->getLimitLikes(($page + 1) * App::call()->config['product_per_page']);
        //$catalog = App::call()->productsRepository->getAll();
        echo $this->render('catalog', [ 
           'catalog' => $catalog,
           'page' => ++$page,
           'title' => 'Каталог'
        ]); 
    }

    public function actionCard() {
        $id = App::call()->request->getParams()['id'];
        App::call()->productsRepository->updateLikes($id);
        $good = App::call()->productsRepository->getOne($id);
        echo $this->render('card', [
            'good' => $good,
            'title' => 'Карточка товара',
        ]); 
    }
}