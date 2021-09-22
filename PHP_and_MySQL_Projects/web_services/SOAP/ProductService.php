<?php
class ProductService{
  function __construct($products = array("Apples"=>3.99,"Peaches"=>4.05,"Pumpkin"=>13.99,"Pie"=>8.00)){
    $this->products = $products; //store the array of products as accessible attributes
  }

  /**
   * @return string[] $methodsList
   */
  function getMethods(){
     $methodsList = array("getMethods()","getPrice(\$product)","getProducts()","getCheapest()","getCostliest()");

     //returns a list of methods contained in the service
     return $methodsList;
  }

  /**
   * @param String $product
   * @return double $price
   */
  function getPrice($product){
     //returns a product price
     $price = $this->products[$product];
     return $price;
  }

  /**
   * @return string[] $productsList
   */
  function getProducts(){
     //returns a list of the known products
     return array_keys($this->products);
  }

  /**
   * @return String $cheapest
   */
  function getCheapest(){
     //returns the name of the least expensive product
     return array_keys($this->products, min($this->products));
  }

  /**
   * @return String $costliest
   */
  function getCostliest(){
     //returns the name of the most expensive product
     return array_keys($this->products, max($this->products));
  }

} //end of ProductService class
?>
