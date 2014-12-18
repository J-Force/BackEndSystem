@extends('layout.newDefault')
@section('content')

@include('layout.newNav')
      <section id="wishlist" class="color-dark bg-white">
         <div class="container margintop-50 marginbot-50">
            <div class="row">
               <div class="col-lg-8 col-lg-offset-2">
                  <div class="animatedParent">
                     <div class="section-heading text-center animated bounceInDown">
                        <h2 class="h-bold">Wishlist</h2>
                        <div class="divider-header"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container">
            <table class="table table-hover">
               <tr class="info">
               <thead>
                  <th>Item</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quanity</th>
                  <th>Total</th>
                  <th> </th>
               </thead>
               </tr>
               <tbody>
               		@foreach($wishlist as $wish)
               		<?php
			            $ids = ProductImage::where('product_id', '=' ,$wish->product_id )->lists('image_id');
			            if(count($ids) == 0){
			              $ids = array(0);
			            }
			            $images = Images::whereIn('id',$ids)->take(1)->get();
			          ?>
                  	<tr id="tr_{{$wish->product_id}}" class="tr">
                     <td class="wishlist-adjust-pic">
                        @if( $images->count() == 0)
                         <img style="width:150px; height:200px; "src="/jf-shop/images/no-image.png" alt>
                         @endif
                        @foreach($images as $image) 
                        <img style="width:150px; height:200px;"src="/jf-shop/{{ $image->link }}" alt>
                        @endforeach
                     </td>
                     <td>
                        <h5>
                           <a href>
                           {{$wish->product_name}}
                           </a>
                        </h5>
                     </td>
                     <td>{{$wish->product_price}}</td>
                     <td class="quantity_of_product">{{$wish->quantity}}</td>
                     <td >
                        <span class="total_of_price" >
                        {{ number_format($wish->product_price * $wish->quantity,2)}}
                        </span>
                        <h>
                        Baht.
                        <h>
                     </td>
                     <td><button type="button" id="{{$wish->product_id}}" class="btn btn-danger btn-xs remove-wish">x</button>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         <div class="container">
            <button type="button" class="btn btn-primary purchase">Purchase Now</button>
         </div>
         <br><br>
      </section>

<script>
$(function() {
   $(".remove-wish").click(function() {
      var product_id = $(this).attr("id");
      var cf = confirm('Do you want to delete this wishlish?');

      if(cf) {
         $.post("/jf-shop/user/wishlist/removeWishlist" , { product_id:product_id },

              function(res,status) {
               if( res.fail ) {
                  window.location.replace("http://128.199.212.108/jf-shop/user/sign_in");
               }

               $("#tr_"+product_id).remove();
         });
      }
   });

   $('.purchase').click(function() {
      var quantity = 0;
      var total = 0.0;

      $('.quantity_of_product').each(function(index){
         quantity += parseInt($(this).html());
      });

      $('.total_of_price').each(function(index){
         total += parseFloat($(this).html().replace(",",""));
      });

      $('.item-total').html( (quantity) + " item(s) ");
      $('.price-total').html(parseFloat(total).toFixed(2));

      $.post("/jf-shop/user/wishlist/addToCart",{},
         function(res,status){
            if(res.fail) {
               window.location.replace("http://128.199.212.108/jf-shop/user/sign_in");
            }
         $('.tr').remove();

      });
   });

});
</script>
@endsection