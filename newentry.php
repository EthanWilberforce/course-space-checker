<?php
  $url = "https://courses.students.ubc.ca/cs/main?pname=subjarea&tname=subjareas&req=5&dept=" . $_REQUEST['name'] . "&course=" . $_REQUEST['number'] . "&section=" . $_REQUEST['section'];
  $email_file = fopen("emails","a+");
  $url_file = fopen("urls","a+");
  fwrite($email_file, $_REQUEST['email'] . ",\n");
  fwrite($url_file, $url . ",\n");
?>
