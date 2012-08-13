<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<base href="<?php echo Yii::app()->theme->baseUrl; ?>/" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/1.css" type="text/css" media="screen,projection" />

<!--<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/views/hmenu/menu.css" type="text/css" media="screen,projection" />
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/views/hmenu/jquery.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/views/hmenu/menu.js"></script>-->
</head>
<body>
<div id="container">
  <div id="header">
    <h1><a href="/"><?php echo CHtml::encode(Yii::app()->name); ?></a></h1>
    <h3>Because blue and red are boring.</h3>
  </div>
    <div id="menu">
  <ul id="nav" class="menu">
      
    <?php
    
 /*   $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); */
    
    $menuArray = Yii::app()->menuManager->getMenu('page');
      
    $this->widget('zii.widgets.CMenu',array(
			'items'=>$menuArray,
		));
    
    
    
   // $this->widget('application.widgets.menu.HMenuWidget');
    ?>
  </ul>
    </div>
  <br class="clear" />
  <div id="sidebar">
      <form action="/search/word" method="post" name="search" onsubmit="this.action='/search/word/'+this.word.value; ">
          Поиск:
          <input typ="text" name="word" value=""> <input type="submit" value=" искать " >
      </form>
      <div id="nav">
          
      <?php //$this->widget('application.widgets.menu.VMenuWidget');?>
      </div>
      
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
    <div class="clear"></div>    
<div id="footer">
Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
</div>
    
<?php



list($queryCount, $queryTime) = Yii::app()->db->getStats();
echo "Query count: $queryCount, Total query time: ".sprintf('%0.5f',$queryTime)."s";


?>    
    
</body>
</html>
