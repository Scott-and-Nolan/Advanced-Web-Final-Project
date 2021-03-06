<?php
/*
    File Name: list_surveys.php
    Authors Name: Scott Montgomery and Nolan Knill
    Web Site Name: Survey Site
    File Description: The page that lists all of the active surveys and allows the user to take them. 
*/

$page_name = "All Surveys";
include "functions/functions.php";
$surveys = get_active_surveys();
?>

<?php include 'partials/html_header.php'; ?>
<body>

	<?php include 'partials/header.php'; ?>
    <div class="row">
		<div class="large-9 columns" role="content">
  		
			<h3><?php echo $page_name;?></h3>
  			<?php include 'partials/messages.php'; ?>
			<?php 
      if (empty($surveys)) {?>
        <h3>There are currently no active surveys.</h4>
      <?php } else { ?>
        <h5>To take a survey, click a survey's name.</h5>
  			<table>
  				<tr>
  					<th>Name</th>
  					<th>Survey Type</th>
  					<th>Number of Questions</th>
  				</tr>
  				<?php 
  				foreach ($surveys as $survey): 
      				$questions = get_questions($survey['id']);
    				?>
      				<tr>
        					<td>      
          					<a href="survey.php?survey=<?php echo $survey['id']; ?>">
            						<?php echo htmlentities($survey['name']); ?>
  	   						</a>
  						</td>
  						<td>
  							<?php echo $survey['survey_type'];?>
  						</td>
  						<td>
  						<?php 
  						if (!empty($questions)) :
  							echo count($questions);
  						else: ?>                
  							<a href="add_questions.php?survey=<?php echo $survey['id']; ?>">
  								<?php echo count($questions); ?>
  							</a>          
  						<?php 
          				endif; //End the if statement to provide the url to add questions if the survey has no questions         
          				?>
        					</td>                         
  					</tr>
  				<?php endforeach; //End of the foreach to loop through each of the surveys ?>

  			</table>
      <?php } //End of if statement if there are surveys?>
		</div>
		<?php include 'partials/sidebar.php' ?>
	</div>
	
	<?php include 'partials/footer.php'; ?>

	</body>
</html>