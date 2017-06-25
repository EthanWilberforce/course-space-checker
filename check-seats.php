<?php
$urls = explode("\n", fread(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/urls","r"), 34217728));
$emails_num = explode("\n", fread(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/contacts","r"), 34217728));
$courses = explode("\n", fread(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/courses","r"), 34217728));
unset($urls[sizeof($urls) - 1]);
unset($emails_num[sizeof($emails_num) - 1]);
unset($courses[sizeof($courses) - 1]);

$headers = "From: openseat@seat4.me" . "\r\n" ;
//Check through $urls array for classes with available spots
for ($x = 0; $x < sizeof($urls); $x++) {
  //get html contents
  $html = file_get_contents($urls[$x]);

  //get spots left
  $a = explode("Total Seats Remaining:</td><td align=&#39;left&#39;><strong>", $html);
  $b = explode("</strong>", $a[1])[0];
  $spots = intval($b);

  //Check if spots > 0
  if ($spots > 0){
    //if (!filter_var($emails_num[$x], FILTER_VALIDATE_EMAIL) === false){

      //send email saying space is available
    mail($emails_num[$x],
      $courses[$x] . " has seats available!",
      "Click the link to claim your seat.\n" . $urls[$x] . "\n\n\n" .
      "Do not reply to this email, this is an unatended mailbox.",
      $headers);

    //Comented out code below and if statement above are SMS implementations
    /*} else {
			require_once 'plivo.php';
      $auth_id = "MAMJA2NDA5MWNJOTKWYJ";
      $auth_token = "NWI3ZWU0MGIyNTc1NWQyODc1ZGM5Yzg4OTk2ZTdl";

      $p = new RestAPI($auth_id, $auth_token);

      // Send a message
      $params = array(
              'src' => '16044250969',
              'dst' => "1" . $emails_num[$x],
              'text' => 'There is space in ' . $courses[$x] . '. Hurry! Click here to claim your seat! ' . $urls[$x],
              'method' => 'POST'
          );
      // Send message
      $response = $p->send_message($params);
    }*/

    $tot = explode("\n", fread(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/total","r"), 34217728));
    fwrite(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/total","w"),$tot[0] + 1);

    //unset elements from array
    unset($urls[$x]);
    unset($emails_num[$x]);
    unset($courses[$x]);

    //Delete and create new emails, courses, and course names files
    unlink("/var/www/ethanw.ca/projects/ubc-space-scraper/urls");
    unlink("/var/www/ethanw.ca/projects/ubc-space-scraper/contacts");
    unlink("/var/www/ethanw.ca/projects/ubc-space-scraper/courses");
    $newurls = fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/urls","x+");
    $newcontacts = fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/contacts","x+");
    $newcourses = fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/courses","x+");
    //Set file permissions
    chmod("/var/www/ethanw.ca/projects/ubc-space-scraper/urls", 0666);
    chmod("/var/www/ethanw.ca/projects/ubc-space-scraper/contacts", 0666);
    chmod("/var/www/ethanw.ca/projects/ubc-space-scraper/courses", 0666);

    //Write unused data to files
    foreach ($urls as $url){
      if (!($urls[$x] == $url)){
        fwrite(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/urls","a+"), $url . "\n");
      }
    }
    foreach ($emails_num as $email_num){
      if (!($emails_num[$x] == $email_num)){
        fwrite(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/contacts","a+"), $email_num . "\n");
      }
    }
    foreach ($courses as $course){
      if (!($courses[$x] == $course)){
        fwrite(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/courses","a+"), $course . "\n");
      }
    }
  }
}
?>
