<?php
/*
    File Name: functions.php
    Authors Name: Scott Montgomery and Nolan Knill
    Web Site Name: Survey Site
    File Description: This file contains all of the php functions that are used throughout the site.
*/

session_start();

//Include the database connection file
require "db/database.php";
//Include the file with all of the functions relating to surveys
include "survey_functions.php";
//Include the file with all of the functions relating to users
include "user_functions.php";
//Include the locales file which contains all of the appropriate text variables
include "locales/en.php";


