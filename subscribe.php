<?php
/**
 * Controller for User Login 
 */
 
if( isset( $_POST['logout'] ) ){
	session_destroy();
	header("Location: /");
}

$data = file('users.txt');
 
$users = array();
 
foreach( $data as $item ){
	$item = trim( $item );
	list( $id, $passw ) = explode( '*', $item );
	$users[$id] = $passw;
}

	
if( isset( $_POST['submit'] ) ){
	
	$user = $_POST['login']; 
	$password = trim( $_POST['password'] ) ; 
	
	if( isset( $users[$user] ) && $users[$user] == $password ){
		

		session_start();
		
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $password;
		
		setcookie("auth", 'yes');
		setcookie("attempt", '');		
		setcookie("login", $_POST['login']);
		
		header("Location: views/profile.php");
		
	} else{

		$expiry = time() + 60;
		
		$attempt = $_COOKIE['attempt'] ?? 0;
		$attempt++;
		
		setcookie("auth", 'error', $expiry);
		
		
        if( $attempt>3 && is_null(json_decode( $_COOKIE['attempt'])->n) ){
			$expiry = time() + 600;
			$data = (object) array("n" => $attempt);
			$cookieData = (object) array( "data" => $data, "expiry" => $expiry );
			setcookie( "attempt", json_encode( $cookieData ), $expiry );		
		}else{			
		    setcookie("attempt", $attempt, $expiry);
		}
		
		header("Location: /");
	}	


 }
 
 

?>