<?php

use yii\helpers\Html;

/* @var $vacantUsers array */
/* @var $this yii\web\View */
/* @var $model common\models\Partner */

$this->title = 'Create Partner';
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'vacantUsers' => $vacantUsers
    ]) ?>

</div>
