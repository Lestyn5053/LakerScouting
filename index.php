<?php
require 'header.php';
?>
<main>
    <?php
    if ($_GET['error'] == "noaccess") {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Access denied
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </div>';
    }
    ?>
    <h1 style="text-align:center"><b>Feather Scout</b></h1>
    <div class="text-center">
        <img class="img-fluid" src="images/logo.png" alt="Feather Logo">
    </div>
    <div class="d-grid gap-2">
        <a href="select_comp.php?scout=true" class="btn btn-outline-primary btn-lg btn-block">Scout</a>
        <a href="select_comp.php?review=true" class="btn btn-outline-primary btn-lg btn-block">Review Data</a>
        <!--<a href="select_comp.php?picklist=true" class="btn btn-outline-primary btn-lg btn-block">Picklist Generator</a>-->
        <a href="acknowledgements.php" class="btn btn-outline-primary btn-lg btn-block">Acknowledgements</a>
        <?php
        if ($_SESSION['userRole'] == 'Admin') {
            echo '<a href="admin.php" class="btn btn-outline-primary btn-lg btn-block">Admin Menu</a>';
        } else if ($_SESSION['userRole'] == 'Team Lead') {
            echo '<a href="team_lead.php" class="btn btn-outline-primary btn-lg btn-block">Team Lead Menu</a>';
        }
        ?>
    </div>
</main>
<?php
require 'footer.php';
?>