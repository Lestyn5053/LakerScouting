<?php
require 'header.php';
?>
<main>
    <?php
    	if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Please fill in all fields.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </div>';
            }
            else if ($_GET['error'] == "wrongpassword") {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                The password entered was incorrect.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </div>';
            }
            else if ($_GET['error'] == "nouser") {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                The username or email entered could not be found. Check your spelling or <a href="signup.php">Sign Up</a> instead.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </div>';
            }
        }
    ?>
<h1>Log In</h1>
<form action="includes/loginsubmit.php" method="post">
        <div class="mb-3">
            <label for="emailuid" class="form-label">Email/UserName</label>
            <input type="text" class="form-control" id="emailuid" name="emailuid" placeholder="Email/Username">
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Password</label>
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
        </div>
        <button class="btn btn-success btn-block input-group-btn" type="submit" name="login-submit">Log In</button>
    </form>
    <h6>Don't have an account yet? <a href="signup.php">Sign Up</a></h6>
</main>
<?php
require 'footer.php';
?>