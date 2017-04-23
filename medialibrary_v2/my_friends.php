<?php

require_once "config.php";

session_start();

$fullName = "";
$friendType = "global";

if($_SESSION['loggedIn'] != true) {
    header("Location: login.php");
}
else {
    if(!empty($_GET['friend_id'])) {
        $friendType = "friend";
        $friendList = [];
        $friendMediaList = [];
        $fullName = "";
        $friend_id = $_GET['friend_id'];
        $query = "SELECT * FROM person WHERE id = '$friend_id'";

        if($result = $connection->query($query))
        {
            if($result->num_rows == 1)
            {
                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                    $firstName = $row['firstName'];
                    $surName = $row['surName'];
                    $emailAddress = $row['emailAddress'];
                    $points = $row['points'];
                    $fullName = "Profiel: " . $firstName . ' ' . $surName;
                }

                $getAllFriendsQuery = "SELECT friend.* 
                                    FROM person_has_friend 
                                    LEFT JOIN person as friend ON person_has_friend.Person_id_friend = friend.id 
                                    WHERE person_has_friend.Person_id = '$friend_id'";
                $allMediaResult = $connection->query($getAllFriendsQuery);
                while ($row = $allMediaResult->fetch_assoc()) {
                    $friendList[] = $row;
                }

                $seenMediaItems = [];
                $getAllSeenMediaQuery = "SELECT media.* FROM person_has_media 
                                  LEFT JOIN person ON person_has_media.Person_id = person.id 
                                  RIGHT JOIN media ON person_has_media.Media_id = media.id 
                                  WHERE person_has_media.Person_id = '$friend_id' AND media.category = 'seen'";
                $allSeenMediaResult = $connection->query($getAllSeenMediaQuery);
                while ($row = $allSeenMediaResult->fetch_assoc()) {
                    $seenMediaItems[] = $row;
                }

                $currentPersonQuery = "SELECT * FROM person WHERE id='$friend_id'";
                $currentPersonPoints = "";
                $currentPersonResult = $connection->query($currentPersonQuery);
                while ($row = $currentPersonResult->fetch_assoc()) {
                    $currentPersonPoints = $row['points'];
                }
            }
            else
            {
                header("Location: login.php");
            }
        }
        else {
            header("Location: login.php");
        }
    }
    else {
        $fullName = "Welkom " . $_SESSION['userName'];
        $userId = $_SESSION['userId'];
        $friendList = [];
        $friendMediaList = [];
        $query = "SELECT * FROM person WHERE id = '$userId'";

        if($result = $connection->query($query))
        {
            if($result->num_rows == 1)
            {
                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                    $firstName = $row['firstName'];
                    $surName = $row['surName'];
                    $emailAddress = $row['emailAddress'];
                    $points = $row['points'];
                }
                $getAllFriendsQuery = "SELECT friend.* 
                                    FROM person_has_friend 
                                    LEFT JOIN person as friend ON person_has_friend.Person_id_friend = friend.id 
                                    WHERE person_has_friend.Person_id = '$userId'";
                $allMediaResult = $connection->query($getAllFriendsQuery);
                while ($row = $allMediaResult->fetch_assoc()) {
                    $friendList[] = $row;
                }

                $friendMediaList = [];
                $friendIdList = [];
                foreach($friendList as $friend) {
                    $friendIdList[] = $friend['id'];
                }
                for($i = 0; $i < count($friendIdList); $i++) {
                    $getFriendMedia = "SELECT media.* FROM person_has_media 
                                  LEFT JOIN person ON person_has_media.Person_id = person.id 
                                  RIGHT JOIN media ON person_has_media.Media_id = media.id 
                                  WHERE person_has_media.Person_id = '$friendIdList[$i]' LIMIT 20";
                    $result = $connection->query($getFriendMedia);
                    while ($row = $result->fetch_assoc()) {
                        $friendMediaList[] = $row;
                    }
                }
                $currentPersonQuery = "SELECT * FROM person WHERE id='$userId'";
                $currentPersonPoints = "";
                $currentPersonResult = $connection->query($currentPersonQuery);
                while ($row = $currentPersonResult->fetch_assoc()) {
                    $currentPersonPoints = $row['points'];
                }
            }
            else
            {
                header("Location: login.php");
            }
        }
        else {
            header("Location: login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Media Library</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="medialab.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        $( function() {

            $( "#datepicker_startdate" ).datepicker({
                onSelect: function() {
                    var minDate = $('#datepicker_startdate').datepicker('getDate');
                    $("#datepicker_enddate").datepicker("change", { minDate: minDate });
                }
            });

            $( "#datepicker_enddate" ).datepicker({
                onSelect: function() {
                    var maxDate = $('#datepicker_enddate').datepicker('getDate');
                    $("#datepicker_startdate").datepicker("change", { maxDate: maxDate });
                }
            });

            var array = ["2017-04-11","2017-04-12","2017-04-13", "2017-04-19", "2017-04-20", "2017-04-21", "2017-04-22", "2017-04-29", "2017-04-30", "2017-05-01"]
            $( "#calendarMonth" ).datepicker({
                numberOfMonths: 3,
                showButtonPanel: true,
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    return [ array.indexOf(string) == -1 ]
                }
            });
        });
    </script>
</head>
<body>

<section class="header">
    <div class="logo_small">
        <img src="images/logo_small.png" alt="logo">
    </div>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="my_profile.php">Profile</a></li>
                        <li class="active"><a href="my_friends.php">Friends</a></li>
                        <li><a href="stream.php">Stream</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </div>
    </nav>

    <div class="pageIntro">
        <div class="container">
            <div class="logo">
                <h1><?php echo $fullName ?></h1>
            </div>
        </div>
    </div>

</section>

<section class="contentBody">
    <div class="row contentBody-row no-margin no-padding">
        <div class="col-md-7 no-padding">
            <div class="row no-margin no-padding">
                <div class="booking_titles">
                    <h1 class="col-md-10">
                        <?php if($friendType == "global") { ?>
                            Recommended movies and series by friends
                        <?php } ?>
                        <?php if($friendType == "friend") { ?>
                            Movies and series added by <?= $firstName . ' ' . $surName ?>
                        <?php } ?>
                    </h1>
                </div>
            </div>
            <div class="row no-margin no-padding">
                <div class="booking_specifications">
                    <?php if($friendType == "global") { ?>
                    <?php foreach ($friendMediaList as $mediaItem) {
                        ?>
                        <div class="col-md-6 no-padding">
                            <h2><?= $mediaItem['name'] ?></h2>
                            <p><?= $mediaItem['description'] ?></p>
                        </div>
                    <?php } }?>
                    <?php if($friendType == "friend") { ?>
                        <?php foreach ($seenMediaItems as $mediaItem) {
                            ?>
                            <div class="col-md-6 no-padding">
                                <h2><?= $mediaItem['name'] ?></h2>
                                <p><?= $mediaItem['description'] ?></p>
                            </div>
                        <?php } }?>
                </div>
            </div>
        </div>
        <div class="col-md-5 no-padding">
            <div class="bookingSidebar">
                <h1 class="col-md-8 float-left">Friendlist</h1>
                <?php if($friendType == "global") {
                    ?>
                    <span class="col-md-4 float-left add-bucketlist-item">
                        <a href="add_friend.php">Add new friend</a>
                    </span>
                <?php
                }?>
                <div class="row">
                <?php foreach ($friendList as $friend) {
                    ?>
                    <div class="col-md-6 no-padding">
                        <h2><?= $friend['firstName'] . ' ' . $friend['surName'] ?></h2>
                        <p><?= $friend['emailAddress'] ?></p>
                        <a href="my_friends.php?friend_id=<?php echo $friend['id'] ?>">Link to page</a>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contentBody">
    <div class="row contentBody-row no-margin no-padding">
        <div class="col-md-7 no-padding">
            <div class="row no-margin no-padding">
                <div class="col-md-12" id="calendarMonth"></div>
            </div>
        </div>
        <div class="col-md-5 no-padding">
            <div class="eventSidebar">
                <h1>Unlock films en series</h1>
                <p>Films en series ontgrendel je na veel gebruik van de applicatie</p>
                <p>Huidige punten: <?php echo $points ?> / 200</p>
            </div>
        </div>
    </div>
</section>

<section class="informationHeader">
    <div class="container">
        <img align="center" class="blockCenter" src="images/reviewer1.png" alt="reviewer" />
        <p align="center" class="textCenter marginTop">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
</section>
<footer>
</footer>
</body>
</html>