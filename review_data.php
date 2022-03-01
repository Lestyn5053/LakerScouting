<?php
    require 'header.php';
?>
<main>
    <h1 style="text-align:center">Competition</h1>
    <?php
	require 'includes/dbh.php';
	$sql = "SELECT ID, CompName FROM Competition ORDER BY Week ASC, CompName ASC";
	$response = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($response))
	{
		echo '<a class="btn btn-outline-primary btn-lg btn-block" href="review.php?CompID='. $row['ID'] .'">'. $row['CompName'] .'</a>';
	}
	?> 
</main>
<?php
    require 'footer.php';
?>