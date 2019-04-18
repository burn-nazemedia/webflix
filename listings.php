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
<div class="container-fluid splash-left4  wow fadeIn" data-wow-duration="2s" data-wow-delay="2s">
	<?php include 'inc/nav.php' ?>
	<div class="row">

		<div class="col-md-6">
	<h1 class="splash-msg" style="margin-left: 10%;">Movie Database</h1>
</div>
<div class="col-md-6 text=center">

							 <form method="post">
									 <input type="text" class="homeSearch" placeholder="Search..."/>
							 </form>

</div>
</div>
	<hr/>
	<div class="row" style="margin-left: 4%;">





			<?php
			//loop through each row from results
			while ($row=mysqli_fetch_array($result)) {
			?>
			<div class="col-md-3 text-center" >
				<div class="dblist" style="width: 90%; background-color: #494949; border-radius: 25px; padding: 2%; opacity: 0.7;">
					<a id="listTile" href="movie.php?id=<?php echo $row['movie_id']; ?>" style="color: white;">
			<img class="listingsthumb img-responsive" src="<?php echo $row['movie_image_main']; ?>"
			 		style="width: 80%; height: 13em; border-radius: 25px; margin-top: 4%;"/>
					<hr/>



				<h4 class="listingname">
				<strong>	<?php echo $row['movie_name']; ?> </strong></h4><hr/>
				<p>
					<strong><?php echo $row['movie_release_date']; ?></strong>
				</p>
				<hr/>
				<p>
			<strong>Genre:	<?php echo $row['movie_genre']; ?></strong>
				</p>


			</a>
		</div>
		</div>
			<br/>
			<hr></hr>

			<?php
			} // end while loop
			?>
		</div>



	</div>


</body>

</html>
