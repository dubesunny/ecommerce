$(document).ready(function () {
    $('.addToCartBtn').click(function (e){
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty ').val();
        var prod_id = $(this).val();
        
        $.ajax({
            method:"POST",
            url: "handlecart.php",
            data:{
                "prod_id":prod_id,
                "prod_qty":qty,
                "scope":"add"

            },
            success: function (response){
                if(response == 201)
                {
                    alert("Product added to cart");
                }
                else if(response == 200)
                {
                    alert("Product already in cart.");
                }
                else if(response == 401)
                {
                    alert("Login to continue");
                }
                else if(response == 500)
                {
                    alert("Something went wrong.");
                }
            }

    });
    

});
$(".delete").click(function(){
    var cart_id = $(this).val();
   
      $.ajax({
        method:"POST",
        url: "handlecart.php",
        data:{
            "cart_id": cart_id,
            "scope": "remove"
        },
        success:function(response)
        {
            if(response == 200)
                {
                    alert("Successfully Deleted.");
                    $("#my-cart").load(location.href + " #my-cart");
                }
                else if(response == 200)
                {
                    alert("Something went wrong.");
                }

        }
     });
 });

 $(".updateqty").click(function(){
    var qty = $(this).closest('.product_data').find('.input-qty ').val();
    var prodId = $(this).closest('.product_data').find('.prodId ').val();

      $.ajax({
        method:"POST",
        url: "handlecart.php",
        data:{
            "prod_id": prodId,
            "prod_qty": qty,
            "scope": "update"
        },
        success: function(response){
          alert(response);
          $("#my-cart").load(location.href + " #my-cart");
       
        }
     });
 });
 
});

