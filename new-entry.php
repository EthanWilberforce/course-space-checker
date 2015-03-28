<?php
  $name = strtoupper(trim($_REQUEST['name']));
  $number = strtoupper(trim($_REQUEST['number']));
  $section = strtoupper(trim($_REQUEST['section']));
  $email_num = trim($_REQUEST['emailnum']);
  $term = strtoupper(trim($_REQUEST['term']));

  if ($term === "W"){
    $year = "2014";
  } else {
    $year = "2015";
  }


  //if (!filter_var($email_num0, FILTER_VALIDATE_EMAIL) === false){
    //$email_num = $email_num0;
  //} else {
    //$email_num = preg_replace("/[^0-9]/", "", $email_num0);
  //}


  $inv ="The requested section is either no longer offered at UBC Vancouver or is not being offered this session.";

  //make url
  $url = "https://courses.students.ubc.ca/cs/main?sessyr=" . $year . "&sesscd=" . $term . "&" . "pname=subjarea&tname=subjareas&req=5&dept=" . $name . "&course=" . $number . "&section=" . $section;
  $html = file_get_contents($url);

  fwrite(fopen("test","x+"), (!filter_var($email_num, FILTER_VALIDATE_EMAIL) === false) . preg_match("/^[0-9]{10}$/", $email_num));

  //&& ((!filter_var($email_num, FILTER_VALIDATE_EMAIL) === false) || preg_match("/^[0-9]{10}$/", $email_num))
  //preg_match("/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/",$email_num0);

  if (strpos($html, $inv) !== false){
    header("Location: http://ethanw.ca/projects/ubc-space-scraper/failed.html");
  } elseif (!empty($_POST['name'])
      && !empty($_POST['number'])
      && !empty($_POST['section'])
      && !empty($_POST['emailnum'])
      && ((!filter_var($email_num, FILTER_VALIDATE_EMAIL) === false) || (preg_match("/^[0-9]{10}$/", $email_num)))
      && preg_match("/^[A-Z]{2,4}$/",$name)
      && preg_match("/^\d{3}[A-Z]?$/",$number)
      && preg_match("/^([A-Z]|\d){3}$/",$section)){

    //open files and write
    $contacts_file = fopen("contacts","a+");
    $url_file = fopen("urls","a+");
    $courses_file = fopen("courses","a+");
    fwrite($contacts_file, $email_num . "\n");
    fwrite($url_file, $url . "\n");
    fwrite($courses_file, $name . " " . $number . " " . $section . "\n");
    header("Location: http://ethanw.ca/projects/ubc-space-scraper/completed.html");
  } else {
    header("Location: http://ethanw.ca/projects/ubc-space-scraper/failed.html");
  }
?>
