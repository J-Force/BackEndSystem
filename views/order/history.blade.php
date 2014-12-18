@extends('layout.newDefault')
@section('content')
@include('layout.newNav')
@include('layout.menu_admin')

<section id="bill-history" class="color-dark bg-white" style="margin-left:7%;width:50%">
			<div class="container margintop-50 marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="animatedParent">
							<div class="section-heading text-center animated bounceInDown">
								<h2 class="h-bold">Bill History</h2>
								<div class="divider-header"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
	            <table class="table table-hover">
		               <thead class="info">
		                  <th>Bill ID</th>
		                  <th>Create Date</th>
		                  <th>Status</th>
		               </thead>
	               <tbody>
	               @foreach($bills as $b)
	                  <tr>
	                     <td>
	                     	<h4>
	                           <a href="{{URL::route('payment-result-last',array($b->id))}}">
	                           ID: {{$b->id}}
	                           </a>
	                        </h4> 
	                     </td>
	                     <td>
	                        <p>{{$b->created_at}}</p>
	                     </td>
	                     @if($b->status == 0)
	                     	<td>Success to payment</td>
	                     @elseif($b->status == 1)
	                     	<td>Not payment yet..</td>
	                     @endif
	                  </tr>
	               @endforeach
	               </tbody>
	            </table>
         	</div>
      	</section>


@endsection