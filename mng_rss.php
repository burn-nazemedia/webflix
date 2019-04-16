<?php
session_start();

include ("inc/header.php");


if($_POST['action']=="insert") {

	define ("MAX_SIZE",20971520);
	$errors=0;

	//filenames
	$main = $_FILES['main'] ['name'];

	//temp files
	$upMain = $_FILES['main'] ['tmp_name'];


	//image extensions check
	$mainFile = stripslashes($main);
	$mainExt = strtolower(getExtension($mainFile));



	if(!validExtension($mainExt)) {
		$_SESSION['message'] = "Unknown image extension";
		$errors=1;


	} else {

		//filesizes
		$mainSize = filesize($upMain);


		if($mainSize>MAX_SIZE){
			$_SESSION['message'] = "Too big!!";
			$errors=1;

		}else{
			//filetype checks for memory images
			switch($mainExt) {
				case "jpg" : $mainSrc =
					imagecreatefromjpeg($upMain); break;
			case "jpeg" : $mainSrc =
					imagecreatefromjpeg($upMain); break;
			case "png" : $mainSrc =
					imagecreatefrompng($upMain); break;
			case "gif" : $mainSrc =
					imagecreatefromgif($upMain); break;
			}



			//get uploaded width and height
			list ($mainWidth,$mainHeight) = getimagesize($upMain);

			//main width
			$mainNewWidth = 250;
			$mainNewHeight=($mainHeight/$mainWidth)*$mainNewWidth;
			$tmpMain =
				imagecreatetruecolor($mainNewWidth,$mainNewHeight);


			//resave image
			imagecopyresampled($tmpMain,$mainSrc,
							   0,0,0,0,
							   $mainNewWidth, $mainNewHeight,
							   $mainWidth,$mainHeight);



			//create and save the images
			switch($mainExt){
				case "jpg":
					imagejpeg($tmpMain,"images/main" . $main,100);
					break;
				case "jpeg":
					imagejpeg($tmpMain,"images/main" . $main,100);
					break;
				case "png":
					imagepng($tmpMain,"images/main" . $main,0);
					break;
				case "gif":
					imagegif($tmpMain,"images/main" . $main);
					break;
			}



				//free up memory
			imagedestroy($mainSrc); imagedestroy($tmpMain);


		} // end filesize check

	}// end extension check

	if(!$errors) {

		//sanitise before entry
		$rss_name = mysqli_escape_string($con,
											  $_POST['rss_name']);

		$rss_url = mysqli_escape_string($con,
											  $_POST['rss_url']);


		$main = "images/main" . $main;

		//insert query
		$insertSql = "INSERT INTO `rss`
		              (`rss_name`,`rss_url`,`rss_image`)
					  VALUES
					  ('{$rss_name}','{$rss_url}','{$main}')";

		$insertResult = mysqli_query($con,$insertSql);
		if($insertResult){
			header("location: rss_detail.php?id=" .
			mysqli_insert_id($con));
		}else{
			$_SESSION['message'] = "Insertion failed!";
			header("location: admin_rss.php");

			}


	} else {

		$_SESSION['message'] = "Image failed!";
			header("location: admin_rss.php");

	}

} else if ($_GET['action']=="delete") {

	$deleteQuery="DELETE FROM `rss`
	WHERE `rss_id`={$_GET['id']}";
	$deleteResult=mysqli_query($con,$deleteQuery);

	if($deleteResult) {
		$_SESSION['message']="Great success! Deleted.";

	}else{
		$_SESSION['message']="Delete Failed. :(";
	}
	header("location:admin_rss.php");
} else if($_POST['action']=="update") {


define ("MAX_SIZE",20971520);
	$errors=0;

	//filenames
	$main = $_FILES['main'] ['name'];

	//temp files
	if($main) {
	$upMain = $_FILES['main'] ['tmp_name'];
	}

	//image extensions check
	if($main) {
	$mainFile = stripslashes($main);
	$mainExt = strtolower(getExtension($mainFile));
	}

	if($main && (!validExtension($mainExt) )) {
		$_SESSION['message'] = "Unknown image extension";
		$errors=1;


	} else {

		//filesizes
		if($main){
		$mainSize = filesize($upMain);
		}

		if(($main && $mainSize>MAX_SIZE) ){

			$_SESSION['message'] = "Too big!!";
			$errors=1;

		}else{
			//filetype checks for memory images
			if($main) {
			switch($mainExt) {
				case "jpg" : $mainSrc =
					imagecreatefromjpeg($upMain); break;
			case "jpeg" : $mainSrc =
					imagecreatefromjpeg($upMain); break;
			case "png" : $mainSrc =
					imagecreatefrompng($upMain); break;
			case "gif" : $mainSrc =
					imagecreatefromgif($upMain); break;
			}
			}

			//get uploaded width and height
			if($main){
			list ($mainWidth,$mainHeight) = getimagesize($upMain);
			}

			//main width
			if($main){
			$mainNewWidth = 250;
			$mainNewHeight=($mainHeight/$mainWidth)*$mainNewWidth;
			$tmpMain =
				imagecreatetruecolor($mainNewWidth,$mainNewHeight);
			}

			//resave image
			if($main){
			imagecopyresampled($tmpMain,$mainSrc,
							   0,0,0,0,
							   $mainNewWidth, $mainNewHeight,
							   $mainWidth,$mainHeight);
			}

			//create and save the images
			if($main){
			switch($mainExt){
				case "jpg":
					imagejpeg($tmpMain,"images/main" . $main,100);
					break;
				case "jpeg":
					imagejpeg($tmpMain,"images/main" . $main,100);
					break;
				case "png":
					imagepng($tmpMain,"images/main" . $main,0);
					break;
				case "gif":
					imagegif($tmpMain,"images/main" . $main);
					break;
			}
			}

				//free up memory
			if($main){
			imagedestroy($mainSrc); imagedestroy($tmpMain);
			}
		} // end filesize check

	}// end extension check

	if(!$errors) {

		//sanitise before entry
		$rss_name = mysqli_escape_string($con,
											  $_POST['rss_name']);

		$rss_url = mysqli_escape_string($con,
											  $_POST['rss_url']);

		if($main){
		$main = "images/main" . $main;
		}

		//update query
		$updateSql = "UPDATE `rss`
					SET `rss_name`='{$rss_name}',
					`rss_url`='{$rss_url}'";

		if ($main) {
			$updateSql.=",`rss_image`='{$main}'";
		}
		$updateSql.=" WHERE `rss_id`={$_POST['id']}";
		$updateResult = mysqli_query($con,$updateSql);
		if($updateResult){
			header("location: rss_listings.php?id=" . $_POST['id']);
		}else{

			header("location: admin_rss.php?id=" . $_POST['id']);

			}


	} else {

		$_SESSION['message'] = "Image failed!";
			header("location: admin.php");

	}

}// end update


function validExtension ($ext){
	if($ext == "jpg"  || $ext == "jpeg"  ||
	    $ext == "png" || $ext == "gif") {
		return true;
	}else{
		return false;
	}
}

function getExtension($str) {
	//check for dot in string
	$i = strrpos($str,".");
	// if no dot return nothing
	if (!$i) { return ""; }
	// whats the index based on length on string
	$l = strlen($str) - $i;
	//get extension using substring
	$ext = substr($str,$i+1,$l);
	//return extension
	return $ext;


}
