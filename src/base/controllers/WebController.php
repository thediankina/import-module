<?php

namespace app\src\base\controllers;

use app\src\base\exceptions\UserException;
use Throwable;
use Yii;
use yii\web\Controller;

class WebController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function runAction($id, $params = [])
    {
        try {
            return parent::runAction($id, $params);
        } catch (UserException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (Throwable $e) {
            Yii::$app->session->setFlash('error', 'An internal error has occurred.');
            Yii::error($e->getMessage() . "\n" . $e->getTraceAsString());
        }

        return $this->redirect($this->request->referrer);
    }
}
