<?php
//get html contents
$html = file_get_contents("https://courses.students.ubc.ca/cs/main?pname=subjarea&tname=subjareas&req=5&dept=CPSC&course=110&section=202");

// get spots left
$a = explode("Total Seats Remaining:</td><td align=left><strong>", $html);
$b = explode("</strong>", $a[1])[0];
$spots = intval($b);

//if spots > 0, mail(), unset element from $emails and $urls, write to file
$email_file = fopen("emails","r+");
$url_file = fopen("urls","r+");

//write to file urls, content html
fwrite($urls, $html);
?>
