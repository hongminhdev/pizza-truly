<?php
	session_start();
	if (isset($_SESSION['id'])){
		unset($_SESSION['id']);
		header('location: https://hongminhdev-pizza-app.herokuapp.com/admin/');
	}
	else{
		header('location: https://hongminhdev-pizza-app.herokuapp.com/admin/');
	}
?>
