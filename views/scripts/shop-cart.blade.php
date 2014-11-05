
<script>
  $(function() {
    $("body").delegate(".shop-cart", "click", function(e) {
  
      e.preventDefault();
      $.post("/jf-shop/user/orders/add_cart", { product_id:$(this).attr("id") }, function(res) {
        

      });

        var quantity = parseInt($('.item-total').html());
        var total = parseFloat($('.price-total').html());
        $('.item-total').html( ( quantity + 1 )+ " item(s) ");

        total += parseFloat($( ('.price_')+$(this).attr("id") ).html());
        $('.price-total').html( parseFloat(total).toFixed(2) );


    });
  });

</script>
