<?php

use yii\grid\GridView;
use yii\helpers\{Html, Url};
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Partner */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);


$user = Yii::$app->user;
$canAddPerson = $user->can('createPerson');
$canUpdatePartner = $user->can('updatePartner');
$canDeletePartner = $user->can('deletePartner');
?>
<div class="partner-view">

    <?php if ($canDeletePartner && $canUpdatePartner): ?>
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
            'user.username',
            'title',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <h3>Persons</h3>


    <?php if ($canAddPerson): ?>
        <p>
            <?= Html::a('Add person',
                ['add-person', 'id' => $model->id],
                ['class' => 'btn btn-info']
            ) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email',
            'created_at:date',
            'updated_at:date',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action == 'delete') {
                        return Url::to(['delete-person', 'id' => $model->partnerUser]);
                    } elseif ($action == 'view') {
                        return Url::to(['user/view', 'id' => $model->id]);
                    }
                },
                'buttons' => [
                    'view' => function ($url, $model) use ($user) {
                        return $user->can('crudPerson', ['person' => $model->person])
                            ? Html::a(Html::tag('span', '', [
                                'class' => 'glyphicon glyphicon-eye-open'
                            ]), $url, [
                                'title' => 'View',
                                'aria-label' => 'true',
                                'data' => ['pjax' => '0']
                            ]) : '';
                    },
                    'delete' => function ($url, $model) use ($user) {
                        return $user->can('crudPerson', ['person' => $model->person])
                            ? Html::a(Html::tag('span', '', [
                                'class' => 'glyphicon glyphicon-trash'
                            ]), $url, [
                                'title' => 'Delete',
                                'aria-label' => 'Delete',
                                'data' => [
                                    'pjax' => '0',
                                    'method' => 'post',
                                    'confirm' => 'Are you sure you want to delete this item?'
                                ]
                            ]) : '';
                    },
                ]
            ],
        ],
    ]); ?>

</div>
