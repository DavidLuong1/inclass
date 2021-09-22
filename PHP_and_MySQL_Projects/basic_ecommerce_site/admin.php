<?php
include './LIB_project1.php'; //include the LIB file
include './DB.class.php'; //include the database file
$db = new DB(); //create new database class object

showPageHeader();
$db->showItemsInCart();
?>

  <form method='POST' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>'>
    <fieldset>
      <label for='user'>Username:</label>
      <input type='text' name='user' id='user' placeholder='Enter your username' onfocus='clearDefaultUser()' onblur='resetUser()' required><br/>
      <label for='pass'>Password:</label>
      <input type='password' name='pass' id='pass' placeholder='Enter your password' onfocus='clearDefaultPass()' onblur='resetPass()' required><br/>

      <label for='check'>
        <input type='checkbox' name='check' id='check' onclick='showPassword()'> Show Password
      </label>
    </fieldset>
    <input type='submit' name='submit' value='Submit'>
  </form>

<?php
showPageFooter();

/**
 * Form Validation & Sanitization
 */
  if( isset($_POST['submit']) ){
      if( (strlen($_POST['user']) == strlen($_GET['user'])) && (strlen($_POST['pass']) == strlen($_GET['pass'])) ){
        header("Location: admin.php?username=".sanitize($_POST['user'])."&password=".sanitize($_POST['pass']));
      }
  }

  //function for sanitizing the inputs for both username and password
  function sanitize($var) {
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
  }

/*
  Login Sessions

 session_name('loggedIn');
 session_start();

 //check if user has successfully logged in
 if( isset($_SESSION['loggedIn']) && isset($_POST['submit']) ){
   $_SESSION['loggedIn'] = true;
   header("Location: admin.php?username={$_GET['user']}&password={$_GET['pass']}");

   unset($_SESSION['loggedIn']);
   session_destroy();
 }

 //check if user has logged in before
 if( !empty($_SESSION['loggedIn']) && isset($_POST['submit']) ){
   header("Location: admin.php"); //refreshes this page
 } */
 // $db->validateLogin();

?>
