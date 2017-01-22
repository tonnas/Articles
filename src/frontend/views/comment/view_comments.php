<?php

    use yii\helpers\Html;
    use yii\bootstrap\Modal;
    use yii\helpers\Url;

    /* @var $this yii\web\View */
    /* @var $form yii\bootstrap\ActiveForm */
    /* @var $this yii\web\View */

    Modal::begin([
        'id'=>'modal',
        'size'=>'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();

    function who_comment($color, $data)
    {
        echo '&nbsp;&nbsp;&nbsp;&nbsp;' . '<h10 style="color: '. $color. '">' . $data . '</h10><br>';
    }

    function who_show($data)
    {
        if ($data == 'ADMIN')
        {
            who_comment('red', $data);
        }
        else if ($data == 'GUEST')
        {
            who_comment('green', $data);
        }
        else
        {
            who_comment('blue', $data);
        }
    }

    function view_comment($data)
    {
        foreach ($data->comment as $data)
        {
            if ($data->confirmation == 1)
            {
                echo '<div class="well well-sm">';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $data->date . '<br>';
                who_show($data->who);
                echo '&nbsp;&nbsp;&nbsp;&nbsp;' .Html::encode($data->text);
                echo '<br>';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;' . Html::button('replay <span class="glyphicon glyphicon-comment "></span>',
                        [
                            'value'=>Url::to(['create', 'article_id' => $data->article_id ,'parent' => $data->id]),
                            'class'=>'btn btn-xs btn-primary grid-button modalButton'
                        ]);
                echo '<br />';
                if (!empty($data->comment)) {
                    echo '<br>';
                    view_comment($data);
                }
                echo '</div>';
            }
        }
    }

    echo '<h3><b>' . $article->tittle . '</b></h3><br>' . $article->text . '<br>';

    echo Html::button('Comment <span class="glyphicon glyphicon-comment "></span>',
        ['value'=>Url::to(['create', 'article_id' => $article->id]),'class'=>'btn btn-info grid-button, modalButton']);

    foreach($model as $data)
    {
        if ($data->confirmation == 1 && $data->parent_id == 0)
        {
            echo '<div class="well well-sm" >';
            echo $data->date . '<br>';
            who_show($data->who);
            echo Html::encode($data->text);
            echo '<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;' . Html::button('replay <span class="glyphicon glyphicon-comment "></span>',
                    [
                        'value'=>Url::to(['comment/create', 'article_id' => $data->article_id ,'parent' => $data->id]),
                        'class'=>'btn btn-xs btn-primary grid-button modalButton'
                    ]);
            if (!empty($data->comment))
            {
                echo '<br>';
                view_comment($data);
            }
        }
        echo '</div>';
    }
?>
