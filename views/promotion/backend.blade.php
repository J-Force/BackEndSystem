@extends('layout.newDefault')
@section('content')

	@include('layout.newNav')
	@include('layout.menu_admin')
	<div style="margin-left:100px">
	<section id="payment" class="color-dark bg-white">
			<div class="container margintop-50 marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="animatedParent">
							<div class="section-heading text-center animated bounceInDown">
								<h2 class="h-bold">Promotion BackEnd</h2>
								<div class="divider-header"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{Form::open(array('route'	=> 'add-promotion' , 'method' => 'post'))}}
			<div class="container">
				<div class="row"><b>Select promotion type</b></div>
				<div class="thumbnail row">
					<form class="form-horizontal" role="form">
						<div class="form-group text-center">
							<div class="col-md-6">
								<label class="checkbox-inline">
							    	<input input type="radio" name="type" value="1" checked="checked">Discount
								</label>
							</div>
							<div class="col-md-6">
								<label class="checkbox-inline">
							    	<input input type="radio" name="type" value="2">Percent
								</label>
							</div>
						</div>
					</form>
				</div>
				<div class="form-horizontal" role="form">
					<div class="form-group">
						<label for="Title" class="col-sm-2">Title</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nameOnCard" 
									name="title"
									placeholder="Enter Title">
							@if($errors->has('title'))
								<p class="imt">{{ $errors->first('title') }}</p>
							@endif
						</div>
					</div>
					<div class="form-group">
						<label for="Description" class="col-sm-2">Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="3" name="description" placeholder="Enter Description" required></textarea>
							@if($errors->has('description'))
								<p class="imt">{{ $errors->first('description') }}</p>
							@endif
						</div>
					</div>
					<div class="form-group">
			           <label class="col-sm-2">Expired Date</label>
			           <div class="col-lg-4">
			              <div class="row">
				                {{ Form::selectRange( 'day' , 1 , 31 , 1 , array(
						                  'class' => 'btn btn-default dropdown-toggle'
						                   )) }}
						        {{ Form::selectMonth( 'month' , null , array(
						                  'class' => 'btn btn-default dropdown-toggle'
						                   )) }}
						        {{ Form::selectRange( 'year' , 2015 , 1950 , 2015 , array(
						                  'class' => 'btn btn-default dropdown-toggle'
						                   )) }}
			            	</div>
              			</div>
        			</div>
        				<div class="form-group">
        					<label class="col-sm-2">Product list</label>
        					<div class="col-sm-10 thumbnail">
	        				<div class="form-group">
	        				<?php
	        					$products = Product::all();
	        				?>
					            <div class="col-sm-4">
					               <!--  <input type="text" class="form-control" name="product_id" placeholder="Product's ID"> -->
					               <select id="product" name="product" style="width:250px" class="btn btn-default dropdown-toggle">
					               @foreach($products as $p)
					               		<option value="{{$p->id}}">{{$p->name}}</option>
					               @endforeach
					               </select>
					            </div>

					            <div class="col-sm-4">
					                <input type="text" class="form-control" name="value" id="nameOnCard" placeholder="Value">
					            </div>
					            <a href="#" class="btn btn-info btn-lg col-sm-2 plus">
			          				<span class="glyphicon glyphicon-plus"></span> Plus 
			        			</a>
		        			</div>
							<div class="thumbnail" style="width:80%">
								<table  class="listview table table-bordered" style="width:100%">
								    <thead>
								    	<th>Product Name</th>
								    	<th>Value</th>
								    	<th>Type</th>
								    </thead>
								    <tbody>
								    	
								    </tbody>
								</table>
							</div>
						</div>
        				</div>
					</div>
					<div class="row">
					<button type="submit" id="finish" class="btn btn-success btn-lg marginbot-50 btn-block">FINISH</button>
				</div>
				</div>
			</div>
			{{Form::token()}}
			{{Form::close()}}
		</section>
		</div>
		<script>
			$(function(){

				$('.plus').click(function(e){
					e.preventDefault();
					

					var product = $('#product option:selected').text();
					var product_id = $('#product').val();

					var value = $("input[name='value']").val();

					if(value == '' || value <= 0 ) {
						alert('Please input the value');
						return;
					}

					var type = 1;
					if($('input[name=type]:checked').length > 0)
						type = $('input[name=type]:checked').val();



					$.post("/jf-shop/admin/promotions/products",{product_id:product_id,value:value,type:type},
						function(res,data,xhr){
							if(res.fail){
								window.location.href = "/jf-shop/user/sign_in";
							}
								var item = [
									"<tr>",
									"<td><a href='/jf-shop/products/show/" + product_id +"'>",
										"<div name='product_name' class='list-content'>",
											product,
										"</div>",
									"</a></td>",
									"<td name='value_promotion'>" + value + "</td>",
									"<td name='type_promotion'>" + type + "</td>",
									"</tr>"].join("");

								$('.listview').prepend(item);
								$("#product option[value='"+product_id+"']").remove();
							
						}).fail(function(res,data,xhr){
							if(res.status == 400) alert(res.responseText);
						});
				});
			});

		</script>
		<style>
			.imt {
				color: red;
			}
		</style>
@endsection