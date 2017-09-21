<?php
    use yii\bootstrap\Nav;
    use yii\helpers\Html;
    use backend\models\UserForm;
    use backend\models\UserImage;
    ?>
<!-- BEGIN SIDEBAR -->
<div class="sidebar">
    <div class="logopanel">
        <h1>
            <a href="<?= Yii::$app->homeUrl; ?>"></a>
        </h1>
    </div>
    <div class="sidebar-inner">
        <div class="sidebar-top big-img">
            <div class="user-image">
                <?php
                    $count = UserImage::find()->where(['iduser'=>Yii::$app->user->identity->id])->count();
                    if($count == 0){ ?>
                <img src="backend/assets/global/images/avatars/avatar3_big.png" class="img-responsive img-circle" alt="Default">			
                <?php }else{?>
                <?php 									
                    $usr = UserImage::find()
                    		->joinWith('userForm')
                    		->orderBy(['iduserimage' => SORT_ASC])
                    		->where(['iduser'=>Yii::$app->user->identity->id])
                    		->Limit(1)
                    		->all();
                    ?>
                <?php foreach ($usr as $usrs): ?>
                <img src="images/profile/400x/<?= $usrs->image_upload;?>" class="img-responsive img-circle" style="width:200px;height:125px;" alt="<?= $usrs->title;?>">
                <?php endforeach; ?>
                <?php } ?>
            </div>
            <h4><?= Yii::$app->user->identity->username?></h4>
        </div>
        <div class="menu-title">
            Navigation 
            <div class="pull-right menu-settings">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300"> 
                <i class="icon-settings"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" id="reorder-menu" class="reorder-menu">Reorder menu</a></li>
                    <li><a href="#" id="remove-menu" class="remove-menu">Remove elements</a></li>
                    <li><a href="#" id="hide-top-sidebar" class="hide-top-sidebar">Hide / show user image</a></li>
                </ul>
            </div>
        </div>
        <ul class="nav nav-sidebar">
            <li class=" nav-active active"><a href="<?= Yii::$app->homeUrl; ?>"><i class="icon-home"></i><span>Dashboard</span></a></li>
            <?php if(Yii::$app->user->identity->idrole == "1"){ ?>
            <li class="nav-parent">
                <a href="#"><i class="icon-user"></i><span>Recruitment</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['spg/index']) ?>"> Sales Promotion Girls</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['spg/report']) ?>"> Report</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-envelope"></i><span>Mail Timeline</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['mail/index']) ?>">Send Mail</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-users"></i><span>Client</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['client/index']) ?>">Client</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-file-text-o"></i><span>Recomendation</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['recomendation/index']) ?>">Recomendation</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-building"></i><span>City</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['city/index']) ?>"> Create City</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-university"></i><span>Bank</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['bank/index']) ?>"> Create Bank</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-flag"></i><span>Uniform</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['seragam/index']) ?>"> Create Uniform</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-file-o"></i><span>Contract</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['kontrak/index']) ?>">Contract Order</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-usd"></i><span>Payment</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['payment/index']) ?>">View Payment</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['payment/report']) ?>">Report Payment</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-bell-o"></i><span>Event Timeline </span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['timeline/index']) ?>"> Create Event</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['timeline/report']) ?>"> Report Event</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-calendar"></i><span>Schedule</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['jadwal/index']) ?>"> Create Schedule</a></li>                    
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-credit-card"></i><span>Payroll</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['payroll/index']) ?>"> Add Payroll</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['payroll/report']) ?>l"> Report Payroll</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="icon-note"></i><span>Absent</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['absent/index']) ?>"> View Absent</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-user-plus"></i><span>Register Account</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['user-form/index']) ?>"> Create User</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-info"></i><span>Helps</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['support/index']) ?>"> Support </a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['terms/index']) ?>"> Terms of use </a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['privacy/index']) ?>"> Privacy Policy</a></li>
                </ul>
            </li>
            <?php } else if(Yii::$app->user->identity->idrole == "2") {?>
            <!-- SPG MENU -->
            <li class="nav-parent">
                <a href="#"><i class="fa fa-child"></i><span>Profile</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li> <?= Html::a('Personal Info', ['//spg/update', 'id' =>  Yii::$app->user->identity->id]); ?></li>
                    <li> <?= Html::a('Photo', ['//spg/update-photo', 'id' =>  Yii::$app->user->identity->id]); ?></li>
                    <li> <?= Html::a('Experience', ['//spg/update-experience', 'id' =>  Yii::$app->user->identity->id]); ?></li>
                    <li> <?= Html::a('Document', ['//spg/update-document', 'id' =>  Yii::$app->user->identity->id]); ?></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-calendar"></i><span>Schedule</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['spg/jadwal']) ?>"> My Schedule </a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-file-text-o"></i><span>Absent</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['spg/absent']) ?>"> My Absent</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-money"></i><span>Salary</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['spg/salary']) ?>"> My Salary</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-check-circle-o"></i><span>Status Apply</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['spg/apply']) ?>"> My Status</a></li>
                </ul>
            </li>
            <?php } else if(Yii::$app->user->identity->idrole == "3") {?>
            <!-- CLIENT MENU -->
            <li class="nav-parent">
                <a href="#"><i class="fa fa-child"></i><span>Profile</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li> <?= Html::a('Personal Info', ['//client/update', 'id' =>  Yii::$app->user->identity->id]); ?></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-book"></i><span>Contract</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['kontrakclient/index']) ?>"> My Contract </a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-check-circle-o"></i><span>Recommended</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['recomendation-client/index']) ?>"> Sales Promotion Girls</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-file-text-o"></i><span>Absent</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['absent/index']) ?>"> Confirmation Absent</a></li>
                </ul>
            </li>
            <li class="nav-parent">
                <a href="#"><i class="fa fa-money"></i><span>Payment</span><span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li><a href="<?= \yii\helpers\Url::to(['payment/invoice']) ?>"> My Invoice</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['payment/index-client']) ?>"> Confirmation Payment</a></li>
                </ul>
            </li>
            <?php } ?>
        </ul>
        <!-- SIDEBAR WIDGET FOLDERS -->
        <div class="sidebar-footer clearfix">
            <a class="pull-left footer-settings" href="#" data-rel="tooltip" data-placement="top" data-original-title="Settings">
            <i class="icon-settings"></i></a>
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">
            <i class="icon-size-fullscreen"></i></a>
            <div class="pull-left btn-effect">
                <?= Html::a('',
                    ['/site/logout'],
                    ['data-method' => 'post', 'class' => 'icon-power']
                    ) ?>
            </div>
        </div>
    </div>
</div>
<!-- END SIDEBAR -->