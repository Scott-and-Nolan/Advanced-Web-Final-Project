<?php
/*
    File Name: logged_in_nav.php 
    Authors Name: Scott Montgomery and Nolan Knill
    Web Site Name: Survey Site
    File Description: The navbar that a user will see if they are logged into the site.
*/ 
$logged_in_profile = get_user($_SESSION['id']);
?>

<ul id="links">
    <li>Logged in as: <?php echo $logged_in_profile['name']; ?></li>
    <li><a href="profile.php" id="profile">My Profile</a></li>
    <li><a href="my_surveys.php" id="mysurveys">My Surveys</a></li>
    <li><a href="create_survey.php" id="createsurvey">Create New Survey</a></li>
    <li><a href="logout.php" id="logout">Logout</a></li>
</ul>