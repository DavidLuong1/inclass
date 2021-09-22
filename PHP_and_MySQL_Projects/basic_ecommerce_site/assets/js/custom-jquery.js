/**
* @author David Luong (ISTE-341)
* @description Customized jQuery and AJAX request code
*/

$(document).ready(function(){
  //adjust the positioning of the shopping cart to a fixed position while scrolling down the page
  $('.shopping-cart').hide();

  $(window).on('scroll', function() {
    $('.shopping-cart').addClass('fixed');
  });

  //enable the 'Empty Cart' button
  $('.btn-danger').on('click',function(){
    $('#cart > .badge').text("0");
    $('.shopping-cart-container').replaceWith("<h4>Your cart is empty.</h4>");
    $('.shopping-cart-items').replaceWith("<h4>Your cart is empty.</h4>");
    $('.shopping-cart-header > .badge').text("0");
    $('.shopping-cart-total > span:last-child').text("0.00");
  });

  $.ajax({
    type: 'post',
    url:'./CartHandler.php',
    data:{
      products_in_carts:'cartproducts'
    },
    success:function(response){
      document.getElementById("cart").value = response;
    }
  });
});

function addToCart(id){
  var img = document.getElementsByClassName('sample')[0].src;
  var name = document.getElementsByClassName('item-name').value;
  var price = document.getElementsByClassName('item-price').value;
  var quantity = document.getElementsByClassName('item-quantity').value;

  $.ajax({
    type: 'post',
    url: './CartHandler.php',
    data:{
      product_img:img,
      product_name:name,
      product_price:price,
      product_quantity:quantity
    },
    success:function(response){
      document.getElementById("cart").value = response;
    }
  });
}

function showCart(){
  $.ajax({
    type: 'post',
    url: './CartHandler.php',
    data:{
      product_cart:"cart"
    },
    success:function(response){
      document.getElementsByClassName("shopping-cart").innerHTML = response;
      $(".shopping-cart").fadeToggle();
    }
  });
}


/**
 * AJAX that works, and should replace the code within the $(document).ready(function(...))
 */

 //Add to cart
 $('add_to_cart_button').click(function() {
  $.ajax({
    type: "POST",
    url: "./lib/ajax.php",
    data: {
      action: "addToCart",
      id: $(this).data("id"),
      quantity: 1
    },
    success: function(data) {
      location.reload();
    }
  });
});

   // function addToCart(data){
   //  if (typeof data==='number' && (data%1)===0) {
   //    console.log(data);
   //    $.ajax({
   //      type: "POST",
   //      url: "index.php",
   //      data: {'id':data},
   //      success:function(data){
   //        console.log(data);
   //      }
   //    });
   //  }
   // }

 	$('#selector').on('change',function(){
 		$.ajax({
 			type:"POST",
 			url: "admin.php",
 			data: {'id':this.value},
 			success: function(data){
 				data = JSON.parse(data);
 				$('#name').val(data.name);
 				$('#description').val(data.description);
 				$('#price').val(data.price);
 				$('#quantity').val(data.quantity);
 				$('#salePrice').val(data.sale);
 				$('#image').attr('src','data:image/gif;base64,' + data.image);
 			}
 		});

 	$('#next').on('click', function(){
 		nextPage();
 	});
 	$('#prev').on('click', function(){
 		prevPage();
 	});
 });

 function checkAdmin(){
 	var user = prompt('Please enter a username.');
 	var password = prompt('Please enter a password.');
 }

 function nextPage(){
 	var old = $('#next').val();
 	$.ajax({
 		type: "POST",
 		url: "index.php",
 		data: {'next' : old},
 		success:function(data){
 			if (data != "") {
 				$('#products').html(data);
 				$('#next').val(parseInt(old)+5);
 				$('#prev').val(parseInt(old)+5);
 				$('#next').on('click', function(){
 					nextPage();
 				});
 				$('#prev').on('click', function(){
 					prevPage();
 				});
 			}
 		}
 	});
 }

 function prevPage(){
 	var old = $('#next').val();
 	$.ajax({
 		type: "POST",
 		url: "index.php",
 		data: {'prev' : old},
 		success:function(data){
 			if (data != "") {
 				$('#products').html(data);
 				$('#next').val(parseInt(old)-5);
 				$('#prev').val(parseInt(old)-5);
 				$('#next').on('click', function(){
 					nextPage();
 				});
 				$('#prev').on('click', function(){
 					prevPage();
 				});
 			}
 		}
 	});
 }
