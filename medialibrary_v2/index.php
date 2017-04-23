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

      });
    </script>
  </head>
  <body>
    <section class="header">
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
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="my_profile.php">Profile</a></li>
                  <li><a href="my_friends.php">Friends</a></li>
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
                <div class="col-md-4 bookingInformationText">
                    <center><h2><a href="my_profile.php">Go to my movie list ></a></h2></center>
                </div>
                <div class="col-md-8 bookingFormColumn">
                    <center><h2><a href="my_friends.php">Go to recommended Movies & Series by friends ></a></h2></center>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>

    <section class="informationHeader">
      <div class="container">
          <h1 align="center" class="textCenter marginBottomLarge">A real streamservice experience!</h1>
          <p align="center" class="textCenter">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure <em class="extraRed">dolor in reprehenderit</em> in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </section>

    <section class="gallery">
        <div class="row gallery-row no-margin">
            <div class="col-md-4 no-padding">
                <img src="images/interstellar.jpg" alt="Wikkelboat prototype" />
            </div>
            <div class="col-md-4 no-padding">
                <img src="images/inception.png" alt="Wikkelboat prototype" />
            </div>
            <div class="col-md-4 no-padding">
                <img src="images/gladiator.jpg" alt="Wikkelboat prototype" />
            </div>
        </div>
    </section>

    <section class="informationHeader">
      <div class="container">
          <img align="center" class="blockCenter" src="images/loop.png" alt="loop" />
          <h1 align="center" class="textCenter">Top 250 Movies and Series!</h1>
          <p align="center" class="textCenter">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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