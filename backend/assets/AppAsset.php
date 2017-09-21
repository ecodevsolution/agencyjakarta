<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
		'css/theme.css',
		'css/ui.css',
	//	'css/layout.css',
		'plugins/videojs/video.css',
	//	'css/stepsForm.css',
		//'plugins/fullcalendar/fullcalendar.css',
        'plugins/fullcalendar/fullcalendar.min.css',
		//'plugins/step-form-wizard/css/step-form-wizard.min.css',
		'pretty/css/prettyPhoto.css',
    ];
    public $js = [
		'js/pages/timeline.js',
		'js/layout.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
