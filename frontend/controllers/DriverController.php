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
        return $this->render('index-interactive', [
            'drivers' => (new DriverSearch())->getQuery()->where(['deleted_at' => null])->all(),
            'foods' => (new FoodSearch())->getQuery()->where(['deleted_at' => null])->all(),
            'farms' => (new FarmSearch())->getQuery()->where(['deleted_at' => null])->all(),
        ]);
    }

    public function actionCreateOrder() {
        $params = \Yii::$app->request->bodyParams;
        $model = new OrderModel();
        $model->setParams($params);
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

    public function actionMonitorOrderConfirm() {
        $order_id = \Yii::$app->request->get('order_id');
        $model = OrderModel::findOne($order_id);
        if (!$model) {
            \Yii::$app->response->statusCode = 400;
            return 'Не найден';
        }
        if (!$model->isNeedProcess()) {
            \Yii::$app->response->statusCode = 400;
            return 'Уже подтвержден';
        }
        $model->process()->save();
        return 'ok';
    }

    public function actionMonitorOrderIsConfirmed() {
        $order_id = \Yii::$app->request->get('order_id');
        $model = OrderModel::findOne($order_id);
        if (!$model) {
            \Yii::$app->response->statusCode = 400;
            return 'Не найден';
        }
        return $model->isNeedFinish() ? 'true' : 'false';
    }
}