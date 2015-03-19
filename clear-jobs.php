<?php
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
?>
