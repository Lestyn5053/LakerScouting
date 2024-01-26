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
		else if ($_GET['error'] == "invalidemailuid") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Invalid email or username.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </div>';
		}
		else if ($_GET['error'] == "invalidemail") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Invalid email.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </div>';
		}
		else if ($_GET['error'] == "invaliduid") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Invalid username.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </div>';
		}
		else if ($_GET['error'] == "passwordcheck") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Your passwords do not match. Please double check your spelling and try again.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </div>';
		}
		else if ($_GET['error'] == "usertaken") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            That username has already been taken. Please pick a new name and try again.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </div>';
		}
        else if ($_GET['error'] == "accountexists") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            An account with this email address already exists. Please <a href="login.php>Log In</a> instead.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </div>';
		}
		else if ($_GET['error'] == "resetpasswordempty") {
			echo '<p class="text-error">You left something blank while resetting your password.</br>Please re-submit your password reset request.</p>';
		}
		else if ($_GET['error'] == "resetpasswordconfirm") {
			echo '<p class="text-error">Your passwords did not match while resetting your password.</br>Please re-submit your password reset request.</p>';
		}
	}
	else if ($_GET['signup'] == "success") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Sign up successful!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </div>';
	}
	?>
    <h1>Sign Up</h1>
    <form action="includes/signupsubmit.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Password</label>
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
        </div>
        <div class="mb-3">
            <label for="pwd-confirm" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="pwd-confirm" name="pwd-confirm" placeholder="Confirm Password">
        </div>
        <button class="btn btn-success btn-block input-group-btn" type="submit" name="signup-submit">Create Account</button>
    </form>
    <h6>Already have an account? <a href="login.php">Log In</a></h6>
</main>
<?php
require 'footer.php';
?>