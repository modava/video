<?php

namespace modava\video\controllers;

use modava\video\components\MyUpload;
use yii\db\Exception;
use Yii;
use yii\helpers\Html;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use modava\video\VideoModule;
use modava\video\components\MyVideoController;
use modava\video\models\VideoType;
use modava\video\models\search\VideoTypeSearch;

/**
 * VideoTypeController implements the CRUD actions for VideoType model.
 */
class VideoTypeController extends MyVideoController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all VideoType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideoTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single VideoType model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new VideoType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VideoType();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                if ($model->save()) {
                    $imageName = null;
                    if ($model->image != "") {
                        $pathImage = FRONTEND_HOST_INFO . $model->image;
                        $path = Yii::getAlias('@frontend/web/uploads/video-type/');
                        foreach (Yii::$app->params['video-type'] as $key => $value) {
                            $pathSave = $path . $key;
                            if (!file_exists($pathSave) && !is_dir($pathSave)) {
                                mkdir($pathSave);
                            }
                            $imageName = MyUpload::uploadFromOnline($value['width'], $value['height'], $pathImage, $pathSave . '/', $imageName);
                        }

                    }

                    $model->image = $imageName;
                    $model->updateAttributes(['image']);
                    Yii::$app->session->setFlash('toastr-' . $model->toastr_key . '-view', [
                        'title' => 'Thông báo',
                        'text' => 'Tạo mới thành công',
                        'type' => 'success'
                    ]);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $errors = Html::tag('p', 'Tạo mới thất bại');
                foreach ($model->getErrors() as $error) {
                    $errors .= Html::tag('p', $error[0]);
                }
                Yii::$app->session->setFlash('toastr-' . $model->toastr_key . '-form', [
                    'title' => 'Thông báo',
                    'text' => $errors,
                    'type' => 'warning'
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VideoType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $imgOld = $model->getOldAttribute('image');
            if ($model->validate()) {
                if ($model->save()) {
                    $imageName = null;
                    if ($model->image != "") {
                        if ($model->image != $imgOld) {
                            $pathImage = FRONTEND_HOST_INFO . $model->image;
                            $path = Yii::getAlias('@frontend/web/uploads/video-type/');
                            foreach (Yii::$app->params['video-type'] as $key => $value) {
                                $pathSave = $path . $key;
                                if (!file_exists($pathSave) && !is_dir($pathSave)) {
                                    mkdir($pathSave);
                                }
                                $imageName = MyUpload::uploadFromOnline($value['width'], $value['height'], $pathImage, $pathSave . '/', $imageName);
                            }
                            $model->image = $imageName;
                            $model->updateAttributes(['image']);
                        }
                    }
                    Yii::$app->session->setFlash('toastr-' . $model->toastr_key . '-view', [
                        'title' => 'Thông báo',
                        'text' => 'Cập nhật thành công',
                        'type' => 'success'
                    ]);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $errors = Html::tag('p', 'Cập nhật thất bại');
                foreach ($model->getErrors() as $error) {
                    $errors .= Html::tag('p', $error[0]);
                }
                Yii::$app->session->setFlash('toastr-' . $model->toastr_key . '-form', [
                    'title' => 'Thông báo',
                    'text' => $errors,
                    'type' => 'warning'
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VideoType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        try {
            if ($model->delete()) {
                Yii::$app->session->setFlash('toastr-' . $model->toastr_key . '-index', [
                    'title' => 'Thông báo',
                    'text' => 'Xoá thành công',
                    'type' => 'success'
                ]);
            } else {
                $errors = Html::tag('p', 'Xoá thất bại');
                foreach ($model->getErrors() as $error) {
                    $errors .= Html::tag('p', $error[0]);
                }
                Yii::$app->session->setFlash('toastr-' . $model->toastr_key . '-index', [
                    'title' => 'Thông báo',
                    'text' => $errors,
                    'type' => 'warning'
                ]);
            }
        } catch (Exception $ex) {
            Yii::$app->session->setFlash('toastr-' . $model->toastr_key . '-index', [
                'title' => 'Thông báo',
                'text' => Html::tag('p', 'Xoá thất bại: ' . $ex->getMessage()),
                'type' => 'warning'
            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the VideoType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VideoType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */


    protected function findModel($id)
    {
        if (($model = VideoType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('video', 'The requested page does not exist.'));
    }
}
