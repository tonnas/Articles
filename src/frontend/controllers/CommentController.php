<?php

namespace frontend\controllers;

use common\models\Article;
use Yii;
use common\models\Comment;
use yii\filters\VerbFilter;
use yii\helpers\Html;

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

    public function actionIndex($article_id)
    {
        $model = Comment::find()
            ->where(['article_id' => $article_id])
            ->all();

        $article = Article::findOne($article_id);

        return $this->render('index',[
          'model' => $model,
            'article' => $article,
        ]);
    }

    public function actionCreate($article_id, $parent = NULL)
    {
        $model = new Comment();

        if (!empty($parent))
        {
            $model->parent_id = $parent;
        }
        $post = Yii::$app->request->post();

        if ($model->load($post))
        {
            if (Yii::$app->user->isGuest)
            {
                $model->who = 'GUEST';
            }
            else
            {
                $model->who = Yii::$app->user->identity->username;
            }
            $model->article_id = $article_id;
            $model->confirmation = 0;
            echo Html::encode($model->text);
            if($model->save())
            {
                Yii::$app->session->setFlash('success','Your comment is added and waiting for confirmation!');
                return $this->redirect(['index', 'article_id' => $model->article_id]);
            }
        }
        else
        {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionView($id)
    {
       $model = Comment::findOne(['id' => $id]);
       return $this->render('view',[
         'model' => $model
       ]);
    }


}
