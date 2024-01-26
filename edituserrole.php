<?php
require 'header.php';
?>
<?php
if ($_SESSION['userRole'] != 'Admin') {
    header("Location: index.php?error=noaccess");
    exit();
}
?>
<h1>Edit User Role</h1>

<form action="includes/editrolesubmit.php" method="post">
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="text" class="form-control" id="email" name="email" value="<?php echo $_GET['email']; ?>">
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $_GET['userID']; ?>">
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">User Role</label>
        <select class="form-select" name="role" id="role">
            <option value="User" selected>User</option>
            <option value="Team Lead">Team Lead</option>
            <option value="Admin">Admin</option>
        </select>
    </div>
    <button class="btn btn-success btn-block input-group-btn" type="submit" name="edit-role-submit">Submit</button>
</form>

<?php
require 'footer.php';
?>