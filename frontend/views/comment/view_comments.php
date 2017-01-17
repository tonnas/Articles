<?php

    use yii\helpers\Html;
    use yii\bootstrap\Modal;
    use yii\helpers\Url;

    /* @var $this yii\web\View */
    /* @var $model common\models\Comment */
    /* @var $form yii\bootstrap\ActiveForm */
    /* @var $this yii\web\View */

    Modal::begin([
        'id'=>'modal',
        'size'=>'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();

    function v_comment($data)
    {
        foreach ($data->comment as $data) {
            if ($data->confirmation == 1)
            {
                echo '<div class="well well-sm">';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $data->date . '<br>';
                if ($data->is_admin == 1) echo '&nbsp;&nbsp;&nbsp;&nbsp<h10 style="color: red">[ADMIN]</h10><br>';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;' .$data->text;
                echo '<br>';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;' . Html::button('replay <span class="glyphicon glyphicon-comment "></span>',
                        ['value'=>Url::to(['create', 'parent' => $data->id]),
                        'class'=>'btn btn-xs btn-primary grid-button modalButton']);
                echo '<br />';
                if (!empty($data->comment)) {
                    echo '<br>';
                    v_comment($data);
                }
                echo '</div>';
            }
        }
    }
    echo Html::button('Comment <span class="glyphicon glyphicon-comment "></span>',
        ['value'=>Url::to(['create']),'class'=>'btn btn-info grid-button, modalButton']);
    foreach($model as $data) {
        if ($data->confirmation == 1) {
            echo '<div class="well well-sm" >';
            echo $data->date . '<br>';
            if ($data->is_admin == 1) echo '<h10 style="color: red">[ADMIN]</h10><br>' ;
            echo $data->text;
            echo '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;' . Html::button('replay <span class="glyphicon glyphicon-comment "></span>',
                    ['value'=>Url::to(['comment/create', 'parent' => $data->id]),
                    'class'=>'btn btn-xs btn-primary grid-button modalButton']);
            if (!empty($data->comment)) {
                echo '<br>';
                v_comment($data);
            }
        }
        echo '</div>';
    }
?>
