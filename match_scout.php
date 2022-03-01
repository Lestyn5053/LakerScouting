<?php
require 'header.php';
?>
<main>
    <?php
    $CompID = trim($_GET['CompID']);
    require 'includes/dbh.php';
    ?>
    <h1 style="text-align:center">Match Scouting</h1>
    <form class="needs-validation" action="includes/match_submit.php?CompID=<?php echo $CompID; ?>" method="post" novalidate>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-basic-tab" data-toggle="pill" href="#pills-basic" role="tab" aria-controls="pills-basic" aria-selected="true">Basic Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-auto-tab" data-toggle="pill" href="#pills-auto" role="tab" aria-controls="pills-auto" aria-selected="false">Auto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-teleop-tab" data-toggle="pill" href="#pills-teleop" role="tab" aria-controls="pills-teleop" aria-selected="false">Teleop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-endgame-tab" data-toggle="pill" href="#pills-endgame" role="tab" aria-controls="pills-endgame" aria-selected="false">End Game</a>
            </li>
        </ul>
        <?php
        if (isset($_GET['submit'])) {
            if ($_GET['submit'] == "success") {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data submitted successfully! Thank you for scouting this match!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </div>';
            }
        }
        ?>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-basic" role="tabpanel" aria-labelledby="pills-basic-tab">
                <div class="form-group">
                    <label for="name" class="col-sm-2 col-form-label">Your Name:</label>
                    <input class="form-control" type="text" id="name" name="name" />
                </div>
                <div class="form-group">
                    <label for="team" class="col-sm-2 col-form-label">Team Number:</label>
                    <select class="custom-select mr-sm-2" name="team" id="team">
                        <?php
                        $sql = "SELECT Robot.ID AS RobotNum FROM Robot, RobotsAtComp WHERE Robot.ID=RobotsAtComp.RobotID AND RobotsAtComp.CompID=? ORDER BY Robot.ID ASC";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo 'There was an SQL Error';
                        } else {
                            mysqli_stmt_bind_param($stmt, "i", $CompID);
                            mysqli_stmt_execute($stmt);
                            $response = mysqli_stmt_get_result($stmt);
                        }
                        while ($row = mysqli_fetch_array($response)) {
                            echo '<option value="' . $row['RobotNum'] . '">' . $row['RobotNum'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="match" class="col-sm-2 col-form-label">Match Number:</label>
                    <input class="form-control" type="number" pattern="[0-9]*" id="match" name="match" />
                </div>
            </div>
            <div class="tab-pane fade" id="pills-auto" role="tabpanel" aria-labelledby="pills-auto-tab">
                <div class="form-group">
                    <label for="auto_move" class="col-sm-2 col-form-label">Did they move out of the Tarmac?</label>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="auto_move1" name="auto_move" class="custom-control-input" value="1">
                        <label class="custom-control-label" for="auto_move1">Yes</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="auto_move2" name="auto_move" class="custom-control-input" value="0" checked>
                        <label class="custom-control-label" for="auto_move2">No</label>
                    </div>
                </div>
                <h2>Cargo</h2>
                <div class="form-group">
                    <script>
                        function plusOne() {
                            document.getElementById('a_hg_scored').stepUp(1);
                        }

                        function minusOne() {
                            document.getElementById('a_hg_scored').stepDown(1);
                            if (document.getElementById('a_hg_scored').value < 0) {
                                document.getElementById('a_hg_scored').value = 0;
                                alert("Nice try. You can't enter a negative number");
                            }
                        }
                    </script>
                    <label for="a_hg_scored">High Goals Scored</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="a_hg_scored" name="a_hg_scored" value="0">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOne()">+1</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOne()">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <script>
                        function plusOneA() {
                            document.getElementById('a_hg_missed').stepUp(1);
                        }

                        function minusOneA() {
                            document.getElementById('a_hg_missed').stepDown(1);
                            if (document.getElementById('a_hg_missed').value < 0) {
                                document.getElementById('a_hg_missed').value = 0;
                                alert("Nice try. You can't enter a negative number");
                            }
                        }
                    </script>
                    <label for="a_hg_missed">High Goals Missed</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="a_hg_missed" name="a_hg_missed" value="0">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOneA()">+1</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOneA()">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <script>
                        function plusOneB() {
                            document.getElementById('a_lg_scored').stepUp(1);
                        }

                        function minusOneB() {
                            document.getElementById('a_lg_scored').stepDown(1);
                            if (document.getElementById('a_lg_scored').value < 0) {
                                document.getElementById('a_lg_scored').value = 0;
                                alert("Nice try. You can't enter a negative number");
                            }
                        }
                    </script>
                    <label for="a_lg_scored">Low Goals Scored</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="a_lg_scored" name="a_lg_scored" value="0">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOneB()">+1</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOneB()">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <script>
                        function plusOneC() {
                            document.getElementById('a_lg_missed').stepUp(1);
                        }

                        function minusOneC() {
                            document.getElementById('a_lg_missed').stepDown(1);
                            if (document.getElementById('a_lg_missed').value < 0) {
                                document.getElementById('a_lg_missed').value = 0;
                                alert("Nice try. You can't enter a negative number");
                            }
                        }
                    </script>
                    <label for="a_lg_missed">Low Goals Missed</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="a_lg_missed" name="a_lg_missed" value="0">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOneC()">+1</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOneC()">-1</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-teleop" role="tabpanel" aria-labelledby="pills-teleop-tab">
                <h2>Cargo</h2>
                <div class="form-group">
                    <script>
                        function plusOneD() {
                            document.getElementById('hg_scored').stepUp(1);
                        }

                        function minusOneD() {
                            document.getElementById('hg_scored').stepDown(1);
                            if (document.getElementById('hg_scored').value < 0) {
                                document.getElementById('hg_scored').value = 0;
                                alert("Nice try. You can't enter a negative number");
                            }
                        }
                    </script>
                    <label for="hg_scored">High Goals Scored</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="hg_scored" name="hg_scored" value="0">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOneD()">+1</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOneD()">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <script>
                        function plusOneE() {
                            document.getElementById('hg_missed').stepUp(1);
                        }

                        function minusOneE() {
                            document.getElementById('hg_missed').stepDown(1);
                            if (document.getElementById('hg_missed').value < 0) {
                                document.getElementById('hg_missed').value = 0;
                                alert("Nice try. You can't enter a negative number");
                            }
                        }
                    </script>
                    <label for="hg_missed">High Goals Missed</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="hg_missed" name="hg_missed" value="0">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOneE()">+1</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOneE()">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <script>
                        function plusOneJ() {
                            document.getElementById('hg_scored_launch_pad').stepUp(1);
                        }

                        function minusOneJ() {
                            document.getElementById('hg_scored_launch_pad').stepDown(1);
                            if (document.getElementById('hg_scored_launch_pad').value < 0) {
                                document.getElementById('hg_scored_launch_pad').value = 0;
                                alert("Nice try. You can't enter a negative number");
                            }
                        }
                    </script>
                    <label for="hg_scored_launch_pad">High Goals Scored Launch Pad</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="hg_scored_launch_pad" name="hg_scored_launch_pad" value="0">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOneJ()">+1</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOneJ()">-1</button>
                        </div>
                    </div>
                    <small class="form-text text-muted">This refers to any balls scored from one of the alliance launch pads</small>
                </div>
                <div class="form-group">
                    <script>
                        function plusOneK() {
                            document.getElementById('hg_missed_launch_pad').stepUp(1);
                        }

                        function minusOneK() {
                            document.getElementById('hg_missed_launch_pad').stepDown(1);
                            if (document.getElementById('hg_missed_launch_pad').value < 0) {
                                document.getElementById('hg_missed_launch_pad').value = 0;
                                alert("Nice try. You can't enter a negative number");
                            }
                        }
                    </script>
                    <label for="hg_missed">High Goals Missed Launch Pad</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="hg_missed_launch_pad" name="hg_missed_launch_pad" value="0">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOneK()">+1</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOneK()">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <script>
                        function plusOneF() {
                            document.getElementById('lg_scored').stepUp(1);
                        }

                        function minusOneF() {
                            document.getElementById('lg_scored').stepDown(1);
                            if (document.getElementById('lg_scored').value < 0) {
                                document.getElementById('lg_scored').value = 0;
                                alert("Nice try. You can't enter a negative number");
                            }
                        }
                    </script>
                    <label for="lg_scored">Low Goals Scored</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="lg_scored" name="lg_scored" value="0">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOneF()">+1</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOneF()">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <script>
                        function plusOneG() {
                            document.getElementById('lg_missed').stepUp(1);
                        }

                        function minusOneG() {
                            document.getElementById('lg_missed').stepDown(1);
                            if (document.getElementById('lg_missed').value < 0) {
                                document.getElementById('lg_missed').value = 0;
                                alert("Nice try. You can't enter a negative number");
                            }
                        }
                    </script>
                    <label for="lg_missed">Low Goals Missed</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="lg_missed" name="lg_missed" value="0">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOneG()">+1</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOneG()">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <script>
                        function plusOneH() {
                            document.getElementById('balls_dropped').stepUp(1);
                        }

                        function minusOneH() {
                            document.getElementById('balls_dropped').stepDown(1);
                            if (document.getElementById('balls_dropped').value < 0) {
                                document.getElementById('balls_dropped').value = 0;
                                alert("Nice try. You can't enter a negative number");
                            }
                        }
                    </script>
                    <label for="balls_dropped">Cargo Dropped</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="balls_dropped" name="balls_dropped" value="0">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOneH()">+1</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOneH()">-1</button>
                        </div>
                    </div>
                </div>
            <div class="tab-pane fade" id="pills-endgame" role="tabpanel" aria-labelledby="pills-endgame-tab">
                <div class="form-group">
                    <label for="climb">Climbing:</label>
                    <select class="custom-select mr-sm-2" name="climb" id="climb">
                        <option value="nothing">Did not climb</option>
                        <option value="low_rung">Low Rung</option>
                        <option value="mid_rung">Mid Rung</option>
                        <option value="high_rung">High Rung</option>
                        <option value="traversal_rung">Traversal Rung</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="drive_team" class="col-sm-2 col-form-label">Please rate the drive team performance:</label>
                    <input type="range" class="custom-range" value="1" min="1" max="10" id="drive_team" name="drive_team" onchange="updateTextBox(this.value);">
                    <script>
                        function updateTextBox(val) {
                            document.getElementById('driveteamtext').value = val;
                        }
                    </script>
                    <input type="text" class="form-control" id="driveteamtext" value="1" readonly>
                </div>
                <div class="form-group">
                    <label for="defense" class="col-sm-2 col-form-label">Did this team play defense this match?</label>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="defense1" name="defense" class="custom-control-input" value="1">
                        <label class="custom-control-label" for="defense1">Yes</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="defense2" name="defense" class="custom-control-input" value="0" checked>
                        <label class="custom-control-label" for="defense2">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="defense_comments">Comments on Defense:</label>
                    <textarea class="form-control" rows="3" name="defense_comments" id="defense_comments"></textarea>
                </div>
                <div class="form-group">
                    <label for="defense_rating" class="col-sm-2 col-form-label">Please rate how well they defended:</label>
                    <input type="range" class="custom-range" value="0" min="0" max="10" id="defense_rating" name="defense_rating" onchange="updateTextBox1(this.value);">
                    <script>
                        function updateTextBox1(val) {
                            document.getElementById('defensetext').value = val;
                        }
                    </script>
                    <input type="text" class="form-control" id="defensetext" value="0" readonly>
                    <small class="form-text text-muted">NOTE: If they didn't play defense, please leave this at 0.</small>
                </div>
                <div class="form-group">
                    <label for="intake_rating" class="col-sm-2 col-form-label">Please rate how well their ball intake was:</label>
                    <input type="range" class="custom-range" value="1" min="1" max="10" id="intake_rating" name="intake_rating" onchange="updateTextBox2(this.value);">
                    <script>
                        function updateTextBox2(val) {
                            document.getElementById('intaketext').value = val;
                        }
                    </script>
                    <input type="text" class="form-control" id="intaketext" value="1" readonly>
                    <small class="form-text text-muted">It might seem weird to be asking this, but Callahan really wants to know. It's part of a 4-D Chess play!</small>
                </div>
                <div class="form-group">
                    <label for="penalties">Penalties?</label>
                    <textarea class="form-control" rows="3" name="penalties" id="penalties"></textarea>
                </div>
                <div class="form-group">
                    <label for="comments">General Comments:</label>
                    <textarea class="form-control" rows="8" name="comments" id="comments"></textarea>
                </div>
                <button class="btn btn-success btn-block input-group-btn" type="submit" name="match-submit">Submit</button>
            </div>
        </div>
    </form>
</main>
<?php
require 'footer.php';
?>