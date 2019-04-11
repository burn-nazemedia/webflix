<?php
session_start();// calls for create session

include ("inc/dbconnect.inc.php");

if($_POST['mode']=="register") { //if registration, post is used as doesnt display info in browser
	
	$valid = true; // validation flag
	
	if($_POST['r_uname']=="") //if no username
		$valid=false;
	
	if($_POST['r_pword1']=="") //if no password
	 	$valid=false;
	
	if($_POST['r_pword1']!=$_POST['r_pword2']) //if passwords don't match
	 	$valid=false;
	
	if(!$valid) { //if not valid
		
		$_SESSION['message']="Please enter valid data.";
		header("location: register.php");
	} else {
		//echo "valid!";
	
		$userCheck = mysqli_query($dbconnection,
								 "SELECT *
								 FROM `USER`
								 WHERE `user_username` =
								 '{$_POST['r_uname']}'"
								 
								 );
		
		
		//check if username is taken
		if (mysqli_num_rows($userCheck)>0) {
			$_SESSION['message']="Username is taken.";
			header("location: register.php");
			
		} else {
			$username = $_POST['r_uname'];
			//hashed password
			$password = md5 ($_POST['r_pword1']);
			//try insertion
			$register = mysqli_query($dbconnection,
									"INSERT INTO `USER`
									(`user_username`,
									`user_password`,
									`user_level`)
									VALUES
									('{$username}','{$password}',
									'user')"
								   
								   );
			//if registered
			if ($register){
				$_SESSION['message']="Sign up successful.";
			}else{
				$_SESSION['message']="There has been a registration error.";
			}
			header("location: register.php");
		}// end user check
								 
								
	}//end validation check
	
}//end register routine



if($_POST['mode']=="login") {
	
	$valid = true; //validation flag
	
	if($_POST['l_uname']=="") //if no username
		$valid=false;
	
	if($_POST['l_pword']=="") //if no password
		$valid=false;
	
	if(!valid) { //if not valid
		?>
   
	
	Username:<input type="text" name="l_uname" /> <br />
	Password:<input type="password" name="l_pword" /> <br />
	<input type="submit" value="Log In" />
	<input type="hidden" name = "mode" value="Log In" />
	   <p>Please enter details</p>
	
	
	<?php	
	}else{
		
		$username = $_POST['l_uname'];
			//hashed password
			$password = md5 ($_POST['l_pword']);
		
			$login = mysqli_query($dbconnection,
								  "SELECT * 
								  FROM `USER`
								  WHERE `user_username`='{$username}'
								  AND `user_password`='{$password}'"
								 
					);// check username and password match
		//if login is successful
		if(mysqli_num_rows($login)>0){
			
			while($row=mysqli_fetch_array($login)) {
				$_SESSION['user_id']=$row['user_id'];
				$_SESSION['user_username']=$row['user_username'];
				$_SESSION['user_level']=$row['user_level'];
				
				
			}?>

<p>Welcome to the site: <?php echo $_SESSION['user_username']; ?>
<a href="logout.php"></a></p>

<?php
			
		}else{
			?>
	
	Username:<input type="text" name="l_uname" /> <br />
	Password:<input type="password" name="l_pword" /> <br />
	<input type="submit" value="Log In" />
	<input type="hidden" name = "mode" value="Log In" />
	   <p>Username and password do not match</p>
	
			
<?php
		} 
		
		
	}//end validation check
	
}//end login routine