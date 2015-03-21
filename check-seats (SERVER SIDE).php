<?php
//Get Arrays of emails, urls, and course names from files
//$urls_read = fread(fopen("urls","r"), 34217728);
//$emails_read = fread(fopen("emails","r"), 34217728);
//$courses_read = fread(fopen("courses","r"), 34217728);
$urls = explode("\n", fread(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/urls","r"), 34217728));
$emails = explode("\n", fread(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/emails","r"), 34217728));
$courses = explode("\n", fread(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/courses","r"), 34217728));
unset($urls[sizeof($urls) - 1]);
unset($emails[sizeof($emails) - 1]);
unset($courses[sizeof($courses) - 1]);

$headers = "From: ubcsc@ethanw.ca" . "\r\n" ;
//Check through $urls array for classes with available spots
for ($x = 0; $x < sizeof($urls); $x++) {
  //get html contents
  $html = file_get_contents($urls[$x]);

  //get spots left
  $a = explode("Total Seats Remaining:</td><td align=left><strong>", $html);
  $b = explode("</strong>", $a[1])[0];
  $spots = intval($b);

  //Check if spots > 0
  if ($spots > 0){
    //send email saying space is available
    mail($emails[$x],
      $courses[$x] . " has seats available!",
      "Click the link to claim your seat.\n" . $urls[$x] . "\n\n\n" .
      "Do not reply to this email, this is an unatended mailbox.",
      $headers);

      $tot = explode("\n", fread(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/total","r"), 34217728));
      fwrite(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/total","w"),$tot[0] + 1);

    //unset elements from array
    unset($urls[$x]);
    unset($emails[$x]);
    unset($courses[$x]);

    //Delete and create new emails, courses, and course names files
    unlink("/var/www/ethanw.ca/projects/ubc-space-scraper/urls");
    unlink("/var/www/ethanw.ca/projects/ubc-space-scraper/emails");
    unlink("/var/www/ethanw.ca/projects/ubc-space-scraper/courses");
    $newurls = fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/urls","x+");
    $newemails = fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/emails","x+");
    $newcourses = fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/courses","x+");
    //Set file permissions
    chmod("/var/www/ethanw.ca/projects/ubc-space-scraper/urls", 0666);
    chmod("/var/www/ethanw.ca/projects/ubc-space-scraper/emails", 0666);
    chmod("/var/www/ethanw.ca/projects/ubc-space-scraper/courses", 0666);

    //Write unused data to files
    foreach ($urls as $url){
      if (!($urls[$x] == $url)){
        fwrite(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/urls","a+"), $url . "\n");
      }
    }
    foreach ($emails as $email){
      if (!($urls[$x] == $url)){
        fwrite(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/emails","a+"), $email . "\n");
      }
    }
    foreach ($courses as $course){
      if (!($urls[$x] == $url)){
        fwrite(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/courses","a+"), $course . "\n");
      }
    }
  }
}
?>
