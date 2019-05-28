<?php

use yii\helpers\Html;

/* @var $vacantUsers array */
/* @var $this yii\web\View */
/* @var $model common\models\Partner */

$this->title = 'Update Partner: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="partner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'vacantUsers' => $vacantUsers
    ]) ?>

</div>
