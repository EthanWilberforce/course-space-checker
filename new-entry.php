<?php
  $name = strtoupper(trim($_REQUEST['name']));
  $number = strtoupper(trim($_REQUEST['number']));
  $section = strtoupper(trim($_REQUEST['section']));
  $email = trim($_REQUEST['email']);
  $inv ="The requested section is either no longer offered at UBC Vancouver or is not being offered this session.";

  //make url
  $url = "https://courses.students.ubc.ca/cs/main?pname=subjarea&tname=subjareas&req=5&dept=" . $name . "&course=" . $number . "&section=" . $section;
  $html = file_get_contents($url);

  if (strpos($html, $inv) !== false){
    header("Location: http://ethanw.ca/projects/ubc-space-scraper/failed.html");
  } elseif (!empty($_GET['name'])
      && !empty($_GET['number'])
      && !empty($_GET['section'])
      && !empty($_GET['email'])
      && filter_var($email, FILTER_VALIDATE_EMAIL)
      && preg_match("/^[A-Z]{3,4}$/",$name)
      && preg_match("/^\d{3}[A-Z]?$/",$number)
      && preg_match("/^([A-Z]|\d){3}$/",$section)){

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
