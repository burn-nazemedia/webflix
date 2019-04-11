<?php
session_start();
//include database connection
include( "inc/header.php" );

if ( isset( $_GET[ 'searchterm' ] ) ) {

	$result = mysqli_query( $con,
		"SELECT *
				 FROM `movie`
				 WHERE `movie_name` LIKE '%{$_GET['searchterm']}%'"
	);

} else if ( isset( $_GET[ 'name' ] ) ) {

	$result = mysqli_query( $con,
		"SELECT *
				 FROM `movie`
				 WHERE `movie_name`='{$_GET['name']}'"
	);


} else if ( isset( $_GET[ 'cat' ] ) ) {

	$result = mysqli_query( $con,
		"SELECT *
				 FROM `movie`
				 WHERE `movie_genre`='{$_GET['cat']}'"
	);







} else {
	$result = mysqli_query( $con,
		"SELECT *
				 FROM `movie`"
	);
}
?>

<!--------------------------------MOBILE ADMIN---------------------------------->
<div class="container-fluid">

	<div class="row">

		<div>

			<?php
			if ( $_SESSION[ 'user_level' ] == 'admin' ) {
				echo '<a class="adminlink" href="admin.php"><h3>Admin</h3></a>';
			}
			?>

		</div>


	</div>
</div>
<div class="container-fluid">
	<div class="row">

		<div>



			<?php 
			//loop through each row from results
			while ($row=mysqli_fetch_array($result)) {
			?>
			<img class="listingsthumb img-responsive" src="<?php echo $row['movie_image_main']; ?>" width="200"/>
			<a href="movie.php?id=<?php echo $row['movie_id']; ?>">


				<h1 class="listingname">
					<?php echo $row['movie_name']; ?> </h1>
				<p>
					<?php echo $row['movie_description']; ?>
				</p>


			</a>
			<br/>
			<hr></hr>

			<?php
			} // end while loop
			?>
		</div>



	</div>
</div>

</body>

</html>