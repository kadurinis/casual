<?php


namespace frontend\controllers;


use common\models\Driver;
use common\models\Farm;
use common\models\Food;
use common\models\search\DriverSearch;
use common\models\search\FarmSearch;
use common\models\search\FoodSearch;
use common\models\search\OrderHistory;
use yii\filters\AccessControl;
use yii\filters\AjaxFilter;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLists() {
        $food = new FoodSearch();
        $farm = new FarmSearch();
        $driver = new DriverSearch();
        return $this->render('lists', compact('food', 'farm', 'driver'));
    }

    public function actionAddToList() {
        $params = \Yii::$app->request->bodyParams;
        $food = new FoodSearch();
        $farm = new FarmSearch();
        $driver = new DriverSearch();

        if (isset($params['FarmSearch'])) {
            $model = $farm;
        }
        if (isset($params['DriverSearch'])) {
            $model = $driver;
        }
        if (isset($params['FoodSearch'])) {
            $model = $food;
        }
        if (isset($model)) {
            $model->load($params);
            if ($model->save()) {
                \Yii::$app->session->setFlash('success', 'Успешно добавлено');
                return $this->redirect(['admin/lists']);
            }
        }
        return $this->render('lists', compact('food', 'farm', 'driver'));
    }

    public function actionDeleteFromList() {
        $id = \Yii::$app->request->get('id');
        $m = \Yii::$app->request->get('model');
        switch ($m) {
            case Driver::tableName():
                $model = DriverSearch::findOne($id);
                break;
            case Food::tableName():
                $model = FoodSearch::findOne($id);
                break;
            case FarmSearch::tableName():
                $model = FarmSearch::findOne($id);
                break;
        }
        if (isset($model)) {
            if ($model->remove()->save()) {
                \Yii::$app->session->setFlash('success', 'Успешно удалено');
            }else {
                \Yii::$app->session->setFlash('error', current($model->getFirstErrors()));
            }
        }else {
            \Yii::$app->session->setFlash('error', 'Ошибка. Не найдена модель');
        }
        return $this->redirect(['admin/lists']);
    }

    public function actionOrders() {
        $model = new OrderHistory();
        $model->load(\Yii::$app->request->queryParams);
        return $this->render('history', ['model' => $model]);
    }
}