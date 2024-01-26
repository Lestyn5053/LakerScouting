<?php
    require 'header.php';
?>
<main>
    <h1 style="text-align:center">Competition</h1>
    <?php
	require 'includes/dbh.php';
	$sql = "SELECT ID, Name FROM Competition ORDER BY Week ASC, Name ASC";
	$response = mysqli_query($conn, $sql);
    ?>
    <div class="d-grid gap-2">
    <?php
	while($row = mysqli_fetch_array($response))
	{
		echo '<a class="btn btn-outline-primary btn-lg btn-block" href="picklist.php?CompID='. $row['ID'] .'">'. $row['Name'] .'</a>';
	}
	?>
    </div> 
</main>
<?php
    require 'footer.php';
?>