<!--
 @author  David Luong (ISTE-341)
 @purpose To ensure that the user has added their selected product(s) to the shopping cart

 @note    It was working before I added extra AJAX request code to the 'custom-jquery.js' file.
           For now, a product-placeholder is added to the shopping cart in that JS file and
           the 'empty cart' empties the cart on the 'cart.php' page, but does not update the
           cart for the other two pages (index.php, and admin.php).
-->

<?php
  //start a session
  session_start();

  if( isset($_POST['products_in_carts']) ){
    //print the total number of products in the shopping cart...
    echo count($_SESSION['product']);

    //...then terminate this session
    exit();
  } //end of if-statement

  if( isset($_POST['product_img']) ){

    $_SESSION['image'][] = $_POST['product_img'];
    $_SESSION['product'][] = $_POST['product_name'];
    $_SESSION['price'][] = $_POST['product_price'];
    $_SESSION['quantity'][] = $_POST['product_quantity'];

    echo count($_SESSION['product']);
    exit();
  } //end of if-statement

  if( isset($_POST['product_cart']) ){
    $cart_items = "";
    for($i=0; $i<count($_SESSION['image']); $i++){
      // $cart_items .=
      echo
      "
      <li class='clearfix'>
        <img src='".$_SESSION['image'][$i]."' alt='' />
        <span class='item-name'>".$_SESSION['product'][$i]."</span>
        <span class='item-price'>".$_SESSION['price'][$i]."</span>
        <span class='item-quantity'>".$_SESSION['quantity'][$i]."</span>
      </li>
      ";
    } //end of for-loop

    $html = file_get_contents('./index.php');
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML($html);
    $cart = $doc->getElementsByClassName('shopping-cart-items');
    $cart->appendChild($cart_items);
    echo $doc->saveHTML();

    exit();
  } //end of if-statement

?>
