
<script>
    $("body").delegate(".shop-cart", "click", function(e) {
        
      var quantity = $('#p-qty').val();
      
      if(quantity === undefined ) {
        quantity = 1;
      } else {
        quantity = parseInt(quantity);
      }

      e.preventDefault();
      $.post("/jf-shop/user/orders/add_cart" , { product_id:$(this).attr("id") , quantity:quantity },

        function(res,status) {
         if( res.fail ) {
            window.location.replace("http://128.199.212.108/jf-shop/user/sign_in");
         }

      });

        $('#cart-dropdown').css( 'background-color' , '#ffbe56' );
        setTimeout( function() {
          $('#cart-dropdown').css( 'background-color' , '#40E0D0' );
        },1000);

        var q_ori = parseInt($('.item-total').html());
        var total = parseFloat($('.price-total').html());
        $('.item-total').html( ( quantity + q_ori )+ " item(s) ");

        total += parseFloat($( ('.price_')+$(this).attr("id") ).html()) * quantity;
        $('.price-total').html( parseFloat(total).toFixed(2) );


    });

</script>
