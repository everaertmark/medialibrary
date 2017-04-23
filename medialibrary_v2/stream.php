<?php
    $movieTitle = "";
    if(isset($_GET['unlocked'])) {
        require_once "config.php";
        session_start();
        $mediaId = $_GET['unlocked'];
        $userId = $_SESSION['userId'];

        $query = "SELECT * FROM media WHERE id = '$mediaId'";

        if($result = $connection->query($query)) {
            if ($result->num_rows == 1) {
                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                    $movieTitle = $row['name'];
                }
            }
        }

        $queryPerson = "UPDATE person SET points = 0 WHERE id = '$userId'";
        $connection->query($queryPerson);

        $queryMedia = "UPDATE media SET isUnlocked = 1 WHERE id = '$mediaId'";
        $connection->query($queryMedia);
        $queryMediaTwo = "UPDATE media SET category = 'seen' WHERE id = '$mediaId'";
        $connection->query($queryMediaTwo);
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
  </head>
  <body>
  <section class="header_stream">
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
                          <li><a href="my_friends.php">Friends</a></li>
                          <li class="active"><a href="stream.php">Stream</a></li>
                          <li><a href="contact.php">Contact</a></li>
                      </ul>
                  </div><!--/.nav-collapse -->
              </div><!--/.container-fluid -->
          </div>
      </nav>

      <div class="pageIntro">
          <div class="container">
              <div class="logo">
                  <img src="images/logo_medialibrary.png" alt="logo">
              </div>
              <div class="wikkelboatIntro">
                  <h1>A library full of Movies&Series.</h1>
                  <h2>Built to your preferences. And suit all your needs</h2>
              </div>
          </div>
      </div>


      <div class="bookingContainer">
        <div class="container">
            <div class="bookingForm">
              <div class="row gallery-row no-margin">
                <div class="col-md-2 bookingInformationText">
                    <h3>Mark Everaert</h3>
                    <h3>Sven de Ronde</h3>
                    <h4><?= $movieTitle ?></h4>
                </div>
                <div class="col-md-10 bookingFormColumn">
                    <video width="100%" controls>
                        <source src="intro.mp4" type="video/mp4" />
                    </video>
                </div>
            </div>
        </div>
      </div>
    </section>
    <div class="clearBoth"></div>
    <section class="informationHeader">
      <div class="container">
          <img align="center" class="blockCenter" src="images/reviewer1.png" alt="reviewer" />
          <p align="center" class="textCenter marginTop"><?= $movieTitle ?> is echt een hele gave film om te zien! Er zit ook onwijs veel humor in:)</p>
          <p align="center" class="textCenter marginTop">- Jan de Hoop -</p>
      </div>
    </section>
    <footer>
    </footer>
  </body>
</html>