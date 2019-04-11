<?php 

//declaring variables to prevent errors
$reviewTitle = ""; //first name
$reviewScore = ""; //last name
$reviewDescription = ""; //email
$error_array = array(); //holds error messages


//if button is pressed, handle the form
//strip tags is secrity measure to take away HTML tags
if(isset($_POST['review_button'])){
	
	//Registration form values
	//first name
	$reviewTitle = strip_tags($_POST['review_title']);//remove HTML tags
	$_SESSION['review_title'] = $reviewTitle; //Stores title into session variable
	
	//Review
	$reviewScore = strip_tags($_POST['review_score']);//remove HTML tags
	$reviewScore = str_replace(' ', '', $reviewScore);// remove spaces
	$_SESSION['review_score'] = $reviewScore; //Stores review score into session variable
	
	//email
	$reviewDescription = strip_tags($_POST['reg_email']);//remove HTML tags
	$reviewDescription = str_replace(' ', '', $reviewDescription);// remove spaces
	$reviewDescription = ucfirst(strtolower($reviewDescription));// uppercase first letter, rest of name lowercase
	$_SESSION['reg_email'] = $reviewDescription; //Stores email into session variable
	//email
	
	$date = date("Y-m-d"); // current date
	
	if($reviewScore > 10){
		//check if email is in valid format
		array_push($error_array, "Your Score must be less than 10<br>");
		
	}
	if($reviewScore > 10){
		//check if email is in valid format
		array_push($error_array, "Your Score must be less than 10<br>");
		
	}
	if(preg_replace('/[0-9\.\-]/', '', $reviewScore) !== ""){
  //if all made of numbers "-" or ".", then yes is number;
		array_push($error_array, "Your Score must be a number<br>");
}
	
	if(strlen($reviewTitle) > 25 || strlen($reviewTitle) < 2) {
		array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
	}
		
	
	
	
	if(empty($error_array)) {// if error is empty then write to database
	
		
		
		
		
		
		$query = mysqli_query($con, "INSERT INTO review VALUES ('','$reviewTitle', '$reviewScore', '$reviewDescription')");
		
		array_push($error_array, "<span style='color: aqua;'>You're Review has been submitted!!</span><br>");
		
		//clear session variables
		$_SESSION['review_title'] = "";
		$_SESSION['review_score'] = "";
		$_SESSION['review_description'] = "";
		
	}
	
}






?>