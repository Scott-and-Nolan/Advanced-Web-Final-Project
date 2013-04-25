<?php 
/*
    File Name: survey.php
    Authors Name: Scott Montgomery and Nolan Knill
    Web Site Name: Survey Site
    File Description: The page that shows a survey and allows it to be filled in and submitted.
*/

$page_name = "Take Survey";

include "functions/functions.php";
include 'partials/html_header.php'; 

//Including this partial will set the value of the $survey_number, $survey, $survey_type and $questions
include 'partials/get_survey.php'; 

if (empty($survey)) :
  set_message("error", "There is no survey with the specified ID");
  header('Location: index.php');
  die;
endif; 

$start_date = strtotime($survey['start_date']);
$end_date = strtotime($survey['end_date']);
$now = strtotime(date('Y-m-d h:i:s'));

if ($end_date < $now) :
  set_message("error", "We're sorry, this survey is closed.");
  header('Location: index.php');
  die; 
elseif ($start_date > $now) :
  set_message("error", "This survey is not open yet. Please come back on: ". format_date($survey['start_date']));
  header('Location: index.php');
  die;
endif;

if (!empty($_POST)) :

  //$survey_number = $_POST['survey'];
  //Loop through each of the questions in the survey
  foreach ($questions as $question):

    if (empty($_POST['question_'. $question['id']])):
      $errors[] = "Please answer question: ". $question['text'];
      $field_errors[] = $question['id'];
    endif; //End the if statement to check if the answer to the question is blank 

  endforeach; // End the foreach to loop through each of the questions 

  //If there are no validation errors save the answers
  if (empty($errors)) :
    //Create a submission and assign the returned id to a variable
    $submission_id = add_submission($survey_number, $_SERVER['REMOTE_ADDR']);
    //Loop through each of the questions and save the corresponding answers
    foreach ($questions as $question): 
      $answer = $_POST['question_'. $question['id']];  
      add_submission_answer($survey_number, $question['id'], $answer, $submission_id); 
    endforeach; //end the foreach to loop through and save each answer for the survey.

    //Set message, redirect to the index page
    set_message("success", "Thanks for completing the survey.");
    header('Location: index.php');
    die;
  endif; //End the if statement to check if there were any errors on the form 

endif; //End of if statement that executes if the form has been submitted

?>
<body>
<?php include 'partials/header.php'; ?>
  <div class="row">
    <div class="large-9 columns" role="content">
      <h3>Survey: "<?php echo htmlentities($survey['name']); ?>"</h3>
      <?php include 'partials/messages.php'; ?>
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <ol>
          <?php 
          if (empty($questions)) { ?>
            <h4>There are no questions for this survey</h4> <?php
          } else {
            //Loop through each of the questions in the questions array
            foreach ($questions as $question): 
            ?>
              <li <?php echo check_field_errors($question['id'] ,$field_errors);?> >
                <?php echo htmlentities($question['text']) ?>
              </li>
              <?php                   
              $answers = get_answers($question['id']);
              $selected_value= '';
              
              if (isset($_POST['question_'. $question['id']])) :
                $selected_value = $_POST['question_'. $question['id']];
              endif; //End the if statement that checks if the post value of the current question has been set
              foreach ($answers as $answer):
                $selected = '';
                if ($answer['id'] == $selected_value): 
                  $selected = 'checked="checked"';
                endif; ?>
                <label>
                  <input type="radio" name="question_<?php echo $question['id'];?>" <?php echo $selected; ?>  value="<?php echo $answer['id']; ?>"><?php echo $answer['text'];?>
                </label>
              <?php 
              endforeach; //End the foreach that loops through each` answer
            endforeach; //End the foreach that loops through each question
            ?>
          </ol>
      <?php echo create_hidden_survey_id_field($survey['id']); ?>
      <input type="submit" value="Submit Survey" class="button">
      <?php } //End if statement to check if survey has questions ?>
      </form>
    </div>
    <?php include 'partials/sidebar.php' ?>
  </div>

  <?php include 'partials/footer.php'; ?>
  
  </body>
</html>
