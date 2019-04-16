<?php
session_start();

include ("inc/header.php");


if($_POST['action']=="insert") {

	define ("MAX_SIZE",20971520);
	$errors=0;

	//filenames
	$main = $_FILES['main'] ['name'];
	$thumb = $_FILES['thumb'] ['name'];
	//temp files
	$upMain = $_FILES['main'] ['tmp_name'];
	$upThumb = $_FILES['thumb'] ['tmp_name'];

	//image extensions check
	$mainFile = stripslashes($main);
	$mainExt = strtolower(getExtension($mainFile));

	$thumbFile = stripslashes($thumb);
	$thumbExt = strtolower(getExtension($thumbFile));

	if(!validExtension($mainExt) || !validExtension($thumbExt)) {
		$_SESSION['message'] = "Unknown image extension";
		$errors=1;


	} else {

		//filesizes
		$mainSize = filesize($upMain);
		$thumbSize = filesize($upThumb);

		if($mainSize>MAX_SIZE || $thumbSize>MAX_SIZE){
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

			switch($thumbExt) {
				case "jpg" : $thumbSrc =
					imagecreatefromjpeg($upThumb); break;
			case "jpeg" : $thumbSrc =
					imagecreatefromjpeg($upThumb); break;
			case "png" : $thumbSrc =
					imagecreatefrompng($upThumb); break;
			case "gif" : $thumbSrc =
					imagecreatefromgif($upThumb); break;

			}

			//get uploaded width and height
			list ($mainWidth,$mainHeight) = getimagesize($upMain);
			list ($thumbWidth,$thumbHeight) = getimagesize($upThumb);
			//main width
			$mainNewWidth = 250;
			$mainNewHeight=($mainHeight/$mainWidth)*$mainNewWidth;
			$tmpMain =
				imagecreatetruecolor($mainNewWidth,$mainNewHeight);
			//thumb width
			$thumbNewWidth = 100;
			$thumbNewHeight=($thumbHeight/$thumbWidth)*$thumbNewWidth;
			$tmpThumb =
				imagecreatetruecolor($thumbNewWidth,$thumbNewHeight);

			//resave image
			imagecopyresampled($tmpMain,$mainSrc,
							   0,0,0,0,
							   $mainNewWidth, $mainNewHeight,
							   $mainWidth,$mainHeight);

			imagecopyresampled($tmpThumb,$thumbSrc,
							   0,0,0,0,
							   $thumbNewWidth,$thumbNewHeight,
							   $thumbWidth,$thumbHeight);

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

			switch($thumbExt){
				case "jpg":
					imagejpeg($tmpThumb,"images/thumb" . $thumb,100);
					break;
				case "jpeg":
					imagejpeg($tmpThumb,"images/thumb" . $thumb,100);
					break;
				case "png":
					imagepng($tmpThumb,"images/thumb" . $thumb,0);
					break;
				case "gif":
					imagegif($tmpThumb,"images/thumb" . $thumb);
					break;
			}

				//free up memory
			imagedestroy($mainSrc); imagedestroy($tmpMain);
			imagedestroy($thumbSrc); imagedestroy($tmpThumb);

		} // end filesize check

	}// end extension check

	if(!$errors) {

		//sanitise before entry
		$movie_name = mysqli_escape_string($con,
											  $_POST['movie_name']);

		$movie_description = mysqli_escape_string($con,
											  $_POST['movie_description']);
		$movie_genre = mysqli_escape_string($con,
											  $_POST['movie_genre']);
		$movie_release_date = mysqli_escape_string($con,
											  $_POST['movie_release_date']);
		$movie_trailer = mysqli_escape_string($con,
											  $_POST['movie_trailer']);


		$main = "images/main" . $main;
		$thumb = "images/thumb" . $thumb;
		//insert query
		$insertSql = "INSERT INTO `movie`
		              (`movie_name`,`movie_description`,`movie_genre`,`movie_release_date`,`movie_image_main`,`movie_image_thumb`,`movie_trailer`)
					  VALUES
					  ('{$movie_name}','{$movie_description}','{$movie_genre}','{$movie_release_date}','{$main}','{$thumb}','{$movie_trailer}')";

		$insertResult = mysqli_query($con,$insertSql);
		if($insertResult){
			header("location: detail.php?id=" .
			mysqli_insert_id($con));
		}else{
			$_SESSION['message'] = "Insertion failed!";
			header("location: admin.php");

			}


	} else {

		$_SESSION['message'] = "Image failed!";
			header("location: admin.php");

	}

} else if ($_GET['action']=="delete") {

	$deleteQuery="DELETE FROM `movie`
	WHERE `movie_id`={$_GET['id']}";
	$deleteResult=mysqli_query($con,$deleteQuery);

	if($deleteResult) {
		$_SESSION['message']="Great success! Deleted.";

	}else{
		$_SESSION['message']="Delete Failed. :(";
	}
	header("location:admin.php");
} else if($_POST['action']=="update") {


define ("MAX_SIZE",20971520);
	$errors=0;

	//filenames
	$main = $_FILES['main'] ['name'];
	$thumb = $_FILES['thumb'] ['name'];
	//temp files
	if($main) {
	$upMain = $_FILES['main'] ['tmp_name'];
	}
	if($thumb){
	$upThumb = $_FILES['thumb'] ['tmp_name'];
	}
	//image extensions check
	if($main) {
	$mainFile = stripslashes($main);
	$mainExt = strtolower(getExtension($mainFile));
	}
	if($thumb){
	$thumbFile = stripslashes($thumb);
	$thumbExt = strtolower(getExtension($thumbFile));
	}
	if($main && (!validExtension($mainExt) )||
	   ($thumb &&  !validExtension($thumbExt))) {
		$_SESSION['message'] = "Unknown image extension";
		$errors=1;


	} else {

		//filesizes
		if($main){
		$mainSize = filesize($upMain);
		}
		if($thumb){
		$thumbSize = filesize($upThumb);
		}
		if(($main && $mainSize>MAX_SIZE)
		   || ($thumb && $thumbSize>MAX_SIZE)){
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
			if($thumb) {
			switch($thumbExt) {
				case "jpg" : $thumbSrc =
					imagecreatefromjpeg($upThumb); break;
			case "jpeg" : $thumbSrc =
					imagecreatefromjpeg($upThumb); break;
			case "png" : $thumbSrc =
					imagecreatefrompng($upThumb); break;
			case "gif" : $thumbSrc =
					imagecreatefromgif($upThumb); break;
				}
			}

			//get uploaded width and height
			if($main){
			list ($mainWidth,$mainHeight) = getimagesize($upMain);
			}
			if($thumb){
			list ($thumbWidth,$thumbHeight) = getimagesize($upThumb);
			}
			//main width
			if($main){
			$mainNewWidth = 250;
			$mainNewHeight=($mainHeight/$mainWidth)*$mainNewWidth;
			$tmpMain =
				imagecreatetruecolor($mainNewWidth,$mainNewHeight);
			}
			//thumb width
			if($thumb){
			$thumbNewWidth = 100;
			$thumbNewHeight=($thumbHeight/$thumbWidth)*$thumbNewWidth;
			$tmpThumb =
				imagecreatetruecolor($thumbNewWidth,$thumbNewHeight);
			}
			//resave image
			if($main){
			imagecopyresampled($tmpMain,$mainSrc,
							   0,0,0,0,
							   $mainNewWidth, $mainNewHeight,
							   $mainWidth,$mainHeight);
			}
			if($thumb){
			imagecopyresampled($tmpThumb,$thumbSrc,
							   0,0,0,0,
							   $thumbNewWidth,$thumbNewHeight,
							   $thumbWidth,$thumbHeight);
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
			if($thumb){
			switch($thumbExt){
				case "jpg":
					imagejpeg($tmpThumb,"images/thumb" . $thumb,100);
					break;
				case "jpeg":
					imagejpeg($tmpThumb,"images/thumb" . $thumb,100);
					break;
				case "png":
					imagepng($tmpThumb,"images/thumb" . $thumb,0);
					break;
				case "gif":
					imagegif($tmpThumb,"images/thumb" . $thumb);
					break;
				}
			}

				//free up memory
			if($main){
			imagedestroy($mainSrc); imagedestroy($tmpMain);
			}
			if($thumb){
			imagedestroy($thumbSrc); imagedestroy($tmpThumb);
			}
		} // end filesize check

	}// end extension check

	if(!$errors) {

		//sanitise before entry
		$movie_name = mysqli_escape_string($con,
											  $_POST['movie_name']);

		$movie_description = mysqli_escape_string($con,
											  $_POST['movie_description']);
		$movie_genre = mysqli_escape_string($con,
											  $_POST['movie_genre']);
		$movie_release_date = mysqli_escape_string($con,
											  $_POST['movie_release_date']);
		$movie_trailer = mysqli_escape_string($con,
											  $_POST['movie_trailer']);


		if($main){
		$main = "images/main" . $main;
		}
		if($thumb){
		$thumb = "images/thumb" . $thumb;
		}
		//update query
		$updateSql = "UPDATE `movie`
					SET `movie_name`='{$movie_name}',
					`movie_description`='{$movie_description}',
					`movie_genre`='{$movie_genre}',
					`movie_release_date`='{$movie_release_date}',
					`movie_trailer`='{$movie_trailer}'";

		if ($main) {
			$updateSql.=",`movie_image_main`='{$main}'";
		}
		if ($thumb) {
			$updateSql.=",`movie_image_thumb`='{$thumb}'";
		}
		$updateSql.=" WHERE `movie_id`={$_POST['id']}";
		$updateResult = mysqli_query($con,$updateSql);
		if($updateResult){
			header("location: movie.php?id=" . $_POST['id']);
		}else{

			header("location: movie.php?id=" . $_POST['id']);

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
