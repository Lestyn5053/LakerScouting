<?php
require 'header.php';
?>
<?php
if ($_SESSION['userRole'] != 'Admin') {
    header("Location: index.php?error=noaccess");
    exit();
}
?>
<h1 style="text-align:center">Access Management</h1>

<?php
require 'includes/dbh.php';
$sql = "SELECT UserName, Email, Role FROM Users";
$response = @mysqli_query($conn, $sql);
echo '<table class="table table-bordered border-primary">
<thead class="table-light">
<tr align="center"><td>User Name</td>
<td>Email</td>
<td>User Role</td>
<td>Modify Role</td>
<td>Delete User</td>
</thead>';

while ($row = mysqli_fetch_array($response)) {
    echo '<tr align="center"><td> ' . $row['UserName'] . '</td><td>' . $row['Email'] . '</td><td>' . $row['Role'] . '</td>';
    echo '<td><a href="edituserrole.php?userID='. $row['UserName'] .'&email='. $row['Email'] .'&userrole=' . $row['Role'] .'" class="btn btn-primary">Edit</a></td>';
    echo '<td><a href="deleteuser.php?userID='. $row['UserName'] .'" class="btn btn-danger">Delete</a></td>';
    echo '</tr>';
}
echo '</table>';
?>
<?php
require 'footer.php';
?>