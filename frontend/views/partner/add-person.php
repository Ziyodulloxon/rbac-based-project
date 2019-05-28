<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $vacantUsers array */
/* @var $this yii\web\View */
/* @var $model common\models\Partner */

$this->title = 'Update Partner: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="partner-update">

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'user_id')->dropDownList($vacantUsers) ?>

                <?= $form->field($model, 'partner_id')->hiddenInput() ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
