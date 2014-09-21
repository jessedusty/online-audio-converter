<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Audio Conversion Results</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sticky-footer.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <div class="container">
      <div class="page-header">
        <h1>Conversion Results</h1>
      </div>
      <p class="lead">Extra Debugging Information - may take some time to process</p>
      <?php
        ob_end_flush();
        error_reporting(-1);
        set_time_limit(500);
        if ($_FILES["file"]["error"] > 0) {
          echo "Error: " . $_FILES["file"]["error"] . "<br>";
        } else {
          echo "Upload: " . $_FILES["file"]["name"] . "<br>";
          echo "Type: " . $_FILES["file"]["type"] . "<br>";
          echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
          echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br>";
          $a = uniqid();
          $b = $a . "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
          if (file_exists("upload/" . $b)) {
              echo $b . " already exists <br>";
            } else {
              move_uploaded_file($_FILES["file"]["tmp_name"],
              "upload/" . $b);
              echo "Stored in: " . "upload/" . $b . "<br>";
              
              echo "Doing Audio Conversion (" . "avconv -i /var/www/html/upload/" . $b . " /var/www/html/upload/". $a . ".wav" . " . , please wait...<br>";
              ob_end_flush();
              echo exec("avconv -i /var/www/html/upload/" . $b . " /var/www/html/upload/". $a . ".wav");
              echo "<hr><h1>Done</h1><br>Output: <a href=\"upload/" . $a . ".wav\">click here</a>";
              echo "<script>window.open(\"http://audioconv.littlebencreations.com/upload/". $a . ".wav\"); </script>";
              //echo "<script>window.location = \"http://audioconv.littlebencreations.com/upload/". $a . ".wav\"; </script>";
        }
        }
        ?> 
      <form>
  <input value="test">
  </form>
    </div>

    <div class="footer">
      <div class="container">
        <p class="text-muted">Created by Jesse Stevenson for HHS's Music Technology <a href="littlebencreations.com">littlebencreations.com</a> <a href="github.com/jessedusty">Jessedusty on GitHub</a></p>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>




