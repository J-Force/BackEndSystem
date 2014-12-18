
<script>
    $("body").delegate(".add-wish", "click", function(e) {

     e.preventDefault();

     $.post("/jf-shop/user/wishlist/addWishlist" , 
        { product_id:$(this).attr("id") , quantity:1 },
        function(res,status) {
         if( res.fail ) {
            window.location.replace("http://128.199.212.108/jf-shop/user/sign_in");
         }
      });

        $('.wishlist a').css( 'color' , '#ffbe56' );
        setTimeout( function() {
          $('.wishlist a').css( 'color' , '#444' );
        },1000);

    });
</script>
