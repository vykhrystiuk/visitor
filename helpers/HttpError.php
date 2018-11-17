<?php
/* @author Nikolay Vykhrystiuk <nikolay_1992@icloud.com> */

namespace app\helpers;

use yii\base\Object;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;

/**
 * Class HttpError
 * @package app\helpers
 */
class HttpError extends Object
{
    /**
     * Вызывает ошибку входящих данных - Code 400
     *
     * @param string $message
     *
     * @throws BadRequestHttpException
     */
    public static function the400($message = 'Bad Request')
    {
        throw new BadRequestHttpException($message);
    }

    /**
     * Вызывает ошибку отсутствия записи - Code 404
     *
     * @param string $message
     *
     * @throws NotFoundHttpException
     */
    public static function the404($message = 'Not Found')
    {
        throw new NotFoundHttpException($message);
    }

    /**
     * Вызывает ошибку доступа - Code 403
     *
     * @param string $message
     *
     * @throws ForbiddenHttpException
     */
    public static function the403($message = 'Forbidden')
    {
        throw new ForbiddenHttpException($message);
    }

    /**
     * Вызывает ошибку сервера - Code 500
     *
     * @param string $message
     *
     * @throws \Exception
     */
    public static function the500($message = 'Internal Server Error')
    {
        throw new \Exception($message, 500);
    }
}