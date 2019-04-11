<?php
session_start();

include( "inc/header.php" );





if ( $_POST[ 'action' ] == "insert" ) {



    if ( !$errors ) {

        //sanitise before entry
        $review_title = mysqli_escape_string( $con,
            $_POST[ 'review_title' ] );

        $review_score = mysqli_escape_string( $con,
            $_POST[ 'review_score' ] );
        $review_description = mysqli_escape_string( $con,
            $_POST[ 'review_description' ] );
        $review_date = mysqli_escape_string( $con,
            $_POST[ 'review_date' ] );
		

		$movieId = $_GET['movie_id'];
        //insert query
        $insertSql = "INSERT INTO `review`
		              (`movie_id`,`review_title`,`review_score`,`review_description`,`review_date`) 
					  VALUES
					  ('{$movieId}','{$review_title}','{$review_score}','{$review_description}',NOW())";

        $insertResult = mysqli_query( $con, $insertSql );
        if ( $insertResult ) {
            header( "location: movie.php?id=" . mysqli_insert_id( $con ) );
        } else {
            $_SESSION[ 'message' ] = "Insertion failed!";
            header( "location: listings.php" );

        }


}

} 

?>