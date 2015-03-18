<html>
  <body>
    Thank you, we will email you when there is space available. <br>
    You probably need to mark ubcsc@ethanw.ca to your NOT spam list!
  </body>
</html>

<?php
  //make url
  $url = "https://courses.students.ubc.ca/cs/main?pname=subjarea&tname=subjareas&req=5&dept=" . $_REQUEST['name'] . "&course=" . $_REQUEST['number'] . "&section=" . $_REQUEST['section'];

  //open files and write
  $email_file = fopen("emails","a+");
  $url_file = fopen("urls","a+");
  $courses_file = fopen("courses","a+");
  fwrite($email_file, $_REQUEST['email'] . "\n");
  fwrite($url_file, $url . "\n");
  fwrite($courses_file, $_REQUEST['name'] . " " . $_REQUEST['number'] . " " . $_REQUEST['section'] . "\n");
?>
