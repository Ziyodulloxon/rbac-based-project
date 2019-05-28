<?php

/* @var $this View */

/* @var $content string */

use yii\web\View;
use yii\helpers\Html;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\leftMenu\LeftMenu;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>

    <div class="wrapper">

        <?= $this->render('partials/header') ?>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <?= $this->render('partials/left-menu') ?>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= $this->title ?>
                </h1>

                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs'])
                        ? $this->params['breadcrumbs']
                        : [],
                ]) ?>

            </section>

            <!-- Main content -->
            <section class="content">

                <?= Alert::widget() ?>

                <?= $content ?>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>


        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>

<?php
$script = "
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
";
$this->registerJs($script, View::POS_END)
?>