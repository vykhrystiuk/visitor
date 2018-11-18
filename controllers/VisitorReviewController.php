<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Review;

class VisitorReviewController extends Controller
{
    public function actionIndex()
    {
        $reviews = Review::getReviewsByCurrentUser();

        return $this->render('index', ['reviews' => $reviews]);
    }
}
