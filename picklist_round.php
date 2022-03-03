<?php
    require 'header.php';
    $CompID = trim($_GET['CompID']);
?>
<main>
    <h1 style="text-align:center">Picklist Round</h1>
    <h3 style="text-align:center">By round, we mean rounds one and two of alliance selection.</h3>
    <div class="d-grid gap-2">
	    <a class="btn btn-outline-primary btn-lg btn-block" href="picklist_round_one.php?CompID=<?php echo $CompID; ?>">Round One</a>
        <a class="btn btn-outline-primary btn-lg btn-block" href="picklist_round_two.php?CompID=<?php echo $CompID; ?>">Round Two</a>
    </div>

</main>
<?php
    require 'footer.php';
?>