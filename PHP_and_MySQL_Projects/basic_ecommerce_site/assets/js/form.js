/**
* @author David Luong (ISTE-341)
* @description Customized JS code for handling the Admin Form
*/

/**
 * Retrieves the admin form's input fields, and set them globally to be used in the following functions
 */
var userField = document.getElementById("user");
var passField = document.getElementById("pass");

/**
 * This function allows the user to view the password they entered.
 */
function showPassword(){
  passField.type==="password" ? passField.type="text" : passField.type="password";
}

/**
 * This function clears the default placeholder on the input field for username
 */
function clearDefaultUser(){
  if( userField.placeholder=='Enter your username' ){
    userField.placeholder='';
  }
}

/**
 * This function clears the default placeholder on the input field for password
 */
function clearDefaultPass(){
  if( passField.placeholder=='Enter your password' ){
    passField.placeholder='';
  }
}

/**
 * This function resets the default placeholder on the input field for username after the user clicks away from that field
 */
function resetUser(){
  if( userField.placeholder=='' ){
    userField.placeholder='Enter your username';
  }
}

/**
 * This function resets the default placeholder on the input field for password after the user clicks away from that field
 */
function resetPass(){
  if( passField.placeholder=='' ){
    passField.placeholder='Enter your password';
  }
}
