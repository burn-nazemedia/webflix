<?php
session_start();
//include database connection
include( "inc/header.php" );

$id = $_GET[ 'id' ];
//set miovie ID to ID variable
$result = mysqli_query( $con,
	"SELECT *
			 FROM `movie`
			 WHERE  `movie_id`={$id}"


);



?>

<!--popup to confirm deleting movie-->
<script type="text/javascript">
	function confirmChoice( productId ) {
		response = confirm( "Are you sure you want to delete?" );
		if ( response == 1 ) {
			window.location = "mng_movies.php?action=delete&id=" + productId;
		} else {
			return false;
		}
	}
</script>


<!-------------------------------ADMIN Link---------------------------------->
<div class="container-fluid">

	<div class="row">

		<div class=" col-sm-12 hidden-md hidden-lg hidden-xl">

			<?php
			if ( $_SESSION[ 'user_level' ] == 'admin' ) {
				echo '<a class="adminlink" href="admin2.php"><h3>Admin</h3></a>';
			};
			?>

		</div>


	</div>
</div>

<?php
//loop through each row from results
while ( $row = mysqli_fetch_array( $result ) ) {
	?>
	<div class="container-fluid splash-left">
<?php include 'inc/nav.php'?>
		<div class="row" style="margin-top: 5em;">
<div class="col-md-2"></div>
			<div class="col-md-4 movdet" style="text-align: justified;">
				<?php include("inc_search.inc.php"); ?>
				<div>

					<img class="img-responsive" src="<?php echo $row['movie_image_main']; ?>" style="width: 50%; border-radius: 25px;"/>
				<br/>	<br/><h1 class="splash-msg1" style="color: #ff8d3f;">
						<?php echo $row['movie_name'];  ?> <br/> <span class="splash-msg" style="color: #d5d6d2; font-size: 30px;"> <?php echo $row['movie_release_date']; ?></span>
					</h1>
					<p class="splash-msg" style="font-size: 25px; color: #d5d6d2; ">

						<?php echo $row['movie_description']; ?><br/>
					</p>

         	<img class="img-responsive" src="<?php echo $row['movie_image_thumb']; ?>" style="width: 25%; border-radius: 25px;"/>
<br/><br/>
					<p  style="color: white;">
						Genre:&nbsp;
						<span class="genre" style="color: #ff8d3f;"><?php echo $row['movie_genre']; ?> </span></p>
					<!--Update and delete links for admin-->
					<?php

					if ( $_SESSION[ 'user_level' ] == 'admin' ) {
						?>
					<div class="adminproductlink">
						<a href="javascript:confirmChoice (<?php echo $row['movie_id'];?>)">Delete?</a> | <a href="update_movie.php?action=update&id=<?php echo $row['movie_id'];?>">Update?</a> </div>
					<?php

					}

					?>

					<?php
					} // end while loop
					?>
				</div>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-3 movdet" style="text-align: justified;">
				<!--ACTORS-->
				<?php
				//get all RSS feeds

				$actorResult = mysqli_query( $con,
					"SELECT *
										FROM `actor`" );



				//flag to see if match with user (if they are subscribed)
				$matchFlag = false;




				//get user linked subscriptions
				$movieActorResult = mysqli_query( $con,
					"SELECT *
									FROM `actor`
									INNER JOIN `movie_actor`
									ON `movie_actor`.`actor_id` = `actor`.`actor_id`
									WHERE `movie_actor`.`movie_id`={$id}" );

				//this nested loop is for the subscription query
				while ( $subRow = mysqli_fetch_array( $movieActorResult ) ) {

					//check if the address matches between the two
					//(could check title, however rss_id would be ambiguous
					//as it appears in two tables)
					/*$firstTableAddress = $rssRow['rss_url'];
					$secondTableAddress = $subRow['rss_url'];

					if($firstTableAddress==$secondTableAddress) {
						$matchFlag = true;
					}*/
					?>
				<div class="movieperson">

					<h1 class="starhead">Actors</h1>

					<h3 class="starname">
						<?php echo $subRow['actor_fname']; ?>&nbsp;
						<?php echo $subRow['actor_sname']; ?>
			<img src="<?php echo $subRow['actor_img'];?>"
			 style="width: 80px; border-radius: 25px; ">
		 </h3>


				</div>
				<?php }
				?>


				<?php
				//get all from actor

				$directorResult = mysqli_query( $con,
					"SELECT *
										FROM `director`" );



				//flag to see if match with user (if they are subscribed)
				$matchFlag = false;




				//get user linked subscriptions
				$movieDirectorResult = mysqli_query( $con,
					"SELECT *
									FROM `director`
									INNER JOIN `movie_director`
									ON `movie_director`.`director_id` = `director`.`director_id`
									WHERE `movie_director`.`movie_id`={$id}" );

				//this nested loop is for the subscription query
				while ( $directorRow = mysqli_fetch_array( $movieDirectorResult ) ) {

					//check if the address matches between the two
					//(could check title, however rss_id would be ambiguous
					//as it appears in two tables)
					/*$firstTableAddress = $rssRow['rss_url'];
					$secondTableAddress = $subRow['rss_url'];

					if($firstTableAddress==$secondTableAddress) {
						$matchFlag = true;
					}*/
					?>
				<div class="movieperson">

					<h1 class="starhead">Directors</h1>

					<h3 class="starname">
						<?php echo $directorRow['director_fname']; ?>&nbsp;
						<?php echo $directorRow['director_sname']; ?>
						<img src="<?php echo $directorRow['director_image'];?>"
						 style="width: 80px; border-radius: 25px; ">
					</h3>


				</div>
				<?php }
				?>

				<!--Writers-->

				<?php
				//get all from actor

				$writerResult = mysqli_query( $con,
					"SELECT *
										FROM `writer`" );



				//flag to see if match with user (if they are subscribed)
				$matchFlag = false;




				//get user linked subscriptions
				$movieWriterResult = mysqli_query( $con,
					"SELECT *
									FROM `writer`
									INNER JOIN `movie_writer`
									ON `movie_writer`.`writer_id` = `writer`.`writer_id`
									WHERE `movie_writer`.`movie_id`={$id}" );

				//this nested loop is for the subscription query
				while ( $writerRow = mysqli_fetch_array( $movieWriterResult ) ) {

					//check if the address matches between the two
					//(could check title, however rss_id would be ambiguous
					//as it appears in two tables)
					/*$firstTableAddress = $rssRow['rss_url'];
					$secondTableAddress = $subRow['rss_url'];

					if($firstTableAddress==$secondTableAddress) {
						$matchFlag = true;
					}*/
					?>
				<div class="movieperson">

					<h1 class="starhead">Writers</h1>

					<h3 class="starname">
						<?php echo $writerRow['writer_fname']; ?>&nbsp;
						<?php echo $writerRow['writer_sname']; ?>&nbsp;&nbsp;&nbsp;
						<img src="<?php echo $writerRow['writer_img'];?>"
						 style="width: 80px; border-radius: 25px;">
					</h3>


				</div>
				<?php }
				?>

</div>
		</div>









	<script type="text/javascript" src="js/bootstrap.js"></script>
	</body>

	</html>
