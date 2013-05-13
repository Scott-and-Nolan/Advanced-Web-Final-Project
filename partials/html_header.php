<?php
/*
    File Name: html_header.php
    Authors Name: Scott Montgomery and Nolan Knill
    Web Site Name: Survey Site
    File Description: This file contains the html header that is used on all desktop pages of the site.
*/  
echo '
<!DOCTYPE html>
<html class="no-js">
    <head>
       <title>'.$site_name.' - '.$page_name.'</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="keywords" content="Survey Ninja, Survey, Poll, Questionnaire, Custom Survey, Custom Poll, Question, Answer" />
        <meta name="description" content="Survey Ninja provides users with a survey creation site where they can poll people on any topic they want. Users can also come to the site and answer polls on their own." />
        <meta name="author" content="Scott and Nolan" />
        <meta name="location" content="Barrie, Ontario, Canada" />
        <meta name="coverage" content="worldwide" />
        <meta name="robots" content="index, follow" />
        <meta name="revisit-after" content="14 days" />
        <meta name="revised" content= "Scott and Nolan, 2013-05-13 12:24:23" />
        <meta name="geo.position" content= "-79.663917;44.367123"/>	
        <meta name="geo.placename" content= "Barrie, Ontario"/>
        <meta name="geo.region" content="CA-ON"/>
        <meta name="viewport" content="width=device-width">

	<link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/foundation.css">
	<link href="http://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet" type="text/css">

    </head>
';

