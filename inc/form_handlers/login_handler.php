<?php 
//if the login button is pressed
if(isset($_POST['login_button'])){
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); // sanitize email
	
	$_SESSION['log_email'] = $email; // Store email into session variable
	$password = md5($_POST['log_password']); //Get password
	
	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	$check_login_query = mysqli_num_rows($check_database_query);//returns number of matches, should be 1 or 0
	
	if(mysqli_num_rows($check_login_query)>0){
			
			while($row=mysqli_fetch_array($check_database_query)) {
				$_SESSION['user_id']=$row['user_id'];
				
				
				}
	}
	// if details are correct
	if($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query);// acceses results of query then stores it in variable $row
		$username = $row['username'];
		$userId = $row['user_id'];
		
		
		//if user has deactivated their account then loggin back in reopns account
		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' and user_closed='yes'");
		if(mysqli_num_rows($user_closed_query) == 1){
			$reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
		}
		
		$_SESSION['username'] = $username;
		$_SESSION['user_id'] = $userId;
		$_SESSION['user_level']=$row['user_level'];
		$_SESSION['user_theme']=$row['user_theme'];
		header("Location: index.php");
		exit();
	}else{
		array_push($error_array, "Email or password is incorrect<br>");
	}
}






?>



