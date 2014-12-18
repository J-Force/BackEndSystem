@extends('layout.newDefault')
@section('content')

	@include('layout.newNav')
	<!-- Section: payment -->
		<section id="payment" class="color-dark bg-white">
			<div class="container margintop-50 marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="animatedParent">
							<div class="section-heading text-center animated bounceInDown">
								<h2 class="h-bold">PAYMENT</h2>
								<div class="divider-header"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="col-md-12">
					<h5 class="pull-left">Purchase Amount</h5>
					<h1 class="text-center" ><span id="amount_total" >{{$total_price}}</span></h1>
				</div>
				<h6>Billing Address</h1>
				<div class="thumbnail">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label for="First Name" class="col-sm-2 control-label">First Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="firstname" 
									placeholder="Enter First Name" value="{{$user->first_name}}">
							</div>
						</div>
						<div class="form-group">
							<label for="Last Name" class="col-sm-2 control-label">Last Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="lastname" 
									placeholder="Enter Last Name" value="{{$user->last_name}}">
							</div>
						</div>
						<div class="form-group">
							<label for="Address" class="col-sm-2 control-label">Address</label>
							<div class="col-sm-8">
								<textarea cols="60" rows="5" id="address"></textarea>
							</div>
							<label class="checkbox-inline">
							    <input type="radio" value="other" name="address">   Primary Address
							</label>
						</div>
						<div class="form-group">
							<label for="City" class="col-sm-2 control-label">City</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="city" 
									placeholder="Enter City">
							</div>
						</div>
						<div class="form-group">
							<label for="Zip Code" class="col-sm-2 control-label">Zip Code</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="zip" 
									placeholder="Enter Zip Code">
							</div>
						</div>
						<div class="form-group">
							<label for="Country" class="col-sm-2 control-label">Country</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="country" 
									placeholder="Enter Country">
							</div>
						</div>
						<div class="form-group">
							<label for="Email" class="col-sm-2 control-label">Email Address</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="email" 
									placeholder="Enter Email Adress" value="{{$user->email}}">
							</div>
						</div>
					</form>
				</div>
				<h6>Credit Card Information</h1>
				<div class="thumbnail">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="col-sm-2 control-label">Select card type</label>
							<div class="radio col-sm-10">
								<label class="checkbox-inline">
							    	<input type="radio" value="kupaypal" name="kupaypal">KUPayPal
								</label>
							</div>
						</div>
						<!-- <div class="form-group">
							<label for="Name on card" class="col-sm-2 control-label">Name on card</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nameOnCard" 
									placeholder="Enter Name">
							</div>
						</div>
						<div class="form-group">
							<label for="CreditNum" class="col-sm-2 control-label">Card Number</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="creditNum" 
									placeholder="Enter Credit card number">
							</div>
						</div>
						<div class="form-group">
							<label for="SecurityNum" class="col-sm-2 control-label">Security Number</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="securityNum">
							</div>
							<label>The 3 or 4 digit code on the back of your credit card</label>
						</div>
						<div class="form-group">
							<label for="SecurityNum" class="col-sm-2 control-label">Expiration Data</label>
							<div class="col-sm-1">

								<input type="text" class="form-control" id="monthExpire" placeholder="MM" size="1">
							</div>
							<div class="col-sm-1" style="width: 5px;">/</div>
							<div class="col-sm-1">
						
								<input type="text" class="form-control" id="yearExpire" placeholder="YY" size="1">
							</div>
						</div> -->
					</form>
				</div>

				<input type="button" name="pay" value="Pay Now" class="btn btn-warning btn-lg marginbot-50 btn-block">
	
			</div>
		</section>
		<script>
			$(function(){
				
				$('input[name="address"]').on("click",function(){
					
					$.get("/jf-shop/user/ajaxuser",{},function(res,status){
						var address = res.address;
						$("#address").val(address);
					});



				});

				$("input[name='pay']").on("click",function(){
					if($("input[name='kupaypal']:checked").val()) {
						var amount = parseFloat($('#amount_total').html().replace(",",""));
						if(amount > 0)
							createBillJF();
						else 
							alert("Can't Pay now , because your amount is less than or equal 0");
					}
				});


				function createBillJF() {

					$.ajax({
						url : "/jf-shop/user/payment/create",
						type: "POST",
						data: "",
						processData: false,
						headers: {
							"Content-Type":"application/json"
						},
						success: function(res, status,xhr) {
							var order_id = xhr.responseText;
							console.log(order_id);
							
								createPayment(order_id);
							
						}
					});				

				}	

				function createPayment(order_id) {

					var url = "http://128.199.212.108:8000/payment"
					var amount = parseFloat($('#amount_total').html().replace(",",""));

					var ValidJSON = JSON.stringify(
									{payment: 
										{merchant_email: "merchant@test.com",
										 order_id: order_id, 
										 amount: amount
										}
									},null,'\t');
					
					var date = getTimeAndDate();
					$.ajax({
						url : url,
						type: "POST",
						data: ValidJSON,
						processData: false,
						headers: {
							"Content-Type":"application/json"
						},

						success: function(res , status ,xhr) {
							var locate = xhr.getResponseHeader('Location');
							var redi = locate+"/accept";
							var bill_id = xhr.responseText;

							$.post("/jf-shop/user/payment/"+ bill_id + "/addURL" , {payment_url_callback:locate} ,
								function(res,data){
									if(res.fail) {
										window.location.href = "/jf-shop/user/sign_in";
									}
							});				
							
							
								location.href=redi;
							
						}
					});
				}

				  function getTimeAndDate(){
			        var d = new Date();
			        var year = d.getYear()+1900;
			        var month = d.getMonth()+1;

			        var day = d.getDate();

			        var hour = d.getHours();

			        var min = d.getMinutes();
			        var sec = d.getSeconds();
			        return  (day<10 ? '0' : '') + day+"/"+(month<10 ? '0' : '')+month+"/"+year+" "+ (hour<10 ? '0' : '') + hour+":"+ (min<10 ? '0' : '') + min+":"+ (sec<10 ? '0' : '') + sec;
   				  }
			});
		</script>

@endsection