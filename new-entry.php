<?php
  $name = strtoupper(trim($_REQUEST['name']));
  $number = strtoupper(trim($_REQUEST['number']));
  $section = strtoupper(trim($_REQUEST['section']));
  $email = trim($_REQUEST['email']);

  //make url
  $url = "https://courses.students.ubc.ca/cs/main?pname=subjarea&tname=subjareas&req=5&dept=" . $name . "&course=" . $number . "&section=" . $section;

  if (!empty($_GET['name'])
   && !empty($_GET['number'])
   && !empty($_GET['section'])
   && !empty($_GET['email'])
   && filter_var($email, FILTER_VALIDATE_EMAIL)
   && preg_match("/[A-Z][A-Z][A-Z][A-Z]?/",$name)
   && preg_match("/\d\d\d[A-Z]?/",$number)
   && preg_match("/([A-Z]|\d)([A-Z]|\d)([A-Z]|\d)/",$section)){

    //open files and write
    $email_file = fopen("emails","a+");
    $url_file = fopen("urls","a+");
    $courses_file = fopen("courses","a+");
    fwrite($email_file, $email . "\n");
    fwrite($url_file, $url . "\n");
    fwrite($courses_file, $name . " " . $number . " " . $section . "\n");
    header("Location: http://ethanw.ca/projects/ubc-space-scraper/completed.html");
  } else{
    header("Location: http://ethanw.ca/projects/ubc-space-scraper/failed.html");
  }
?>
