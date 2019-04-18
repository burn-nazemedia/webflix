<?php

//declaring variables to prevent errors
$fname = ""; //first name
$lname = ""; //last name
$em = ""; //email
$em2 = ""; //confirm email
$password = ""; //password
$password2 = ""; //password 2
$date = ""; //date
$error_array = array(); //holds error messages


//if button is pressed, handle the form
//strip tags is secrity measure to take away HTML tags
if ( isset( $_POST[ 'register_button' ] ) ) {

	//Registration form values
	//first name
	$fname = strip_tags( $_POST[ 'reg_fname' ] ); //remove HTML tags
	$fname = str_replace( ' ', '', $fname ); // remove spaces
	$fname = ucfirst( strtolower( $fname ) ); // uppercase first letter, rest of name lowercase
	$_SESSION[ 'reg_fname' ] = $fname; //Stores first name into session variable

	//Last name
	$lname = strip_tags( $_POST[ 'reg_lname' ] ); //remove HTML tags
	$lname = str_replace( ' ', '', $lname ); // remove spaces
	$lname = ucfirst( strtolower( $lname ) ); // uppercase first letter, rest of name lowercase
	$_SESSION[ 'reg_lname' ] = $lname; //Stores last name into session variable

	//email
	$em = strip_tags( $_POST[ 'reg_email' ] ); //remove HTML tags
	$em = str_replace( ' ', '', $em ); // remove spaces
	$em = ucfirst( strtolower( $em ) ); // uppercase first letter, rest of name lowercase
	$_SESSION[ 'reg_email' ] = $em; //Stores email into session variable
	//email
	$em2 = strip_tags( $_POST[ 'reg_email2' ] ); //remove HTML tags
	$em2 = str_replace( ' ', '', $em2 ); // remove spaces
	$em2 = ucfirst( strtolower( $em2 ) ); // uppercase first letter, rest of name lowercase
	$_SESSION[ 'reg_email2' ] = $em2; //Stores email into session variable
	//password
	$password = strip_tags( $_POST[ 'reg_password' ] ); // remove HTML tags

	//password confirm
	$password2 = strip_tags( $_POST[ 'reg_password2' ] ); // remove HTML tags

	$date = date( "Y-m-d" ); // current date

	if ( $em == $em2 ) {
		//check if email is in valid format
		if ( filter_var( $em, FILTER_VALIDATE_EMAIL ) ) {

			$em = filter_var( $em, FILTER_VALIDATE_EMAIL );

			//check if email already exists
			$e_check = mysqli_query( $con, "SELECT email FROM users WHERE email='$em'" );

			//count the number of rows returned
			$num_rows = mysqli_num_rows( $e_check );

			if ( $num_rows > 0 ) {
				array_push( $error_array, "Email already in use<br>" );
			}
		} else {
			array_push( $error_array, "Invalid format<br>" );
		}
	} else {
		array_push( $error_array, "Emails do not match<br>" );
	}

	if ( strlen( $fname ) > 25 || strlen( $fname ) < 2 ) {
		array_push( $error_array, "Your first name must be between 2 and 25 characters<br>" );
	}
	if ( strlen( $lname ) > 25 || strlen( $lname ) < 2 ) {
		array_push( $error_array, "Your last name must be between 2 and 25 characters<br>" );
	}
	if ( $password != $password2 ) {
		array_push( $error_array, "Your passwords do not match<br>" ); //check if passwords match
	} else {
		if ( preg_match( '/[^A-Za-z0-9]/', $password ) ) { //check valid characters
			array_push( $error_array, "Your password can only contain english characters or numbers<br>" );
		}
	}

	if ( strlen( $password ) > 30 || strlen( $password ) < 5 ) { //password must be between 8-30 characters
		array_push( $error_array, "Your password must be between 5 and 30 characters<br>" );
	}
	if ( empty( $error_array ) ) { // if error is empty then write to database
		$password = md5( $password ); // Encrypt using MD5
		//Generate username by concatenating first and last name
		$username = strtolower( $fname . "_" . $lname );
		$check_username_query = mysqli_query( $con, "SELECT username FROM users WHERE username='$username'" );

		$i = 0;
		//if username exists then add number to username
		while ( mysqli_num_rows( $check_username_query ) != 0 ) {
			$i++; //Add 1 to i
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query( $con, "SELECT username FROM users WHERE username='$username'" );

		}

		//Profile picture assignment, assigns random profile picture
		$rand = rand( 1, 2 ); // Random number between 1 and 2
		if ( $rand == 1 )
			$profile_pic = "assets/images/profile_pics/defaults/default_grey.png";
		else if ( $rand == 2 )
			$profile_pic = "assets/images/profile_pics/defaults/default-profile-picture.jpg";

		$query = mysqli_query( $con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic','','','','user','','')" );

		array_push( $error_array, "You are now registered. Please login!<br>" );

		//clear session variables
		$_SESSION[ 'reg_fname' ] = "";
		$_SESSION[ 'reg_lname' ] = "";
		$_SESSION[ 'reg_email' ] = "";
		$_SESSION[ 'reg_email2' ] = "";
	}

}






?>