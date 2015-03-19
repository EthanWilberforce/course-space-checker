<html>
  <head>
    <title>Sucess!</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="stylesheets/grid.css"/>
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css"/>
  </head>
  <body>
    Thank you, we will email you when there is space available. <br>
    You probably need to mark ubcsc@ethanw.ca to your NOT spam list!
  </body>
</html>


<?php
  //make url
  $url = "https://courses.students.ubc.ca/cs/main?pname=subjarea&tname=subjareas&req=5&dept=" . $_REQUEST['name'] . "&course=" . $_REQUEST['number'] . "&section=" . $_REQUEST['section'];

  //if (!isset($_REQUEST['name'])
    // || !isset($_REQUEST['number'])
    // || !isset($_REQUEST['section'])
    // || !isset($_REQUEST['email'])){

    //open files and write
    $email_file = fopen("emails","a+");
    $url_file = fopen("urls","a+");
    $courses_file = fopen("courses","a+");
    fwrite($email_file, $_REQUEST['email'] . "\n");
    fwrite($url_file, $url . "\n");
    fwrite($courses_file, $_REQUEST['name'] . " " . $_REQUEST['number'] . " " . $_REQUEST['section'] . "\n");
  //}
  //header("Location: http://ethanw.ca/projects/ubc-space-scraper");
?>
