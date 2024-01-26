<?php
require 'header.php'
?>
<?php
if ($_SESSION['userRole'] != 'Admin') {
    header("Location: index.php?error=noaccess");
    exit();
}
?>
<h1 style="text-align:center">Admin Menu</h1>
<div class="d-grid gap-2">
    <a href="admin_accessmanagement.php" class="btn btn-outline-primary btn-lg btn-block">Access Management</a>
    <a href="admin_editdata.php" class="btn btn-outline-primary btn-lg btn-block">Modify Data</a>
    <a href="admin_filltables.php" class="btn btn-outline-primary btn-lg btn-block">Populate Tables</a>
    <a href="admin_cleardata.php" class="btn btn-outline-primary btn-lg btn-block">Clear Table Data</a>
</div>
<?php
require 'footer.php';
?>