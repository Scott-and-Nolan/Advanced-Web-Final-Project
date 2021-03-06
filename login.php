<?php
/*
    File Name: login.php
    Authors Name: Scott Montgomery and Nolan Knill
    Web Site Name: Survey Site
    File Description: The login page of the survey site.
*/
$page_name = "Login";
include "functions/functions.php";


$email = '';
$password = '';
$errors = array();

// if the user submitted the form (with method="post")
if (!empty($_POST)) :
  if (empty($_POST['email'])) :
    $errors[] = "Please enter your email address.";
  endif;
  if (empty($_POST['password'])) :
    $errors[] = "Please enter your password.";
  endif;

  $email = $_POST['email'];

  //If there are no validation errors attempt to validate the user
  if (empty($errors)) :
    //Search for the email in the database 
    $exists = check_user_exists ($_POST['email']);
    if ($exists) :
      $user_match = check_password_correct($_POST['email'], $_POST['password']);
      if ($user_match) : //log our homie in!
        $_SESSION['id'] = $user_match;
        set_message("success", "Welcome back :)");
        header('Location: index.php');
        die;
      else :
        $errors[] = "Invalid username/password combination";
      endif;
    else :
      $errors[] = "That user doesn't exist!";
    endif;
  endif;
endif;

include 'partials/html_header.php'; 
?>

  <body>

	  <?php include 'partials/header.php'; ?>
	  
	  <!-- Main Page Content and Sidebar -->
	  <div class="row">
	    <!-- Main Blog Content -->
	    <div class="large-9 columns" role="content">
	    	<h3>
	    		<?php echo $page_name;?>
	    	</h3>
	    	<?php include 'partials/messages.php'; ?>
	    	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	    		<label>E-mail: </label>
	    		<input type="text" name="email" value="<?php echo $email; ?>">
	    		<label>Password: </label>
	    		<input type="password" name="password">
	    		<input class="button" type="submit" value="Login">
	    	</form>
	    	<p>New user? <a href="register.php" id="register">Register Now</a> to create and manage surveys!</p>
	    </div>
	    <?php include 'partials/sidebar.php' ?>
	  </div>
	  
	  <?php include 'partials/footer.php'; ?>
  
  </body>
</html>