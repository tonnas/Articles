<?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\bootstrap\Modal;
    use yii\helpers\Url;

    /* @var $this yii\web\View */
    /* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = 'Comments';
    $this->params['breadcrumbs'][] = $this->title;

    Modal::begin([
        'id'=>'modal',
        'size'=>'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();

?>

<div class="wrap">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::button('Create Comment', ['value'=>Url::to(['createcomment']),'class'=>'btn btn-success grid-button, modalButton'])?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => 'max-height:30px;',
            'max-width:10px;',
        ],'rowOptions'=>function($model) {
            if($model->confirmation == 1) {
                return ['class'=>'success'];
            }else {
                return ['class'=>'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'text:ntext',
            'date',
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}{update}{confirm}{create}',
                'buttons'=>[
                    'delete' => function ($url, $model) {
                                    return Html::a('<button type="button" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-remove"></span></button>', $url, [
                                    'data'=>['confirm'=>'Are you sure you want to delete this item?','method'=>'post']]);},
                    'update' => function ($url) {
                                    return Html::button ('<span class="glyphicon glyphicon-edit "></span>', ['value'=>$url,
                                        'class'=>'btn btn-info grid-edit glyphicon-edit, modalButton']);
                                },
                    'create' => function ($url, $model) {
                                if ($model->confirmation == 1)
                                {
                                    return Html::button ('<span class="glyphicon glyphicon-comment "></span>', ['value'=>$url,
                                        'class'=>'btn btn-primary grid-edit, modalButton']);
                                }},
                    'confirm' => function ($url, $model) {
                                if ($model->confirmation == 0)
                                {
                                    return Html::a('<button type="button" class="btn btn-success">
                                        <span class="glyphicon glyphicon-ok"></span></button>', $url);
                                }}
                ]
            ],
        ],
    ]);  ?>
</div>
