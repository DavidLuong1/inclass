<?php
/**
 * @author   David Luong (ISTE-341)
 * @about    LIB class that contains reusable functions (for displaying common page header, and footer)
 *
 * @purpose  To render common webpage components more easily by having the page files (index.php,
 *            cart.php, and admin.php) call the resuable functions in this file.
 */


/**
 * @description this method contains the front-end code for displaying the Site's global header
 */
function showPageHeader(){
echo
"<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, height=device-height, initial-scale=1.0'>
  <title>Cart</title>
  <link rel='stylesheet' type='text/css' href='assets/css/style.css'>
</head>
<body>
  <header>
    <ul>
      <li class='item'><a href='./index.php'>Home</a></li>
      <li class='item'><a href='./admin.php'>Admin</a></li>
      <li class='item'><a id='cart' onclick='showCart();'><i class='fa fa-shopping-cart'></i> Cart<span class='badge'>1</span></a></li>
    </ul>
  </header>
";
}

/**
 * @description this method contains the front-end code for displaying the Site's footer
 */
function showPageFooter(){
echo
"
  <footer>Copyright &copy; 2018</footer>

  <script src='https://code.jquery.com/jquery-latest.js'></script>
  <script src='assets/js/custom-jquery.js'></script>
  <script src='assets/js/form.js'></script>
</body>
</html>
";
}
?>
