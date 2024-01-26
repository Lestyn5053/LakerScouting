<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Feather Scout</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	</head>
    <body>
        <header>
			<a href="index.php" class="btn btn-outline-primary btn-sm">Home Page</a>
			<?php
			if(basename($_SERVER['PHP_SELF']) != 'login.php' 
			&& basename($_SERVER['PHP_SELF']) != 'signup.php'
			&& !isset($_SESSION['userID'])) {
				echo '<a href="login.php" class="btn btn-outline-primary btn-sm">Log In</a>';
			} else if (basename($_SERVER['PHP_SELF']) != 'login.php' 
			&& basename($_SERVER['PHP_SELF']) != 'signup.php'
			&& isset($_SESSION['userID'])) {
				echo '<form class="row row-cols-lg-auto g-3 align-items-center" action="includes/logout.php" method="post">
				<div class="col-12">
				<label> Hi ' . $_SESSION['userID'] . '</label>
				</div>
				<div class="col-12">
				<button class="btn btn-outline-primary btn-sm" id="button" type="submit" name="logout-submit">Log Out</button>
				</div>
				</form>';
			}
			?>
        </header>