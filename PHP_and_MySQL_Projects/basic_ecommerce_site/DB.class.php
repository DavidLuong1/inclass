<?php
/**
 * @author  David Luong (ISTE-341)
 * @about   Database class that stores both catalog products, and products on sale
 *
 * @purpose To access the database's 'product' table, and render the eCommerce site
 *            through its dynamic data.
 */

class DB{
    //declare connection attribute
    private $connection;

/**
 * DB Class Constructor
 */
    function __construct(){
      //set up database connection using mysqli
      // $this->connection = new mysqli($_SERVER['DB_SERVER'],$_SERVER['DB_USER'],$_SERVER['DB_PASSWORD'],$_SERVER['DB']);
      $this->connection = new mysqli("localhost", "root", "");

      //Check for errors
      if( $this->connection->connect_error ){
        echo "Connection failed: ".mysqli_connect_error();  //display error message if connection fails...
        exit(); //...then exit the connection
      }
    } //end of constructor

/**
 * Display items added to cart
 */
    function showItemsInCart(){
      //create the array for storing selected products
      $data = array();

      //fetch through every product from the 'products' table
      if( $stmt = $this->connection->prepare("SELECT * FROM products ORDER BY ProductID") ){
        $stmt->execute();       //execute the prepared statement
        $stmt->store_result();  //store the results based on the parameters binded
        $stmt->bind_result($id, $name, $description, $price, $quantity, $imgName, $salePrice); //bind the results based on the parameters binded

        //for every existent row in the 'products' table...
        if( $stmt->num_rows > 0 ){
          //...fetch through each of them...
          while($stmt->fetch()){
            //...and store every attribute of each selected product in the array of selected products
            $data[] = array("productID"=>$id,
                            "productName"=>$name,
                            "description"=>$description,
                            "price"=>$price,
                            "quantity"=>$quantity,
                            "imageName"=>$imgName,
                            "salePrice"=>$salePrice
                      );
          } //end of while-loop

          //terminate executing before displaying the output
          $stmt->close();

          //display the shopping cart of items upon clicking the 'Cart' in the global page header
          echo
          "
  <div class='shopping-cart'>
    <div class='shopping-cart-header'>
      <i class='fa fa-shopping-cart cart-icon'></i><span class='badge'>".count($quantity)."</span>
      <div class='shopping-cart-total'>
        <span class='lighter-text'>Total:</span>
        <span class='main-color-text'>{$price}</span>  <!-- Total price -->
      </div>
    </div> <!--end shopping-cart-header -->
          ";
          if( count($quantity) == 0 ){
            echo"
              <br/>Your cart is empty.";
          } else {
            echo"
    <ul class='shopping-cart-items'>
      <li class='clearfix'>
        <img src=\"assets/images/{$imgName}.jpg\" alt=\"item{$id}\" class='sample' />
        <span class='item-name'>{$name}</span>
        <span class='item-price'>\${$price}</span>
        <span class='item-quantity'>Quantity: ".count($quantity)."</span>
      </li>
    </ul>

    <a href='cart.php' class='button'>Checkout</a>
  </div> <!--end shopping-cart -->
            ";
          } //end of if-else statement
        } //end of inner if-statement
      } //end of outer if-statement
    } //end of showItemsInCart() method

/**
 * Load products on sale
 */
    function displaySales(){
      //create the array for storing products on sale
      $data = array();

      //fetch through every product on sale from the 'products' table
      if( $stmt = $this->connection->prepare("SELECT * FROM products WHERE SalePrice!=0 ORDER BY ProductID") ){
        $stmt->execute();        //execute the prepared statement
        $stmt->store_result();   //store the results based on the parameters binded
        $stmt->bind_result($id, $name, $description, $price, $quantity, $imgName, $salePrice); //bind the results based on the parameters binded

        //for every existent row in the 'products' table...
        if( $stmt->num_rows > 0 ){
          //...fetch through each of them...
          while($stmt->fetch()){
            //...and store every attribute of each product on sale in the array of products-on-sale
            $data[] = array("productID"=>$id,
                            "productName"=>$name,
                            "description"=>$description,
                            "price"=>$price,
                            "quantity"=>$quantity,
                            "imageName"=>$imgName,
                            "salePrice"=>$salePrice
                      );
          } //end of while-loop
        } //end of if-statement
      } //end of outer if-statement

      //terminate executing before displaying the output
      $stmt->close();

      //return the array of products-on-sale
      return $data;
    } //end of displaySales() method

/**
 * Display entire Sales section
 */
    function displaySalesAsList(){
      //check whether page is set, or selected
      if( isset($_GET['page']) ){
        $page = $_GET['page'];
      }else{
        $page = 0;
      }

      //retrieve information about all products on sale using the displaySales() method above
      $data = $this->displaySales();

      //initialize the Sales section...
      $salesList = "";

      //...then count for each row in the data set, and append each sales products to the Sales section
      if( count($data)>0 ){
        $salesList .= "\t<h1>Sales</h1><hr><br/>";
        foreach( $data as $row ){
        $salesList.=
        "
        <div class='frame' id='{$row['imageName']}'>
          <div class='itemImg'>
            <img src=\"assets/images/{$row['imageName']}.jpg\" alt=\"{$row['productName']}\" class='salesImg' />
            <h3>{$row['productName']}</h3><br/>
          </div>
          <div class='about about-sales'>
            <p>{$row['description']}</p><br/>
            <p><em>Sale Price: </em><em>\${$row['salePrice']} </em>(Originally <span class='orgPrice'>\${$row['price']}</span>). Only <em>{$row['quantity']} left</em> !</p><br/>
            <form method='POST' action='index.php?page=$page' class='hidden'>
              <input type='hidden' name='ProductID' value='{$row['productID']}'>
              <input type='hidden' name='Price' value='{$row['salePrice']}'>
              <input type='hidden' name='Quantity' value='{$row['quantity']}'>
            </form>
            <a class='btn' onclick='addToCart({$row['imageName']})'><i class='fa fa-plus'></i> Add to Cart</a>
          </div>
        </div>";
        } // end of foreach loop
      } //end of if-statement

      //display the Sales section
      echo $salesList;
    } //end of displaySalesAsList() method

/**
 * Display entire Catalog section, and global pagination
 *
 * @description this method will display the catalog section with its relevant products
 *               dynamically based on the page they're on.
 */
    function displayCatalogAsList(){
      //load 5 catalog products per page
      $catProductsPerPage = 5;

      //check whether page is set, or selected
      if( isset($_GET['page']) ){
        $page = $_GET['page'];
      }else{
        $page = 0;
      }

      //check if the first page exists
      if( $page > 1 ){
        //set the starting page with the following arithmetic
        $start = ($page * $catProductsPerPage) - $catProductsPerPage;
      }else{
        $start = 0;  //otherwise, set the start to zero
      }

    /*
       @description $idSet fetches through every product on sale from the 'products' table
       @note PAGINATION didn't render when I used PREPARED STATEMENTS
    */
      // $idSet = $this->connection->prepare("SELECT ? FROM products WHERE SalePrice = 0");
      // $idSet->bind_param('i',$id);
      // $idSet->execute();
      // $idSet->get_result();
      $idSet = $this->connection->query("SELECT ProductID FROM products WHERE SalePrice = 0");

      //get total amount of catalog products
      $totalRows = $idSet->num_rows;

      //get the total pages
      $totalPages = $totalRows / $catProductsPerPage;

      //execute a prepare statement for rendering 5 catalog items per page
      if( $set = $this->connection->prepare("SELECT * FROM products WHERE SalePrice=0 ORDER BY ProductID LIMIT ?,?") ){
          $set->bind_param('ii',$start,$catProductsPerPage); //bind parameters for the offset and LIMIT
          $set->execute();                                   //execute the prepared statement
          $results = $set->get_result();                     //retrieve the results based on the parameters binded

          //display the Catalog section dynamically
          echo "<br/><br/><br/><br/>\n\t<h1>Catalog</h1><hr><br/>";

          //retrieve catalog products and their attributes by fetching through each row in the 'products' table
          while( $rows = $results->fetch_array(MYSQLI_ASSOC) ){
            $id = $rows['ProductID'];
            $name = $rows['ProductName'];
            $desc = $rows['Description'];
            $price = $rows['Price'];
            $quantity = $rows['Quantity'];
            $img = $rows['ImageName'];

            //display catalog products on webpage, and hidden form fields for manipulating each one
            echo
            "
            <div class='frame'>
              <div class='itemImg'>
                <img src=\"assets/images/$img.jpg\" alt=\"$name\" class='catalogImg' />
                <h3>$name</h3><br/>
              </div>
              <div class='about about-catalog'>
                <p>$desc</p><br/>
                <p><em>Price: \$$price</em> . Only <em>$quantity left</em> !</p><br/>
                <form method='POST' action='index.php?page=$page' class='hidden'>
                  <input type='hidden' name='ProductID' value='$id'>
                  <input type='hidden' name='Price' value='$price'>
                  <input type='hidden' name='Quantity' value='$quantity'>
                </form>
                <a class='btn' href='#'><i class='fa fa-plus'></i> Add to Cart</a>
              </div>
            </div>";
          } //end of while-loop
      } //end of if-statement

      //terminate executing before displaying the output
      $set->close();

      /**
       * create the PAGINATION section
       */
      echo "<div class='pagination'>";
          //generate the pagination links dynamically by the total page numbers
          for($i=1; $i<=$totalPages; $i++){
            if( $i==1 && $page>1 ){
              //display a link to go to the very first page on every other page within range, except the first page.
              echo "<a href='".htmlspecialchars($_SERVER['PHP_SELF'])."?page=".$i."'>&laquo;</a>";
            }
              echo "<a href='".htmlspecialchars($_SERVER['PHP_SELF'])."?page=".$i."'>".$i."</a>";
            if( $i==round($totalPages) && $page<round($totalPages) ){
              //display a link to go to the very last page on every other page within range, except the last page.
              echo "<a href='".htmlspecialchars($_SERVER['PHP_SELF'])."?page=".$i."'>&raquo;</a>";
            }
          } //end of for-loop
      echo "</div>";
    } //end of displayCatalogAsList() method
} //end of DB class
?>
