<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<base href="<?php echo Yii::app()->theme->baseUrl; ?>/" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/1.css" type="text/css" media="screen,projection" />
</head>
<body>
<div id="container">
  <div id="header">
    <h1><a href="/"><?php echo CHtml::encode(Yii::app()->name); ?></a></h1>
    <h3>Because blue and red are boring.</h3>
  </div>
  <ul id="nav">
    <?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
  </ul>
  <br class="clear" />
  <div id="sidebar">
    Horisontal menu widget  
    <div class="sidebarfooter"> <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> <a href="http://validator.w3.org/check?uri=referer">XHTML 1.1</a> <a href="http://www.sixshootermedia.com">6sm</a> <a href="http://www.getfirefox.com">Get FF</a> </div>
    <div id="sidebar_bottom"></div>
  </div>
  <?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
 <?php echo $content; ?>
</div>
<div id="footer">
Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
</div>
</body>
</html>
