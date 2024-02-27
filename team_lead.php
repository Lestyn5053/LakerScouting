<?php
require 'header.php';
?>
<?php
if ($_SESSION['userRole'] != 'Admin' && $_SESSION['userRole'] != 'Team Lead') {
    header("Location: index.php?error=noaccess");
    exit();
}
?>
<h1 style="text-align:center">Team Lead Menu</h1>
<div class="d-grid gap-2">
    <a href="select_comp.php?edit=true" class="btn btn-outline-primary btn-lg btn-block">Modify Data</a>
    <a href="http://tinyurl.com/paperfeatherscout" class="btn btn-outline-success btn-lg btn-block">Download Paper Scouting Sheet</a>
</div>
<?php
require 'footer.php';
?>