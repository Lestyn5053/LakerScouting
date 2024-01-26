<?php
    require 'header.php';
?>
<main>
    <h1 style="text-align:center">Competition</h1>
    <?php
	require 'includes/dbh.php';
	$sql = "SELECT ID, CompName FROM Competition ORDER BY Week ASC, CompName ASC";
	$response = mysqli_query($conn, $sql);
    ?>
    <div class="d-grid gap-2">
    <?php
    if (isset($_GET['review'])) {
        while($row = mysqli_fetch_array($response)) {
            echo '<a class="btn btn-outline-primary btn-lg btn-block" href="review.php?CompID='. $row['ID'] .'">'. $row['CompName'] .'</a>';
        }
    } else if (isset($_GET['scout'])) {
        while($row = mysqli_fetch_array($response)) {
            echo '<a class="btn btn-outline-primary btn-lg btn-block" href="match_scout.php?CompID='. $row['ID'] .'">'. $row['CompName'] .'</a>';
        }
    }

	?>
    </div> 
</main>
<?php
    require 'footer.php';
?>