<?php

namespace app\controllers;

use app\engine\App;
use app\model\repositories\ReviewsRepository;
use app\model\entities\Reviews;

class ReviewsController extends Controller {

    public function actionAll() {
        echo $this->render('reviews', [
           'reviews' => App::call()->reviewsRepository->getAll(),
           'admin' => App::call()->adminRepository->isAdmin(),
           'title' => 'Отзывы',
           'buttonText' => 'Добавить' 
        ]); 
    }

    public function actionAdd() {
        
        $name = App::call()->request->getParams()['name'];
        $texts = App::call()->request->getParams()['text'];
        

        $reviews = new Reviews($name, $texts);
    
            App::call()->reviewsRepository->save($reviews);
        
        $response = [
            'success' => 'ok',
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function actionEdit() {
    

        $id = App::call()->request->getParams()['id'];
        $name = App::call()->request->getParams()['name'];
        $texts = App::call()->request->getParams()['texts'];

        App::call()->reviewsRepository->reviewsEdit($id, $name, $texts);

        $response = [
            'id' => $id,
            'name' => $name,
            'texts' => $texts
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function actionDelete() {
        
        $id = App::call()->request->getParams()['id'];
        
        $review = App::call()->reviewsRepository->getOneObject($id);
        var_dump($review);
        if ($id == $review->id) {
            App::call()->reviewsRepository->delete($review);
        }

        $response = [
            'success' => 'ok',
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
} 