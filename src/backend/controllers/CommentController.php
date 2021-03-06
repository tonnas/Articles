<?php

namespace backend\controllers;

use Yii;
use common\models\Comment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Article;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex($article_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Comment::find()->where(['article_id' => $article_id]),
        ]);

        $article = Article::findOne($article_id);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'article'=> $article,
        ]);
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Comment();
        $model->parent_id = $id;
        $post = Yii::$app->request->post();
        if ($model->load($post))
        {
            $model->article_id = Comment::findOne($id)->article_id;
            $model->who = 'ADMIN';
            $model->confirmation = 1;
            if($model->save())
                return $this->redirect(['index','article_id' => $model->article_id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreatecomment($article_id)
    {
        $model = new Comment();
        $model->article_id = $article_id;
        $model->confirmation = 1;
        $model->who = 'ADMIN';
        $model->parent_id = NULL;

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->save()) {
            return $this->redirect(['index','article_id' => $model->article_id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Comment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','article_id' => $model->article_id]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Comment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->cascadeDelete($id);
        return $this->redirect(['index']);
    }

    public function cascadeDelete($id)
    {
        $data = $this->findModel($id);
        foreach($data->comment as $item)
        {
            (empty($item->comment)) ? $item->delete() : $this->cascadeDelete($item->id) ;
        }
        $data->delete();
    }

    public function actionConfirm($id)
    {
        $model = $this->findModel($id);
        $model->confirmation = 1;
        $model->update(true, ['confirmation']);

        return $this->redirect(['index','article_id' => $model->article_id]);
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Displays a single Comment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

}
