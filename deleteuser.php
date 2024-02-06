<?php
require 'header.php';
?>
<?php
if ($_SESSION['userRole'] != 'Admin') {
    header("Location: index.php?error=noaccess");
    exit();
}
?>
<h1>Delete User</h1>

<form action="includes/deleteusersubmit.php?userID=<?php echo $_GET['userID']; ?>" method="post">
    <h3>Are you sure you wish to delete this user?</h3>
    <button class="btn btn-danger btn-block input-group-btn" type="submit" name="delete-user-submit">Delete</button>
    <a href="admin_accessmanagement.php" class="btn btn-primary btn-block input-group-btn">Go Back</a>
</form>

<?php
require 'footer.php';
?>