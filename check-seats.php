<?php
$urls = explode("\n", fread(fopen("urls","r"), 34217728));
$emails_num = explode("\n", fread(fopen("contacts","r"), 34217728));
$courses = explode("\n", fread(fopen("courses","r"), 34217728));
unset($urls[sizeof($urls) - 1]);
unset($emails_num[sizeof($emails_num) - 1]);
unset($courses[sizeof($courses) - 1]);

// Map of users to pushbullet api key. Emails not in this map will not receive messages.
$data = array();
$data["ethan.wilberforce@gmail.com"] = 'o.h7vQQXAcHfdejP7bhZdfjhsQa2069zga';
$data["kellyleacarleton@gmail.com"] = 'o.wbUfOlk75wfRXPp9C1ZwlmhuNvtpbMhd';

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
      $cmd = "./sendPushbullet.sh " . $data[$emails_num[$x]] . ' "' . $courses[$x] . '" "' . $urls[$x] . '" > log';
      shell_exec($cmd);
    }

    $tot = explode("\n", fread(fopen("total","r"), 34217728));
    fwrite(fopen("total","w"),$tot[0] + 1);

    //unset elements from array
    unset($urls[$x]);
    unset($emails_num[$x]);
    unset($courses[$x]);

    //Delete and create new emails, courses, and course names files
    unlink("urls");
    unlink("contacts");
    unlink("courses");
    $newurls = fopen("urls","x+");
    $newcontacts = fopen("contacts","x+");
    $newcourses = fopen("courses","x+");
    //Set file permissions
    chmod("urls", 0666);
    chmod("contacts", 0666);
    chmod("courses", 0666);

    //Write unused data to files
    foreach ($urls as $url){
        fwrite(fopen("urls","a+"), $url . "\n");
    }
    foreach ($emails_num as $email_num){
        fwrite(fopen("contacts","a+"), $email_num . "\n");
    }
    foreach ($courses as $course){
        fwrite(fopen("courses","a+"), $course . "\n");
    }
  }
}
?>
