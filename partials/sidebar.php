<?php
/*
    File Name: sidebar.php
    Authors Name: Scott Montgomery and Nolan Knill
    Web Site Name: Survey Ninja
    File Description: This partial contains the Featured Survey sidebar.
*/ ?>
<aside class="large-3 columns">
	<h5>
		Surveys
	</h5>
	<ul class="side-nav">
		<li><a href="list_surveys.php">View all Surveys</a></li>
		<li><a href="create_survey.php">Create a Survey</a></li>
	</ul>


<?php
$surveys = get_active_surveys();   
     
//Only show the sidebar if there is a survey in if 
if (!empty($surveys)) : 
  $survey = $surveys[array_rand($surveys)]; ?> 
      <div class="panel">
        <h5>Random</h5>
        <p><?php echo htmlentities($survey['name']);?></p>
        <a href="survey.php?survey=<?php echo $survey['id']; ?>">Take this survey</a>
      </div>
 <?php 
endif;?>
</aside><!-- End Sidebar -->    
