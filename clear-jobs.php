<?php
unlink("/var/www/ethw.ca/projects/ubc-space-scraper/urls");
unlink("/var/www/ethw.ca/projects/ubc-space-scraper/contacts");
unlink("/var/www/ethw.ca/projects/ubc-space-scraper/courses");
$newurls = fopen("/var/www/ethw.ca/projects/ubc-space-scraper/urls","x+");
$newemails = fopen("/var/www/ethw.ca/projects/ubc-space-scraper/contacts","x+");
$newcourses = fopen("/var/www/ethw.ca/projects/ubc-space-scraper/courses","x+");
//Set file permissions
chmod("/var/www/ethw.ca/projects/ubc-space-scraper/urls", 0666);
chmod("/var/www/ethw.ca/projects/ubc-space-scraper/contacts", 0666);
chmod("/var/www/ethw.ca/projects/ubc-space-scraper/courses", 0666);
?>
