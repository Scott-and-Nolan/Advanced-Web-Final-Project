<!DOCTYPE html>
<!--
    File Name: add_questions.php
    Authors Name: Scott Montgomery and Nolan Knill
    Web Site Name: Survey Site
    File Description: The page that it displayed that allows the creator of a survey to add questions to it. 
-->

<?php 
$page_name = "Home";
$errors = array();
include "functions/functions.php";
include 'partials/html_header.php'; 


if (!empty($_POST)) {
  $survey_number = $_POST['survey'];
}
else if (!empty($_GET['survey'])) {
  $survey_number = $_GET['survey'];
}
else {
  header('Location: index.php');
  die;
}

$survey = get_survey($survey_number);
$survey_type = $survey['survey_type'];
$question_count = $survey['question_count'];

//Check if the survey already has questions associated with it and redirect if true
$questions = get_questions($survey['id']);
if (!empty($questions) ) {
  set_message("error", "Survey already has questions associated with it.");
  header('Location: index.php');
  die;
}



for ($i=1; $i <= $question_count; $i++){
  ${"question_". $i} = '';
}

// if the user submitted the form (with method="post")
if (!empty($_POST)) {
  //loop through each of the questions and check if blank
  for ($i=1; $i <= $question_count; $i++){
    if (empty($_POST['question_'.$i])) {
      $errors[] = "Question #". $i . " cannot be blank";
    }
  }
  //If there are no validation errors attempt to save the questions to the database
  if (empty($errors)) {

    //loop through each of the questions and save to the database.
    for ($i=1; $i <= $question_count; $i++) {
      //Assign the question variable the current counter variable question
      $question = $_POST['question_'. $i];
      //Call the add question function
      $question_number = add_question($survey_number, $question, $survey_type);
      //Loop through each of the answers and save each to the database 
      foreach(range('A','D') as $d) {
        //Assign the answer variable the current answer 
        $answer = $_POST['question_'. $i . '_answer_'. $d];
        //Call the add answer function
        add_answer($question_number, $answer);
      }       
    }
    header('Location: survey.php?survey='.$survey_number);    
  }
  else {
    //There is an error on the page. Maintain sticky variables.
    //Loop through each question and save the post value to a variable
    for ($i=1; $i <= $question_count; $i++){
      ${"question_". $i} = $_POST['question_'.$i];
    }
  }    
}



?>
  <body id="<?php echo strtolower($page_name);?>">

  <?php include 'partials/header.php'; ?>

  <h1>Adding Questions for Survey: <? echo $survey['name']; ?> </h1>

  <?php include 'partials/messages.php'; ?>

  <p>This is a <? echo $survey_type; ?> survey.</p>


  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">


    <?php 
    //Loop through each of the questions until the question count is reached
    for ($i=1; $i <= $question_count; $i++):
        //Use the create_question to create a textbox for the current question
        echo create_question($i, ${"question_". $i} );
        //If the survey type is multiple choice then loop through A-D
        if ($survey_type == 'Multiple Choice') :
          foreach(range('A','D') as $d) : ?>
            <br/>
            Answer <? echo $d;?>:<br/>
            <input type="text" name="question_<?php echo $i;?>_answer_<?php echo $d;?>" value=""/>       
          <?php endforeach;
        endif;
    endfor; ?>
    
    <?php echo create_hidden_survey_id_field($survey['id']); ?>
    <br>
    <input type="submit" value="Submit"/>

  </form>  

  <?php include 'partials/footer.php'; ?>
  
  </body>
</html>