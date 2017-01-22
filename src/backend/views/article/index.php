<?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;
    use yii\bootstrap\Modal;

    /* @var $this yii\web\View */
    /* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = 'Articles';
    $this->params['breadcrumbs'][] = $this->title;

    Modal::begin([
        'id'=>'modal',
        'size'=>'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();

?>
<div class="article-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?= Html::button('Create Article', ['value'=>Url::to(['create']),'class'=>'btn btn-success grid-button, modalButton']);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => 'max-height:30px;',
            'max-width:10px;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Tittle of article',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->tittle),['comment/index', 'article_id'=> $data->id ]);
                },
            ],
            'cout_comments',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}',
                'buttons'=>[
                    'delete' => function ($url, $model) {
                        return Html::a('<button type="button" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-remove"></span></button>', $url, [
                            'data'=>[
                                'confirm'=>'Are you sure you want to delete this item?','method'=>'post'
                            ]
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>

</div>
