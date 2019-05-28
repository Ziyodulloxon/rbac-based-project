<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);

$user = Yii::$app->user;
$canUpdateUser = $user->can('updateUser');
$canDeleteUser = $user->can('deleteUser');
?>
<div class="user-view">

    <?php if ($canDeleteUser && $canUpdateUser): ?>
        <p>
            <?= Html::a(
                'Update',
                ['update', 'id' => $model->id],
                ['class' => 'btn btn-primary']
            ) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            'statusName',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
