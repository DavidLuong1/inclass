<?php
include './LIB_project1.php'; //include the LIB file
include './DB.class.php'; //include the database file
$db = new DB(); //create new database class object

showPageHeader();
// showCart();
$db->showItemsInCart();
echo
"
  <div id='shopCart'>
  <!--Your cart is empty.<br/><br/><hr>-->
    <ul class='shopping-cart-container'>
      <li class='clearfix'>
        <img src=\"assets/images/20.jpg\" alt=\"item20\" class='sample' />
        <span class='item-name'>Harry Potter and the Black King</span>
        <span class='item-price'>$7.95</span>
        <span class='item-quantity'>Quantity: 1</span>
      </li>
    </ul><br/><br/><hr>
    <a class='btn btn-danger' href='#'><i class='fa fa-trash-o fa-lg'></i> Empty Cart</a>
  </div>
";
showPageFooter();
?>
