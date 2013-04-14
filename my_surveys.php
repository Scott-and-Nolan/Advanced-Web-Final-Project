<!DOCTYPE html>
<!--
    File Name: my_surveys.php
    Authors Name: Scott Montgomery and Nolan Knill
    Web Site Name: Survey Site
    File Description: The page to list all of the surveys a user has created and show details for each one.
-->

<?php 
$page_name = "My Surveys";
include "functions/functions.php";
include 'partials/html_header.php'; 
//$logged_in_profile = get_profile();
$profile_id = 12;
$surveys = get_user_surveys($profile_id)
?>
  <body id="<?php echo strtolower($page_name);?>">

  <?php include 'partials/header.php'; ?>
  <h1>
    <? echo $page_name;?>
  </h1>

  <table>
    <tr>
      <th>Name</th>
      <th>Survey Type</th>
      <th>Number of Questions</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Email</th>
      <th>Submissions</th>
      <th>URL</th>
      <th>Edit</th>
      <th>Details</th>
    </tr>
  <?php foreach ($surveys as $survey): 
    $questions = get_questions($survey['id']);
  ?>
    <tr>
      <td>      
        <a href="survey.php?survey=<?php echo $survey['id']; ?>">
          <?php echo htmlentities($survey['name']) ?>
        </a>
      </td>
      <td>
        <?php echo $survey['survey_type'];?>
      </td>
      <td>
        <?php echo count($questions);?>
      </td>
       <td>
        <?php 
          if ($survey['start_date'] != ""){
            echo date('F d, Y', strtotime($survey['start_date']));
          }
        ?>
      </td>
      <td>
        <?php 
          if ($survey['end_date'] != ""){
            echo date('F d, Y', strtotime($survey['end_date']));
          }
        ?>
      </td> 
      <td>
        Link to email page
      </td>
      <td>
        <?php 
          echo get_submission_count($survey['id']);
        ?>
      </td> 
      <td>
      </td>
      <td>
      </td>
      <td>      
        <a href="details.php?survey=<?php echo $survey['id']; ?>">
          <?php echo htmlentities($survey['name']) ?>
        </a>
      </td>                             
    </tr>
  <?php endforeach; ?>

  </table>


  <?php include 'partials/footer.php'; ?>
  
  </body>
</html>