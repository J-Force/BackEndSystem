@extends('layout.newDefault')
@section('content')
@include('layout.newNav')
@include('layout.menu_admin')

<section id="bill-detail" class="color-dark bg-white" style="margin-left:7%;width:90%" align="center">
			<div class="container margintop-50 marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="animatedParent">
							<div class="section-heading text-center animated bounceInDown">
								<h2 class="h-bold">Bill Detail</h2>
								<div class="divider-header"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
	            <div class="col-md-12">
					<h4>Bill ID: {{$bill->id}}</h4>
				</div>
				 <table class="table table-hover">
		               <thead class="info">
		                  <th>Picture</th>
		                  <th>Product Id</th>
		                  <th>Name</th>
		                  <th>Unit Price</th>
		                  <th>Quantity</th>
		                  <th>Total Price</th>
		               </thead>
	               	<tbody>
	               	@foreach($orders as $o)
	               		<tr>
	               		<?php
					            $ids = ProductImage::where('product_id', '=' ,$order->product_id )->lists('image_id');
					            if(count($ids) == 0){
					              $ids = array(0);
					            }
					            $images = Images::whereIn('id',$ids)->take(1)->get();
					        ?>
		        			<td>
		        			 	@if($images->count() == 0)
					              <img src="/jf-shop/images/no-image.png" alt="" width="150" height="200">
					            @endif
					            @foreach ($images as $image) 
					              <img src="/jf-shop/{{ $image->link }}" alt="" width="150" height="200">
					            @endforeach
	                     </td>
	                     <td>
	                        <p>{{$o->product_id}}</p>
	                     </td>
	                     <td>
	                        <h4>
	                           {{$o->product_name }}
	                        </h4>
	                    </td>
	                     <td>
	                     	{{ $o->price }}
	                        <h>
	                        Baht
	                        <h>
	                     </td>
	                     <td>
	                        {{ $o->quantity }}
	                     </td>
	                     <td>
	                     	{{$o->total_product_price}}
	                        <h>
	                        Baht
	                        <h>
	                     </td>
	                  </tr>
	                @endforeach
               		</tbody>
	            </table>
	            <div class="col-md-12 margintop-30">
					<h4 class="pull-left">Bill Total</h4>
					<h1 class="text-center" id="quantity"> {{$quantity}} <h> Units </h1>
					<h1 class="text-center" id="price"> {{number_format($total_price,2)}} <h> Baht</h1>
				</div>
			</div>
			
		</section>


@endsection