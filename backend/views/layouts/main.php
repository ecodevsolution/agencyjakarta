<?php
    use yii\helpers\Html;
    use backend\assets\AppAsset;
    use yii\widgets\Breadcrumbs;
    use yii\web\View;
    
    /* @var $this \yii\web\View */
    /* @var $content string */
     AppAsset::register($this);
    date_default_timezone_set('Asia/Jakarta');
    
    if (Yii::$app->controller->action->id === 'login' || Yii::$app->controller->action->id === 'forgot-password') { 
    /**
     * Do not use this code in your template. Remove it. 
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
        echo $this->render(
            'main-login',
            ['content' => $content]
        );
    } else {
    
       
    	$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@web/backend/layout');
        ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>Agency Jakarta</title>
        <?php $this->head() ?> 
        <?php $root = '@web';
            $this->registerJsFile($root."/plugins/gsap/main-gsap.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/backstretch/backstretch.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            
            $this->registerJsFile($root."/js/pages/login-v2.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/jquery/jquery-migrate-1.2.1.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/jquery-ui/jquery-ui-1.11.2.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            
            $this->registerJsFile($root."/plugins/bootstrap/js/bootstrap.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            
            $this->registerJsFile($root."/plugins/jquery-cookies/jquery.cookies.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            
            $this->registerJsFile($root."/plugins/jquery-block-ui/jquery.blockUI.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/charts-sparkline/sparkline.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/retina/retina.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/select2/select2.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/icheck/icheck.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/js/sidebar_hover.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/js/application.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            
    
            $this->registerJsFile($root."/js/widgets/notes.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/js/quickview.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);

            
            $this->registerJsFile($root."/js/pages/search.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/noty/jquery.noty.packaged.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/bootstrap-editable/js/bootstrap-editable.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
         		
            $this->registerJsFile($root."/plugins/multidatepicker/multidatespicker.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/js/widgets/todo_list.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/metrojs/metrojs.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/charts-chartjs/Chart.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/charts-highstock/js/highstock.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/charts-highstock/js/modules/exporting.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/skycons/skycons.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
          
            $this->registerJsFile($root."/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/moment/moment.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            $this->registerJsFile($root."/plugins/slick/slick.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            

            
            $this->registerJsFile($root."/plugins/timepicker/jquery-ui-timepicker-addon.min.js",
            ['depends' => [\yii\web\JqueryAsset::className()],
            'position' => View::POS_END]);
            
            
            
            
          
            ?>
    </head>
    <body class="sidebar-condensed fixed-topbar fixed-sidebar theme-sdtl color-default dashboard">
        <?php $this->beginBody() ?>
        <div class="main-content">
            <section>
                <?= $this->render(
                    'header.php',
                    ['directoryAsset' => $directoryAsset]
                    ) ?>
                <?= $this->render(
                    'left.php',
                    ['directoryAsset' => $directoryAsset]
                    )
                    ?>
                <div class="page-content page-thin">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    <?= $content ?>
                </div>
                
            </section>
            <div id="quickview-sidebar">
                <div class="quickview-header">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#chat" data-toggle="tab">Chat</a></li>
                        <li><a href="#notes" data-toggle="tab">Notes</a></li>
                        <li><a href="#settings" data-toggle="tab" class="settings-tab">Settings</a></li>
                    </ul>
                </div>
                <div class="quickview">
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="chat">
                            <div class="chat-body current">
                                <div class="chat-search">
                                    <form class="form-inverse" action="#" role="search">
                                        <div class="append-icon">
                                            <input type="text" class="form-control" placeholder="Search contact...">
                                            <i class="icon-magnifier"></i>
                                        </div>
                                    </form>
                                </div>
                                <div class="chat-groups">
                                    <div class="title">GROUP CHATS</div>
                                    <ul>
                                        <li><i class="turquoise"></i> Favorites</li>
                                        <li><i class="turquoise"></i> Office Work</li>
                                        <li><i class="turquoise"></i> Friends</li>
                                    </ul>
                                </div>
                                <div class="chat-list">
                                    <div class="title">FAVORITES</div>
                                    <ul>
                                        <li class="clearfix">
                                            <div class="user-img">
                                                <img src="backend/assets/global/images/avatars/avatar13.png" alt="avatar" />
                                            </div>
                                            <div class="user-details">
                                                <div class="user-name">Bobby Brown</div>
                                                <div class="user-txt">On the road again...</div>
                                            </div>
                                            <div class="user-status">
                                                <i class="online"></i>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="user-img">
                                                <img src="backend/assets/global/images/avatars/avatar5.png" alt="avatar" />
                                                <div class="pull-right badge badge-danger">3</div>
                                            </div>
                                            <div class="user-details">
                                                <div class="user-name">Alexa Johnson</div>
                                                <div class="user-txt">Still at the beach</div>
                                            </div>
                                            <div class="user-status">
                                                <i class="away"></i>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="user-img">
                                                <img src="backend/assets/global/images/avatars/avatar10.png" alt="avatar" />
                                            </div>
                                            <div class="user-details">
                                                <div class="user-name">Bobby Brown</div>
                                                <div class="user-txt">On stage...</div>
                                            </div>
                                            <div class="user-status">
                                                <i class="busy"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="chat-list">
                                    <div class="title">FRIENDS</div>
                                    <ul>
                                        <li class="clearfix">
                                            <div class="user-img">
                                                <img src="backend/assets/global/images/avatars/avatar7.png" alt="avatar" />
                                                <div class="pull-right badge badge-danger">3</div>
                                            </div>
                                            <div class="user-details">
                                                <div class="user-name">James Miller</div>
                                                <div class="user-txt">At work...</div>
                                            </div>
                                            <div class="user-status">
                                                <i class="online"></i>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="user-img">
                                                <img src="backend/assets/global/images/avatars/avatar11.png" alt="avatar" />
                                            </div>
                                            <div class="user-details">
                                                <div class="user-name">Fred Smith</div>
                                                <div class="user-txt">Waiting for tonight</div>
                                            </div>
                                            <div class="user-status">
                                                <i class="offline"></i>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="user-img">
                                                <img src="backend/assets/global/images/avatars/avatar8.png" alt="avatar" />
                                            </div>
                                            <div class="user-details">
                                                <div class="user-name">Ben Addams</div>
                                                <div class="user-txt">On my way to NYC</div>
                                            </div>
                                            <div class="user-status">
                                                <i class="offline"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-conversation">
                                <div class="conversation-header">
                                    <div class="user clearfix">
                                        <div class="chat-back">
                                            <i class="icon-action-undo"></i>
                                        </div>
                                        <div class="user-details">
                                            <div class="user-name">James Miller</div>
                                            <div class="user-txt">On the road again...</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-body">
                                    <ul>
                                        <li class="img">
                                            <div class="chat-detail">
                                                <span class="chat-date">today, 10:38pm</span>
                                                <div class="conversation-img">
                                                    <img src="backend/assets/global/images/avatars/avatar4.png" alt="avatar 4"/>
                                                </div>
                                                <div class="chat-bubble">
                                                    <span>Hi you!</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="img">
                                            <div class="chat-detail">
                                                <span class="chat-date">today, 10:45pm</span>
                                                <div class="conversation-img">
                                                    <img src="backend/assets/global/images/avatars/avatar4.png" alt="avatar 4"/>
                                                </div>
                                                <div class="chat-bubble">
                                                    <span>Are you there?</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="img">
                                            <div class="chat-detail">
                                                <span class="chat-date">today, 10:51pm</span>
                                                <div class="conversation-img">
                                                    <img src="backend/assets/global/images/avatars/avatar4.png" alt="avatar 4"/>
                                                </div>
                                                <div class="chat-bubble">
                                                    <span>Send me a message when you come back.</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="conversation-message">
                                    <input type="text" placeholder="Your message..." class="form-control form-white send-message" />
                                    <div class="item-footer clearfix">
                                        <div class="footer-actions">
                                            <i class="icon-rounded-marker"></i>
                                            <i class="icon-rounded-camera"></i>
                                            <i class="icon-rounded-paperclip-oblique"></i>
                                            <i class="icon-rounded-alarm-clock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="notes">
                            <div class="list-notes current withScroll">
                                <div class="notes ">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="add-note">
                                                <i class="fa fa-plus"></i>ADD A NEW NOTE
                                            </div>
                                        </div>
                                    </div>
                                    <div id="notes-list">
                                        <div class="note-item media current fade in">
                                            <button class="close">Ã—</button>
                                            <div>
                                                <div>
                                                    <p class="note-name">Reset my account password</p>
                                                </div>
                                                <p class="note-desc hidden">Break security reasons.</p>
                                                <p><small>Tuesday 6 May, 3:52 pm</small></p>
                                            </div>
                                        </div>
                                        <div class="note-item media fade in">
                                            <button class="close">Ã—</button>
                                            <div>
                                                <div>
                                                    <p class="note-name">Call John</p>
                                                </div>
                                                <p class="note-desc hidden">He have my laptop!</p>
                                                <p><small>Thursday 8 May, 2:28 pm</small></p>
                                            </div>
                                        </div>
                                        <div class="note-item media fade in">
                                            <button class="close">Ã—</button>
                                            <div>
                                                <div>
                                                    <p class="note-name">Buy a car</p>
                                                </div>
                                                <p class="note-desc hidden">I'm done with the bus</p>
                                                <p><small>Monday 12 May, 3:43 am</small></p>
                                            </div>
                                        </div>
                                        <div class="note-item media fade in">
                                            <button class="close">Ã—</button>
                                            <div>
                                                <div>
                                                    <p class="note-name">Don't forget my notes</p>
                                                </div>
                                                <p class="note-desc hidden">I have to read them...</p>
                                                <p><small>Wednesday 5 May, 6:15 pm</small></p>
                                            </div>
                                        </div>
                                        <div class="note-item media current fade in">
                                            <button class="close">Ã—</button>
                                            <div>
                                                <div>
                                                    <p class="note-name">Reset my account password</p>
                                                </div>
                                                <p class="note-desc hidden">Break security reasons.</p>
                                                <p><small>Tuesday 6 May, 3:52 pm</small></p>
                                            </div>
                                        </div>
                                        <div class="note-item media fade in">
                                            <button class="close">Ã—</button>
                                            <div>
                                                <div>
                                                    <p class="note-name">Call John</p>
                                                </div>
                                                <p class="note-desc hidden">He have my laptop!</p>
                                                <p><small>Thursday 8 May, 2:28 pm</small></p>
                                            </div>
                                        </div>
                                        <div class="note-item media fade in">
                                            <button class="close">Ã—</button>
                                            <div>
                                                <div>
                                                    <p class="note-name">Buy a car</p>
                                                </div>
                                                <p class="note-desc hidden">I'm done with the bus</p>
                                                <p><small>Monday 12 May, 3:43 am</small></p>
                                            </div>
                                        </div>
                                        <div class="note-item media fade in">
                                            <button class="close">Ã—</button>
                                            <div>
                                                <div>
                                                    <p class="note-name">Don't forget my notes</p>
                                                </div>
                                                <p class="note-desc hidden">I have to read them...</p>
                                                <p><small>Wednesday 5 May, 6:15 pm</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="detail-note note-hidden-sm">
                                <div class="note-header clearfix">
                                    <div class="note-back">
                                        <i class="icon-action-undo"></i>
                                    </div>
                                    <div class="note-edit">Edit Note</div>
                                    <div class="note-subtitle">title on first line</div>
                                </div>
                                <div id="note-detail">
                                    <div class="note-write">
                                        <textarea class="form-control" placeholder="Type your note here"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="settings">
                            <div class="settings">
                                <div class="title">ACCOUNT SETTINGS</div>
                                <div class="setting">
                                    <span> Show Personal Statut</span>
                                    <label class="switch pull-right">
                                    <input type="checkbox" class="switch-input" checked>
                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                    <span class="switch-handle"></span>
                                    </label>
                                    <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
                                </div>
                                <div class="setting">
                                    <span> Show my Picture</span>
                                    <label class="switch pull-right">
                                    <input type="checkbox" class="switch-input" checked>
                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                    <span class="switch-handle"></span>
                                    </label>
                                    <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
                                </div>
                                <div class="setting">
                                    <span> Show my Location</span>
                                    <label class="switch pull-right">
                                    <input type="checkbox" class="switch-input">
                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                    <span class="switch-handle"></span>
                                    </label>
                                    <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
                                </div>
                                <div class="title">CHAT</div>
                                <div class="setting">
                                    <span> Show User Image</span>
                                    <label class="switch pull-right">
                                    <input type="checkbox" class="switch-input" checked>
                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                    <span class="switch-handle"></span>
                                    </label>
                                </div>
                                <div class="setting">
                                    <span> Show Fullname</span>
                                    <label class="switch pull-right">
                                    <input type="checkbox" class="switch-input" checked>
                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                    <span class="switch-handle"></span>
                                    </label>
                                </div>
                                <div class="setting">
                                    <span> Show Location</span>
                                    <label class="switch pull-right">
                                    <input type="checkbox" class="switch-input">
                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                    <span class="switch-handle"></span>
                                    </label>
                                </div>
                                <div class="setting">
                                    <span> Show Unread Count</span>
                                    <label class="switch pull-right">
                                    <input type="checkbox" class="switch-input" checked>
                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                    <span class="switch-handle"></span>
                                    </label>
                                </div>
                                <div class="title">STATISTICS</div>
                                <div class="settings-chart">
                                    <div class="clearfix">
                                        <div class="chart-title">Stat 1</div>
                                        <div class="chart-number">82%</div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary setting1" data-transitiongoal="82"></div>
                                    </div>
                                </div>
                                <div class="settings-chart">
                                    <div class="clearfix">
                                        <div class="chart-title">Stat 2</div>
                                        <div class="chart-number">43%</div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary setting2" data-transitiongoal="43"></div>
                                    </div>
                                </div>
                                <div class="m-t-30" style="width:100%">
                                    <canvas id="setting-chart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END QUICKVIEW SIDEBAR -->
            <div id="morphsearch" class="morphsearch">
                <form class="morphsearch-form">
                    <input class="morphsearch-input" type="search" placeholder="Search..."/>
                    <button class="morphsearch-submit" type="submit">Search</button>
                </form>
                <div class="morphsearch-content withScroll">
                    <div class="dummy-column user-column">
                        <h2>Users</h2>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/avatars/avatar1_big.png" alt="Avatar 1"/>
                            <h3>John Smith</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/avatars/avatar2_big.png" alt="Avatar 2"/>
                            <h3>Bod Dylan</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/avatars/avatar3_big.png" alt="Avatar 3"/>
                            <h3>Jenny Finlan</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/avatars/avatar4_big.png" alt="Avatar 4"/>
                            <h3>Harold Fox</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/avatars/avatar5_big.png" alt="Avatar 5"/>
                            <h3>Martin Hendrix</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/avatars/avatar6_big.png" alt="Avatar 6"/>
                            <h3>Paul Ferguson</h3>
                        </a>
                    </div>
                    <div class="dummy-column">
                        <h2>Articles</h2>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/gallery/1.jpg" alt="1"/>
                            <h3>How to change webdesign?</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/gallery/2.jpg" alt="2"/>
                            <h3>News From the sky</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/gallery/3.jpg" alt="3"/>
                            <h3>Where is the cat?</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/gallery/4.jpg" alt="4"/>
                            <h3>Just another funny story</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/gallery/5.jpg" alt="5"/>
                            <h3>How many water we drink every day?</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/gallery/6.jpg" alt="6"/>
                            <h3>Drag and drop tutorials</h3>
                        </a>
                    </div>
                    <div class="dummy-column">
                        <h2>Recent</h2>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/gallery/7.jpg" alt="7"/>
                            <h3>Design Inspiration</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/gallery/8.jpg" alt="8"/>
                            <h3>Animals drawing</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/gallery/9.jpg" alt="9"/>
                            <h3>Cup of tea please</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/gallery/10.jpg" alt="10"/>
                            <h3>New application arrive</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/gallery/11.jpg" alt="11"/>
                            <h3>Notification prettify</h3>
                        </a>
                        <a class="dummy-media-object" href="#">
                            <img src="backend/assets/global/images/gallery/12.jpg" alt="12"/>
                            <h3>My article is the last recent</h3>
                        </a>
                    </div>
                </div>
                <!-- /morphsearch-content -->
                <span class="morphsearch-close"></span>
            </div>
            <!-- END SEARCH -->
            <!-- BEGIN PRELOADER -->
            <div class="footer">
                <div class="copyright">
                    <p class="pull-left sm-pull-reset">
                        <span>Copyright <span class="copyright">Â©</span> <?= date("Y");?> </span>
                        <span><a href="http://agencyjakarta.co.id">AgencyJakarta</a></span>.
                        <span>All rights reserved. </span>
                    </p>
                    <p class="pull-right sm-pull-reset">
                        <span><a href="?r=site/support" class="m-r-10">Support</a> | <a href="?r=site/terms" class="m-l-10 m-r-10">Terms of use</a> | <a href="?r=site/policy" class="m-l-10">Privacy Policy</a></span>
                    </p>
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
<?php } ?>