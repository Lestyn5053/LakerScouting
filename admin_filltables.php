<?php
require 'header.php'
?>
<?php
if ($_SESSION['userRole'] != 'Admin') {
    header("Location: index.php?error=noaccess");
    exit();
}
?>
<h1 style="text-align:center">Populate Tables</h1>
    <form action="includes/admin_fillcomptable.php" method="post">
        <div class="d-grid gap-2">
            <button class="btn btn-outline-primary btn-lg btn-block" type="submit" name="comp-table-submit">Populate Competition Table</button>
        </div>
    </form>
    <br>
    <form action="includes/admin_fillrobotable.php" method="post">
        <div class="d-grid gap-2">
            <button class="btn btn-outline-primary btn-lg btn-block" type="submit" name="robot-table-submit">Populate Robot Table</button>
        </div>
    </form>
    <br>
    <form action="includes/admin_fillrobotsatcomptable.php" method="post">
        <div class="d-grid gap-2">
            <button class="btn btn-outline-primary btn-lg btn-block" type="submit" name="linking-table-submit">Populate RobotsAtComp Table</button>
        </div>
    </form>
<?php
require 'footer.php';
?>