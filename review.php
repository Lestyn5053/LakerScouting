<?php
require 'header.php';
?>
<main>
    <?php
    $CompID = trim($_GET['CompID']);
    ?>
    <h1 style="text-align:center">Select Data</h1>
    <a href="team_summaries.php?CompID=<?php echo $CompID; ?>" class="btn btn-outline-primary btn-lg btn-block">Team Summaries</a>
    <a href="raw_data.php?CompID=<?php echo $CompID; ?>" class="btn btn-outline-primary btn-lg btn-block">Raw Match Data</a>
    <a href="match_count.php?CompID=<?php echo $CompID; ?>" class="btn btn-outline-primary btn-lg btn-block">Match Count Per Team</a>
</main>
<?php
require 'footer.php';
?>