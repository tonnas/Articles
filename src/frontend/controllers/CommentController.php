<?php

namespace frontend\controllers;

use Yii;
use common\models\Comment;
use yii\filters\VerbFilter;
use yii\helpers\HtmlPurifier;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends \yii\web\Controller
{
    public function behaviors()
    {
      return [
          'verbs' => [
              'class' => VerbFilter::className(),
              'actions' => [
                  'delete' => ['POST'],
              ],
          ],
      ];
    }

    public function actionIndex()
    {
        $model = Comment::find()
            ->where(['parent_id' => 0])
            ->all();
        return $this->render('index',[
          'model' => $model
        ]);
    }

    public function actionCreate($parent = NULL)
    {
        $model = new Comment();
//        echo Html::encode($model);
        if (!empty($parent)) $model->parent_id = $parent;
        $post = Yii::$app->request->post();
        if ($model->load($post))
        {
            $model->confirmation = 0;
            if($model->save())
            {
                Yii::$app->session->setFlash('success','Your comment is added and waiting for confirmation!');
                return $this->redirect(['index', 'id' => $model->id]);
            }
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionNewform()
    {
        $model = new Comment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('newform', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
       $model = Comment::findOne(['id' => $id]);

       return $this->render('view',[
         'model' => $model
       ]);
    }


}
