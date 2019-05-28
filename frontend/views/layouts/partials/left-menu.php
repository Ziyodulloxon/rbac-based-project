<?php
use yii\helpers\Url;
$user = Yii::$app->user;
$partnerId = $user->identity->partner->id ?? $user->identity->person->partner_id ?? null;
$canIndexUser = $user->can('indexUser');
$canIndexPartner = $user->can('indexPartner');
$canViewJob = $user->can('viewOwnJob', [
    'id' => $partnerId
]);
$canViewPartner = $user->can('viewOwnCompany', [
    'id' => $partnerId
]);
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                    <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <?php if ($canIndexPartner && $canIndexUser): ?>
                <li>
                    <a href="<?= Url::to(['/user']) ?>">
                        <i class="fa fa-th"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/partner']) ?>">
                        <i class="fa fa-th"></i>
                        <span>Partners</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($canViewPartner || $canViewJob): ?>
                <li>
                    <a href="<?= Url::to(['/partner/view', 'id' => $partnerId]) ?>">
                        <i class="fa fa-th"></i>
                        <span>My Company</span>
                    </a>
                </li>
            <?php endif; ?>
            <li>
                <a href="<?= Url::to(['/user/view', 'id' => $user->id]) ?>">
                    <i class="fa fa-th"></i>
                    <span>My Profile</span>
                </a>
            </li>
        </ul>
    </section>
</aside>