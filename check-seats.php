<?php
$urls = explode("\n", fread(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/urls","r"), 34217728));
$emails_num = explode("\n", fread(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/contacts","r"), 34217728));
$courses = explode("\n", fread(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/courses","r"), 34217728));
unset($urls[sizeof($urls) - 1]);
unset($emails_num[sizeof($emails_num) - 1]);
unset($courses[sizeof($courses) - 1]);

// Map of users to pushbullet api key. Emails not in this map will not receive messages.
$data = array();
$data["ethan.wilberforce@gmail.com"] = 'o.h7vQQXAcHfdejP7bhZdfjhsQa2069zga';
$data["kellyleacarleton@gmail.com"] = 'o.wbUfOlk75wfRXPp9C1ZwlmhuNvtpbMhd';

$headers = "From: openseat@seat4.me" . "\r\n" ;
//Check through $urls array for classes with available spots
for ($x = 0; $x < sizeof($urls); $x++) {
  //get html contents
  $html = file_get_contents($urls[$x]);

  //get spots left
  $a = explode("Total Seats Remaining:</td><td align=&#39;left&#39;><strong>", $html);
  $b = explode("</strong>", $a[1])[0];
  $spots = intval($b);

  if ($spots > 0){
    // send pushbullet if user is registered in the map
    if (!empty($data[$emails_num[$x]])) {
      $cmd = "./../../../../../../../../../../../../var/www/ethanw.ca/projects/ubc-space-scraper/sendPushbullet.sh " . $data[$emails_num[$x]] . ' "' . $courses[$x] . '" ' . $urls[$x] . ' > log';
      shell_exec($cmd);
    }

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
        fwrite(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/urls","a+"), $url . "\n");
    }
    foreach ($emails_num as $email_num){
        fwrite(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/contacts","a+"), $email_num . "\n");
    }
    foreach ($courses as $course){
        fwrite(fopen("/var/www/ethanw.ca/projects/ubc-space-scraper/courses","a+"), $course . "\n");
    }
  }
}
?>
