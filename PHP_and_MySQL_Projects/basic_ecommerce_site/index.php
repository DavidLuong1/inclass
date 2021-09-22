<?php
include './LIB_project1.php'; //include the LIB file
include './DB.class.php'; //include the database file
$db = new DB(); //create new database class object

showPageHeader(); //call this method from the LIB file to render the global page header
// showCart();
$db->showItemsInCart(); //call this method from the DB class to render shopping cart
echo
"
  <section id='list'>
";
    $db->displaySalesAsList(); //call this method from the DB class to render the SALE section
echo
"\n";
    $db->displayCatalogAsList(); //call this method from the DB class to render the SALE section
echo
"
  </section>
";
showPageFooter();
?>
