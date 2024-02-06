<?php
require 'header.php';
?>
<main>
    <?php
    $CompID = trim($_GET['CompID']);
    require 'includes/dbh.php';
    ?>
    <script>
        function plusOne(field_name) {
            document.getElementById(field_name).stepUp(1);
        }

        function minusOne(field_name) {
            document.getElementById(field_name).stepDown(1);
            if (document.getElementById(field_name).value < 0) {
                document.getElementById(field_name).value = 0;
                alert("Nice try. You can't enter a negative number");
            }
        }

        function updateTextBox(val, field_name) {
            document.getElementById(field_name).value = val;
        }
    </script>
    <h1 style="text-align:center">Match Scouting</h1>
    <form class="needs-validation" action="includes/match_submit.php?CompID=<?php echo $CompID; ?>" method="post" novalidate>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-basic-tab" data-bs-toggle="pill" data-bs-target="#pills-basic" type="button" role="tab" aria-controls="pills-basic" aria-selected="true">Basic Info</a>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-auto-tab" data-bs-toggle="pill" data-bs-target="#pills-auto" type="button" role="tab" aria-controls="pills-auto" aria-selected="false">Auto</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-teleop-tab" data-bs-toggle="pill" data-bs-target="#pills-teleop" type="button" role="tab" aria-controls="pills-teleop" aria-selected="false">Teleop</a>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-endgame-tab" data-bs-toggle="pill" data-bs-target="#pills-endgame" type="button" role="tab" aria-controls="pills-endgame" aria-selected="false">End Game</a>
            </li>
        </ul>
        <?php
        if (isset($_GET['submit'])) {
            if ($_GET['submit'] == "success") {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data submitted successfully! Thank you for scouting this match!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
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
                    <select class="form-select mr-sm-2" name="team" id="team">
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
                    <label for="auto_move" class="col-sm-2 col-form-label">Did they leave the starting zone?</label>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="auto_move1" name="auto_move" class="form-check-input" value="1">
                        <label class="form-check-label" for="auto_move1">Yes</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="auto_move2" name="auto_move" class="form-check-input" value="0" checked>
                        <label class="form-check-label" for="auto_move2">No</label>
                    </div>
                </div>
                <h2>Speaker</h2>
                <div class="form-group">
                    <label for="a_speaker_scored">Speaker Notes Scored</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="a_speaker_scored" name="a_speaker_scored" value="0">
                    <div class="row">
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOne('a_speaker_scored')">+1</button>
                        </div>
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOne('a_speaker_scored')">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="a_speaker_missed">Speaker Notes Missed</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="a_speaker_missed" name="a_speaker_missed" value="0">
                    <div class="row">
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOne('a_speaker_missed')">+1</button>
                        </div>
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOne('a_speaker_missed')">-1</button>
                        </div>
                    </div>
                </div>
                <h2>Amp</h2>
                <div class="form-group">
                    <label for="a_amp_scored">Amp Notes Scored</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="a_amp_scored" name="a_amp_scored" value="0">
                    <div class="row">
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOne('a_amp_scored')">+1</button>
                        </div>
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOne('a_amp_scored')">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="a_amp_missed">Amp Notes Missed</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="a_amp_missed" name="a_amp_missed" value="0">
                    <div class="row">
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOne('a_amp_missed')">+1</button>
                        </div>
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOne('a_amp_missed')">-1</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-teleop" role="tabpanel" aria-labelledby="pills-teleop-tab">
                <h2>Speaker</h2>
                <div class="form-group">
                    <label for="speaker_scored">Speaker Notes Scored</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="speaker_scored" name="speaker_scored" value="0">
                    <div class="row">
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOne('speaker_scored')">+1</button>
                        </div>
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOne('speaker_scored')">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="speaker_missed">Speaker Notes Missed</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="speaker_missed" name="speaker_missed" value="0">
                    <div class="row">
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOne('speaker_missed')">+1</button>
                        </div>
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOne('speaker_missed')">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="speaker_scored_protected">Speaker Notes Scored From Podium</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="speaker_scored_protected" name="speaker_scored_protected" value="0">
                    <div class="row">
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOne('speaker_scored_protected')">+1</button>
                        </div>
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOne('speaker_scored_protected')">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="speaker_missed_protected">Speaker Notes Missed From Podium</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="speaker_missed_protected" name="speaker_missed_protected" value="0">
                    <div class="row">
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOne('speaker_missed_protected')">+1</button>
                        </div>
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOne('speaker_missed_protected')">-1</button>
                        </div>
                    </div>
                </div>
                <h2>Amp</h2>
                <div class="form-group">
                    <label for="amp_scored">Amp Notes Scored</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="amp_scored" name="amp_scored" value="0">
                    <div class="row">
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOne('amp_scored')">+1</button>
                        </div>
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOne('amp_scored')">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="amp_missed">Amp Notes Missed</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="amp_missed" name="amp_missed" value="0">
                    <div class="row">
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOne('amp_missed')">+1</button>
                        </div>
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOne('amp_missed')">-1</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="notes_dropped">Notes Dropped</label>
                    <input type="number" class="form-control" pattern="[0-9]*" id="notes_dropped" name="notes_dropped" value="0">
                    <div class="row">
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="plusOne('notes_dropped')">+1</button>
                        </div>
                        <div class="d-grid gap-2 col">
                            <button type="button" class="btn btn-primary btn-block" onclick="minusOne('notes_dropped')">-1</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-endgame" role="tabpanel" aria-labelledby="pills-endgame-tab">
                <div class="form-group">
                    <label for="climb">Climbing:</label>
                    <select class="form-select mr-sm-2" name="climb" id="climb">
                        <option value="nothing">Not on Stage</option>
                        <option value="parked">Parked</option>
                        <option value="on_stage_alone">On Stage Alone</option>
                        <option value="on_stage_one_teammate">Harmony with One Teammate</option>
                        <option value="on_stage_alliance">Harmony with Entire Alliance</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="trap_note" class="col-sm-2 col-form-label">Did they score a note in the trap?</label>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="trap_note1" name="trap_note" class="form-check-input" value="1">
                        <label class="form-check-label" for="trap_note1">Yes</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="trap_note2" name="trap_note" class="form-check-input" value="0" checked>
                        <label class="form-check-label" for="trap_note2">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="drive_team" class="col-sm-2 col-form-label">Please rate the drive team performance:</label>
                    <input type="range" class="form-range" value="1" min="1" max="10" id="drive_team" name="drive_team" onchange="updateTextBox(this.value, 'driveteamtext');">
                    <input type="text" class="form-control" id="driveteamtext" value="1" readonly>
                </div>
                <div class="form-group">
                    <label for="defense" class="col-sm-2 col-form-label">Did this team play defense this match?</label>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="defense1" name="defense" class="form-check-input" value="1">
                        <label class="form-check-label" for="defense1">Yes</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="defense2" name="defense" class="form-check-input" value="0" checked>
                        <label class="form-check-label" for="defense2">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="defense_comments">Comments on Defense:</label>
                    <textarea class="form-control" rows="3" name="defense_comments" id="defense_comments"></textarea>
                </div>
                <div class="form-group">
                    <label for="defense_rating" class="col-sm-2 col-form-label">Please rate how well they defended:</label>
                    <input type="range" class="form-range" value="0" min="0" max="10" id="defense_rating" name="defense_rating" onchange="updateTextBox(this.value, 'defensetext');">
                    <input type="text" class="form-control" id="defensetext" value="0" readonly>
                    <small class="form-text text-muted">NOTE: If they didn't play defense, please leave this at 0.</small>
                </div>
                <div class="form-group">
                    <label for="intake_rating" class="col-sm-2 col-form-label">Please rate how effective their note intake was:</label>
                    <input type="range" class="form-range" value="1" min="1" max="10" id="intake_rating" name="intake_rating" onchange="updateTextBox(this.value, 'intaketext');">
                    <input type="text" class="form-control" id="intaketext" value="1" readonly>
                </div>
                <div class="form-group">
                    <label for="penalties">Penalties?</label>
                    <textarea class="form-control" rows="3" name="penalties" id="penalties"></textarea>
                </div>
                <div class="form-group">
                    <label for="comments">General Comments:</label>
                    <textarea class="form-control" rows="8" name="comments" id="comments"></textarea>
                </div>
                <br>
                <div class="d-grid gap-2">
                    <button class="btn btn-success btn-block input-group-btn" type="submit" name="match-submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</main>
<?php
require 'footer.php';
?>