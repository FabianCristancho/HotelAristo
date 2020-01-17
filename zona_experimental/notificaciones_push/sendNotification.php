<?php 
	include 'Notification.php';

	$n=new Notification($_POST['id']);
	echo $n->send($_POST['title'],$_POST['content']);
?>