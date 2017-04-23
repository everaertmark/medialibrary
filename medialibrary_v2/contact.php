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
    <section class="header">
      <div class="logo_small">
        <img src="images/logo.png" alt="logo">
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
                      <li><a href="my_friends.php">Friends</a></li>
                      <li><a href="stream.php">Stream</a></li>
                      <li class="active"><a href="contact.php">Contact</a></li>
                  </ul>
              </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </div>
      </nav>
    </section>

    <section class="contentBody">
      <div class="row contentBody-row no-margin no-padding">
          <div class="col-md-10 no-padding">
            <div class="row no-margin no-padding">
              <div class="booking_titles">
                <h1 class="col-md-6">Contact Media Library</h1>
                <span class="col-md-4">Ask away</span>
              </div>
            </div>
            <div class="row no-margin no-padding">
              <div class="booking_description">
                <span>Informatie</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              </div>
            </div>
            <div class="row no-margin no-padding">
              <div class="booking_specifications">
                <div class="col-md-6 no-padding">
                  <span>Features</span>
                  <ul>
                    <li>Voorzien van synchronisatie</li>
                    <li>Bekijk profiel van je vrienden</li>
                    <li>Maak je eigen bucketlist</li>
                  </ul>
                </div>
                <div class="col-md-6 no-padding">
                  <span>Beoordeling</span>
                  <div class="review_amount">
                    <img src="images/review_stars.png" alt="review" /><br />
                    <a href="#">Lees alle reviews ></a>
                  </div>
                </div>
              </div>
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