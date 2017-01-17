<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin();

    if ($model->confirmation == 1)
    {
        echo $form->field($model, 'text')->textarea(['rows' => 10]);
        echo $form->field($model, 'confirmation')->textInput();
    }
    else
    {
        echo $form->field($model, 'text')->textarea(['rows' => 10]);
    }
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
