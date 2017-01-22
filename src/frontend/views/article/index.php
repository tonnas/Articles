<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

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
        ],
    ]); ?>

</div>
