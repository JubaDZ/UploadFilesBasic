<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<?php 
if(isGet('reset_ok'))
	echo '<i class="glyphicon glyphicon-question-sign"></i> ' . $lang[289] ;
if(isGet('reset_failed'))
	echo '<i class="glyphicon glyphicon-question-sign"></i> ' . $lang[290] ;
 ?>	