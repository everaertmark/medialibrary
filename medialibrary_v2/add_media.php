<?php
require_once "config.php";

session_start();

$notifier_text_search = "";
$notifier_text = "";

if (isset($_POST['search-media']))
{
    if(!empty($_POST['search'])) {
        $searchQeury = $_POST['search'];

        // OMDB API
        $omdbUrl = "http://www.omdbapi.com/?t=" . $searchQeury . "";

        $curl = curl_init($omdbUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTPGET, true);

        $output =  json_decode(curl_exec($curl));

        curl_close($curl);
    }
    else {
        $notifier_text_search = "Fill in a query";
    }
}

if (isset($_POST['media-submit']))
{
    if(empty($_POST['title_of_media']) || empty($_POST['type_of_media']) || empty($_POST['desc_of_media'])) {
        $notifier_text = "Not all fields are filled in";
    }
    else {
        $title = $_POST['title_of_media'];
        $type = $_POST['type_of_media'];
        $description = $_POST['desc_of_media'];
        $category = "seen";
        $userId = $_SESSION['userId'];

        $description = str_replace("'","", $description);

        $query = "INSERT INTO media(type, name, description, category, isUnlocked) VALUES('".$type."','".$title."','".$description."','".$category."', 1)";

        $result = $connection->query($query);
        if($result)
        {
            $notifier_text = "This media item has been added to your 'seen' list";

            $mediaId = $connection->insert_id;
            $personHasMediaQuery = "INSERT INTO person_has_media(Person_id, Media_id, Rating) VALUES('".$_SESSION['userId']."','".$mediaId."', NULL)";
            $resultHasMediaQuery = $connection->query($personHasMediaQuery);

            if(!$resultHasMediaQuery) {
                var_dump($connection->error);
            }

            $currentPersonQuery = "SELECT * FROM person WHERE id='$userId'";
            $currentPersonPoints = "";
            $currentPersonResult = $connection->query($currentPersonQuery);
            while ($row = $currentPersonResult->fetch_assoc()) {
                $currentPersonPoints = $row['points'];
            }
            $currentPersonPoints = $currentPersonPoints + 20;
            $updateNewPersonPoints = "UPDATE person SET points = '$currentPersonPoints' WHERE id = '$userId'";
            $connection->query($updateNewPersonPoints);
        }
        else
        {
            $notifier_text = $connection->error;
        }
    }
}

?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Add Media</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="medialab.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript"></script>
    <script>
        $(function() {

            $('a.addMedia').on('click', function(e) {
                e.preventDefault();

                var mediaTitle = $('h2.mediaTitle').text();
                var mediaType = $('em.mediaType').text();
                var mediaDescription = $('p.mediaDesc').text();

                var inputTitleMedia = $('input.title_of_media');
                var inputTypeMedia = $('input.type_of_media');
                var textareaDescMedia = $('textarea.desc_of_media');

                inputTitleMedia.val(mediaTitle);
                inputTypeMedia.val(mediaType);
                textareaDescMedia.text(mediaDescription);
            })

        });
    </script>
    <style>
        body {
            padding-top: 10px;
        }
        .panel-login {
            border-color: #ccc;
            -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
            -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
            box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
        }
        .panel-login>.panel-heading {
            color: #00415d;
            background-color: #fff;
            border-color: #fff;
            text-align:center;
        }
        .panel-login>.panel-heading a{
            text-decoration: none;
            color: #666;
            font-weight: bold;
            font-size: 15px;
            -webkit-transition: all 0.1s linear;
            -moz-transition: all 0.1s linear;
            transition: all 0.1s linear;
        }
        .panel-login>.panel-heading a.active{
            color: #029f5b;
            font-size: 18px;
        }
        .panel-login>.panel-heading hr{
            margin-top: 10px;
            margin-bottom: 0px;
            clear: both;
            border: 0;
            height: 1px;
            background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
            background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
            background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
            background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        }
        .panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
            height: 45px;
            border: 1px solid #ddd;
            font-size: 16px;
            -webkit-transition: all 0.1s linear;
            -moz-transition: all 0.1s linear;
            transition: all 0.1s linear;
        }
        .panel-login input:hover,
        .panel-login input:focus {
            outline:none;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            border-color: #ccc;
        }
        .btn-login {
            background-color: #59B2E0;
            outline: none;
            color: #fff;
            font-size: 14px;
            height: auto;
            font-weight: normal;
            padding: 14px 0;
            text-transform: uppercase;
            border-color: #59B2E6;
        }
        .btn-login:hover,
        .btn-login:focus {
            color: #fff;
            background-color: #53A3CD;
            border-color: #53A3CD;
        }
        .forgot-password {
            text-decoration: underline;
            color: #888;
        }
        .forgot-password:hover,
        .forgot-password:focus {
            text-decoration: underline;
            color: #666;
        }

        .btn-register {
            background-color: #1CB94E;
            outline: none;
            color: #fff;
            font-size: 14px;
            height: auto;
            font-weight: normal;
            padding: 14px 0;
            text-transform: uppercase;
            border-color: #1CB94A;
        }
        .btn-register:hover,
        .btn-register:focus {
            color: #fff;
            background-color: #1CA347;
            border-color: #1CA347;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>Add new seen item</h1>
            <a class="back-button btn btn-login" href="my_profile.php">Back to profile</a>
            <div class="panel panel-login">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="" method="post" role="form" style="display: block;">
                                <p><?php echo $notifier_text_search ?></p>
                                <div class="form-group">
                                    <input type="text" name="search" id="username" tabindex="1" class="form-control" placeholder="Search movie or serie" value="">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="search-media" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Search media">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                if(isset($output)) {
                                ?>
                            <div class="mediaBox" style="background: ">
                                <h2 class="mediaTitle"><?= $output->Title ?></h2>
                                <img src="<?= $output->Poster ?>" alt="media" /><br />
                                <em class="mediaType"><?= $output->Type ?></em>
                                <p class="mediaDesc"><?= $output->Plot ?></p>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <a class="addMedia btn btn-login" href="">Add Media</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="" method="post" role="form" style="display: block;">
                                <p><?php echo $notifier_text ?></p>
                                <div class="form-group">
                                    <input class="form-control title_of_media" type="text" name="title_of_media" id="username" tabindex="1" placeholder="Title of media" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control type_of_media" type="hidden" name="type_of_media" id="username" tabindex="1" placeholder="Email Address" value="">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control desc_of_media" name="desc_of_media" id="username" tabindex="1" placeholder="Description of media"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="media-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Save media">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>