<script type="text/javascript">
$(document).ready (function(){
	
	$("#searchterm").autocomplete({
		source:"mng_search.php",
		minLength: 2,
		select: function(event, ui)  {
			
			window.location="movie.php?id="+ui.item.id;
			
		}
	});
	
});




</script>



<form action="listings.php" method="get">

	<input type="text" name="searchterm" id="searchterm"/>

	<input type="submit" class="searchbutton" value="Search" />


</form>