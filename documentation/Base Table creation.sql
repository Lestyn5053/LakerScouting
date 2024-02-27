CREATE TABLE Competition (
    ID INT AUTO_INCREMENT,
    CompName VARCHAR(50),
    Week INT,
    PRIMARY KEY (ID)
)

CREATE TABLE Robot (
    ID INT AUTO_INCREMENT,
    TeamName VARCHAR(100),
    PRIMARY KEY (ID)
)

CREATE TABLE RobotsAtComp (
    ID INT AUTO_INCREMENT,
    RobotID INT,
    CompID INT,
    PRIMARY KEY (ID),
    FOREIGN KEY (RobotID) REFERENCES Robot(ID),
    FOREIGN KEY (CompID) REFERENCES Competition(ID)
)

CREATE TABLE Users (
    ID INT AUTO_INCREMENT,
    UserName VARCHAR(50),
    Email VARCHAR(100),
    Pwd VARCHAR(2000),
    Role VARCHAR(50),
    PRIMARY KEY (ID)
)

/*Will need to be adjusted on an annual basis for new game*/
CREATE TABLE MatchStats (
    ID INT AUTO_INCREMENT,
    RobotID INT,
    CompID INT,
    MatchNum INT,
    ScoutName VARCHAR(50),
    StartingZone BOOLEAN,
    AutoSpeakerScored INT,
    AutoSpeakerMissed INT,
    AutoSpeakerAttempts INT,
    AutoAmpScored INT,
    AutoAmpMissed INT,
    AutoAmpAttempts INT,
    SpeakerScored INT,
    SpeakerMissed INT,
    SpeakerAttempts INT,
    PodiumSpeakerScored INT,
    PodiumSpeakerMissed INT,
    PodiumSpeakerAttempts INT,
    AmpScored INT,
    AmpMissed INT,
    AmpAttempts INT,
    NotesDropped INT,
    Climb VARCHAR(100),
    TrapNote BOOLEAN,
    DriveTeam INT,
    Defense BOOLEAN,
    DefenseComments VARCHAR(1000),
    DefenseRating INT,
    IntakeRating INT,
    Penalties VARCHAR(1000),
    Comments VARCHAR(1000),
    PRIMARY KEY (ID),
    FOREIGN KEY (RobotID) REFERENCES Robot(ID),
    FOREIGN KEY (CompID) REFERENCES Competition(ID)
    )