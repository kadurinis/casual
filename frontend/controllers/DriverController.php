<?php


namespace frontend\controllers;


use common\models\search\DriverSearch;
use common\models\search\FarmSearch;
use common\models\search\FoodSearch;
use common\models\search\OrderModel;
use yii\web\Controller;

class DriverController extends Controller
{
    public function actionIndex() {
        return $this->render('index', [
            'drivers' => (new DriverSearch())->getQuery()->where(['deleted_at' => null])->all(),
            'foods' => (new FoodSearch())->getQuery()->where(['deleted_at' => null])->all(),
            'farms' => (new FarmSearch())->getQuery()->where(['deleted_at' => null])->all(),
        ]);
    }

    public function actionCreateOrder() {
        $params = \Yii::$app->request->bodyParams;
        $model = new OrderModel(array_intersect_key($params, array_flip(['food_id', 'farm_id', 'driver_id'])));
        print_r($model->attributes);
        if ($model->save()) {
            return $this->redirect(['driver/order-begin', 'id' => $model->id]);
        }
        \Yii::$app->session->setFlash('error', current($model->getFirstErrors()));
        return $this->redirect(['driver/index']);
    }

    public function actionOrderBegin() {
        $model = OrderModel::findOne(\Yii::$app->request->get('id'));
        if (!$model) {
            \Yii::$app->session->setFlash('error', 'Не найдена заявка');
        }
        return $this->render('order-begin', ['model' => $model]);
    }

    public function actionOrderFinish() {
        $model = OrderModel::findOne(\Yii::$app->request->get('id'));
        if (!$model) {
            \Yii::$app->session->setFlash('error', 'Не найдена заявка');
            return $this->redirect(['driver/index']);
        }
        if ($model->finish()->save()) {
            return $this->redirect(['driver/view-order', 'id' => $model->id]);
        }
        \Yii::$app->session->setFlash('error', 'Не найдена заявка');
        return $this->redirect(['driver/index']);
    }

    public function actionViewOrder() {
        $model = OrderModel::findOne(\Yii::$app->request->get('id'));
        if (!$model) {
            \Yii::$app->session->setFlash('error', 'Не найдена заявка');
        }
        return $this->render('order-view', ['model' => $model]);
    }

    public function actionMonitor() {
        return $this->render('order-monitor');
    }

    public function actionMonitorOrder() {
        $model = OrderModel::find()->orderBy(['id' => SORT_DESC])->limit(1)->one();
        return $this->renderPartial('order-monitor-partial', ['model' => $model]);
    }
}