<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
<title>User Login</title>
<link rel="stylesheet" href="views/style.css">

</head>
<body>


<section ng-app="myApp" ng-controller="mainCtrl">
<form action="../subscribe.php" method="post">

<?php 


if( !empty($_COOKIE['attempt']) && isset(json_decode( $_COOKIE['attempt'])->expiry)) {	
	$time_expiry = json_decode( $_COOKIE['attempt'])->expiry;
	$seconds = $time_expiry - time();
	echo 'Попробуйте еще раз через '. $seconds . ' секунд';
	exit();
}  

if (isset($_COOKIE["attempt"])) : ?> Неверные данные. <br><br><?php endif; ?>
	<input type="text" name="login" placeholder="Your login" /> <br>
	<input type="password" name="password" placeholder="Put your password" />
	<input type="submit" name="submit" value="Enter&#10140;">   
</form> 
</section>



</body>
</html>