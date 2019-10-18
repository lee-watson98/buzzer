<?php require_once("config.php");

if(isset($_GET['id'])){
	$query = query("DELETE FROM following WHERE follower_id=".escape_string($_SESSION['user_id'])." AND followed_id =".escape_string($_GET['id'])." ");
	confirm($query);
	redirect("profile.php?id={$_GET['id']}");
}else {
	redirect("profile.php?id={$_GET['id']}");
}?>
