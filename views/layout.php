<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Lemontrac - Bug tracker</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
        <link rel="icon" type="image/ico" href="favicon.ico">
</head>
<body>
  <div id="header">
      
    <h1><img src="images/logo.png" alt="Lemontrac bug tracking system" align="top" width="32" height="32"> Lemontrac </h1>
    
    <?php if(user()):
        $user = user(); ?>
    
    <ul id="nav">
        <li><a href="<?php echo url_for('/');?>">Projects</a></li>
        <li><a href="<?php echo url_for('/all');?>">All Bugs</a></li>
        <li><a href="<?php echo url_for('/user/settings'); ?>">Settings</a></li>
        <li><a href="<?php echo url_for('/logout');?>">Logout</a></li>
    </ul>
    <?php endif ?>
  </div>

  <div id="content">
      
    <?php echo error_notices_render();?>
      <div id="action-buttons">
        <a href="<?php echo url_for('/bug/new'); ?>" class="button blue">Create A Bug</a>
        <?php if($user['access_level'] == 0) : ?>
        <a href="<?php echo url_for('/project/new'); ?>" class="button blue">Create A Project</a>
        <?php endif; ?>
      </div>
    
    <div id="main">
      <?php  echo ext_notice_render();  echo $content;?>
    </div>
  </div>

</body>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="./js/init.js"></script>
</html>
