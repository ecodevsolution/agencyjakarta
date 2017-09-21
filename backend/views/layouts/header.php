<?php
    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use backend\models\UserForm;
    use backend\models\UserImage;
    /* @var $this \yii\web\View */
    /* @var $content string */
    if (Yii::$app->user->isGuest){
    		
    		echo Yii::$app->getResponse()->redirect('?r=site/login');
    	}
    ?>
<!-- BEGIN TOPBAR -->
<div class="topbar">
    <div class="header-left">
        <div class="topnav">
            <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
            <?php if (Yii::$app->user->identity->idrole == "1"){ ?>
            <ul class="nav nav-icons">
                <li><a href="#" class="toggle-sidebar-top"><span class="icon-user-following"></span></a></li>
                <li><a href="mailbox.html"><span class="octicon octicon-mail-read"></span></a></li>
                <li><a href="#"><span class="octicon octicon-flame"></span></a></li>
                <li><a href="builder-page.html"><span class="octicon octicon-rocket"></span></a></li>
            </ul>
            <?php } ?>
        </div>
    </div>
    <div class="header-right">
        <ul class="header-menu nav navbar-nav">
            <!-- BEGIN USER DROPDOWN -->
            <?php if (Yii::$app->user->identity->idrole == "1"){ ?>
            <li class="dropdown" id="language-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-globe"></i>
                <span>Language</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#" data-lang="en"><img src="backend/assets/global/images/flags/usa.png" alt="flag-english"> <span>English</span></a>
                    </li>
                    <li>
                        <a href="#" data-lang="es"><img src="backend/assets/global/images/flags/spanish.png" alt="flag-english"> <span>Español</span></a>
                    </li>
                    <li>
                        <a href="#" data-lang="fr"><img src="backend/assets/global/images/flags/french.png" alt="flag-english"> <span>Français</span></a>
                    </li>
                </ul>
            </li>
            <!-- END USER DROPDOWN -->
            <!-- BEGIN NOTIFICATION DROPDOWN -->
            <li class="dropdown" id="notifications-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-bell"></i>
                <span class="badge badge-danger badge-header">6</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header clearfix">
                        <p class="pull-left">12 Pending Notifications</p>
                    </li>
                    <li>
                        <ul class="dropdown-menu-list withScroll" data-height="220">
                            <li>
                                <a href="#">
                                <i class="fa fa-star p-r-10 f-18 c-orange"></i>
                                Steve have rated your photo
                                <span class="dropdown-time">Just now</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                <i class="fa fa-heart p-r-10 f-18 c-red"></i>
                                John added you to his favs
                                <span class="dropdown-time">15 mins</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                <i class="fa fa-file-text p-r-10 f-18"></i>
                                New document available
                                <span class="dropdown-time">22 mins</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                <i class="fa fa-picture-o p-r-10 f-18 c-blue"></i>
                                New picture added
                                <span class="dropdown-time">40 mins</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                <i class="fa fa-bell p-r-10 f-18 c-orange"></i>
                                Meeting in 1 hour
                                <span class="dropdown-time">1 hour</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                <i class="fa fa-bell p-r-10 f-18"></i>
                                Server 5 overloaded
                                <span class="dropdown-time">2 hours</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                <i class="fa fa-comment p-r-10 f-18 c-gray"></i>
                                Bill comment your post
                                <span class="dropdown-time">3 hours</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                <i class="fa fa-picture-o p-r-10 f-18 c-blue"></i>
                                New picture added
                                <span class="dropdown-time">2 days</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-footer clearfix">
                        <a href="#" class="pull-left">See all notifications</a>
                        <a href="#" class="pull-right">
                        <i class="icon-settings"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- END NOTIFICATION DROPDOWN -->
            <!-- BEGIN MESSAGES DROPDOWN -->
            <li class="dropdown" id="messages-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-paper-plane"></i>
                <span class="badge badge-primary badge-header">
                8
                </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header clearfix">
                        <p class="pull-left">
                            You have 8 Messages
                        </p>
                    </li>
                    <li class="dropdown-body">
                        <ul class="dropdown-menu-list withScroll" data-height="220">
                            <li class="clearfix">
                                <span class="pull-left p-r-5">
                                <img src="backend/assets/global/images/avatars/avatar3.png" alt="avatar 3">
                                </span>
                                <div class="clearfix">
                                    <div>
                                        <strong>Alexa Johnson</strong> 
                                        <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time p-r-5"></span>12 mins ago
                                        </small>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </li>
                            <li class="clearfix">
                                <span class="pull-left p-r-5">
                                <img src="backend/assets/global/images/avatars/avatar4.png" alt="avatar 4">
                                </span>
                                <div class="clearfix">
                                    <div>
                                        <strong>John Smith</strong> 
                                        <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time p-r-5"></span>47 mins ago
                                        </small>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </li>
                            <li class="clearfix">
                                <span class="pull-left p-r-5">
                                <img src="backend/assets/global/images/avatars/avatar5.png" alt="avatar 5">
                                </span>
                                <div class="clearfix">
                                    <div>
                                        <strong>Bobby Brown</strong>  
                                        <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time p-r-5"></span>1 hour ago
                                        </small>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </li>
                            <li class="clearfix">
                                <span class="pull-left p-r-5">
                                <img src="backend/assets/global/images/avatars/avatar6.png" alt="avatar 6">
                                </span>
                                <div class="clearfix">
                                    <div>
                                        <strong>James Miller</strong> 
                                        <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time p-r-5"></span>2 days ago
                                        </small>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-footer clearfix">
                        <a href="mailbox.html" class="pull-left">See all messages</a>
                        <a href="#" class="pull-right">
                        <i class="icon-settings"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- END MESSAGES DROPDOWN -->
            <?php } ?>
            <!-- BEGIN USER DROPDOWN -->
            <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
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
                <img src="images/profile/400x/<?= $usrs->image_upload;?>" style="width:40px;height:40px;" class="img-responsive img-circle" alt="<?= $usrs->title;?>">
                <?php endforeach; ?>
                <?php } ?>
                <span class="username">Hi, <?= Yii::$app->user->identity->username;?></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?= \yii\helpers\Url::to(['spg/change-password','id'=>Yii::$app->user->identity->id]) ?>"><i class="icon-lock"></i><span>Change Password</span></a>
                        <?php
                            if(Yii::$app->user->identity->idrole == 2){
                            ?>
                    <li>
                        <a href="<?= \yii\helpers\Url::to(['spg/profile']) ?>"><i class="icon-user"></i><span>My Profile</span></a>
                    </li>
                    <?php } ?>
                    <li>
                        <?= Html::a(
                            ' Logout',
                            ['/site/logout'],
                            ['data-method' => 'post', 'class' => 'icon-logout']
                            ) ?>
                    </li>
                </ul>
            </li>
            <!-- END USER DROPDOWN -->
            <!-- CHAT BAR ICON -->
            <!--  <li id="quickview-toggle"><a href="#"><i class="icon-bubbles"></i></a></li> -->
        </ul>
    </div>
    <!-- header-right -->
</div>
<!-- END TOPBAR -->