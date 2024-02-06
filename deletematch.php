<?php
require 'header.php';
?>
<?php
if ($_SESSION['userRole'] != 'Admin') {
    header("Location: index.php?error=noaccess");
    exit();
}
?>
<h1>Delete Match</h1>

<form action="includes/admin_deletematchsubmit.php?ID=<?php echo $_GET['ID']; ?>&CompID=<?php echo $_GET['CompID']; ?>" method="post">
    <h3>Are you sure you wish to delete this data?</h3>
    <button class="btn btn-danger btn-block input-group-btn" type="submit" name="delete-match-submit">Delete</button>
    <a href="admin_editdata.php?CompID=<?php echo $_GET['CompID']; ?>" class="btn btn-primary btn-block input-group-btn">Go Back</a>
</form>

<?php
require 'footer.php';
?>