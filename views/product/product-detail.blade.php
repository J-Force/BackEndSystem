@extends('layout.newDefault')
@section('content')
@include('layout.newNav')
<link href="/jf-shop/css/item-preview.css" rel='stylesheet' type='text/csss' />
<link href="/jf-shop/css/shop-item.css" rel="stylesheet">
<link rel="stylesheet" href="/jf-shop/css/etalage.css">
<script src="/jf-shop/js/jquery.etalage.min.js"></script>
<script type="text/javascript" src="/jf-shop/js/jquery.easy-ticker.js"></script>
<script type="text/javascript" src="/jf-shop/js/megamenu.js"></script>
@include('scripts.shop-cart')
<div class="container" style="margin-top:30px">
  	<div class="row">        
        <div class="col-md-12">
            <!--- start-content -->
            <div class="content details-page">
            <!-- Include the Etalage files -->
	            <script>
	                jQuery(document).ready(function($){
	                
	                   $('#etalage').etalage({
	                       thumb_image_width: 300,
	                       thumb_image_height: 400,
	                       source_image_width: 900,
	                       source_image_height: 1000,
	                       show_hint: true,
	                       click_callback: function(image_anchor, instance_id){
	                           alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
	                       }
	                   });
	                   // This is for the dropdown list example:
	                   $('.dropdownlist').change(function(){
	                       etalage_show( $(this).find('option:selected').attr('class') );
	                   });
	                
	                });
	            </script>
                <!-- details-product-slider -->
                <div class="details-left">
                    <div class="details-left-slider">
                        <ul id="etalage">
                        	<?php
                                $ids = ProductImage::where('product_id', '=' ,$product->id )->lists('image_id');
                                if(count($ids) == 0){
                                  $ids = array(0);
                                }
                                $images = Images::whereIn('id',$ids)->get();
                            ?>
					        @if($images->count() == 0)
					        	<li>
	                                <a href="#">
	                                <img class="etalage_thumb_image" src="/jf-shop/images/no-image.png" />
	                                <img class="etalage_source_image" src="/jf-shop/images/no-image.png" />
	                                </a>
	                            </li>
                            @endif
					        @foreach ($images as $image)
					        <li>
                                <a href="#">
                                <img class="etalage_thumb_image" src="/jf-shop/{{$image->link}}" />
                                
                                <img class="etalage_source_image" src="/jf-shop/{{$image->link}}" />
                                </a>
                            </li>
					               
					        @endforeach
					              
                          
                        </ul>
                    </div>
                    <div class="details-left-info">
                        <div class="details-right-head">
                            <h1>{{ $product->name }}</h1>
                            <label>Product ID : {{ $product->id }}</label>
                            <ul class="pro-rate">
                                <li>
                                    <?php
                                        $rates = Rate::where('product_id','=',$product->id)->get();
                                        $sum = 0;
                                        foreach($rates as $rate) {
                                            $sum += $rate->rate;
                                        }

                                        if($rates->count() > 0)
                                            $avg = ceil($sum / $rates->count());
                                        else
                                            $avg = $sum / 1;

                                        $left = 5 - ceil($avg);
                                    ?>
                                    <span class="rate_widget">
                                        @for($i = 0 ; $i < $avg ;$i++)
                                            <span class="star_{{$i}} ratings_voted" value="{{$i}}" id="{{ $product->id }}"></span>
                                        @endfor
                                        @for($j = 0 ; $j < $left ;$j++)
                                            <span class="star_{{$j}} ratings_stared" value="{{$j}}" id="{{ $product->id }}"></span>
                                        @endfor
                                    </span>
                                </li>
                                <li><a href="#"><h5><span class="count_{{ $product->id }}">{{ $reviews->count() }}</span> Review(s)</h5></a></li>
                            </ul>
         					<label style="font-size:20px">Size : {{ $product->size }}</label>
         					<br>
                            <p class="product-detail-info" style="font-size:20px">{{ $product->description }} </p>
                            <div class="product-more-details">
                            	<br>
                                <ul class="price-avl"> 
                                    @if($promotion->type==1)                        
                                        <label style="color:red;font-size:30px"><s>Price : <span class="ori_price_{{$product->id}}">{{ $product->price }}</span> baht</s></label>
                                        </br>
                                        <label style="color:green;font-size:40px">Price : <span class="price_{{$product->id}}">{{ $product->price - $promotion->value }}</span> baht</label>
                                    @elseif($promotion->type==2)                        
                                        <label style="color:red;font-size:30px"><s>Price : <span class="ori_price_{{$product->id}}">{{ $product->price }}</span> baht</s></label>
                                        </br>
                                        <label style="color:green;font-size:40px">Price : <span class="price_{{$product->id}}">{{ number_format($product->price * ((100 - $promotion->value) / 100 ),2) }}</span> baht</label>
                                    @else
                                        <label style="color:green;font-size:40px">Price : <span class="price_{{$product->id}}">{{ $product->price }}</span> baht</label>
                                    @endif
                              		</br>
                                    @if( $product->quantity > 0 )
                              		    <label style="font-size:20px;color:green">In Stock</label>
                                    @else
                                        <label style="font-size:20px;color:red">Out of Stock</label>
                                    @endif
                               
                                    <div class="clear"> </div>
                                </ul>
                            	<br>
                                <ul class="product-qty">
                                    <label>Quantity:</label>
                                    <select id="p-qty">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                  
                                	<input id="{{ $product->id }}" class="shop-cart" name="{{ $product->name }}" type="button" value="add to cart" />                                                       
                                </ul>
                                @if(Entrust::hasRole('Admin'))
                                    <a href="{{ URL::route('product-edit-view',array($product -> id)) }}" class="btn btn-primary">Edit Product</a>
                                    <a href="{{ URL::route('product-add-image',array($product -> id)) }}" class="btn btn-primary">Add Image</a>
                                    <a href="{{ URL::route('product-remove-image',array($product -> id)) }}" class="btn btn-danger">Remove Image</a>
                                    <!-- <a href="products/delete/{{$product->id}}" class="btn btn-danger" data-method="delete" data-confirm="Are you sure?">Remove</a> -->
                                    <!-- {{ Form::open(array('url' => 'products/delete','method' => 'delete')) }}
                                    {{ Form::token() }}
                                    {{ Form::hidden('id',$product->id) }}
                                    {{ Form::submit('DELETE PRODUCT',array('class'=>'btn-danger')) }}
                                    {{ Form::close() }} -->
                                    <br><br>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <div class="clear"> </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="well">
        <h1>Comment & Rate</h1>
        <div class="text-left comment"> 
            <textarea col="100" row="30" name="comment"></textarea>
        </div>
        <div class="col-md-12">
            <?php
                $count = 0;
                if(Auth::check()){
                    $user = Auth::user();
                    $rates = $rates = Rate::where('user_id','=',$user->id)
                                  ->where('product_id','=' , $product->id)->get();
                    $count = $rates->count();
                }
            ?>

            @if($count==0)
                @if(Auth::check())
                    <span class="rate_widget {{$user->id}}" >
                @else
                    <span class="rate_widget" >
                @endif
                        <span class="star_1 ratings_stars" value="1" id="{{ $product->id }}"></span>
                        <span class="star_2 ratings_stars" value="2" id="{{ $product->id }}"></span>
                        <span class="star_3 ratings_stars" value="3" id="{{ $product->id }}"></span>
                        <span class="star_4 ratings_stars" value="4" id="{{ $product->id }}"></span>
                        <span class="star_5 ratings_stars" value="5" id="{{ $product->id }}"></span>
                </span>
            @endif
            @if(Auth::check())
                <a class="btn btn-success send-comment pull-right" id="{{ $product->id }}" user-id="{{$user->id}}">Leave a Review</a>
            @else
               <a class="btn btn-success send-comment pull-right" id="{{ $product->id }}" >Leave a Review</a>
            @endif
        </div></br></br>
        
        <hr class="seperate">
        @foreach($reviews as $review)    
        <div class="row row_{{$review->id}}" >
            <div class="col-md-12">
                 <?php
                    $user = User::find($review->user_id);
                    $date_comment = date_create($review->updated_at);

                    $date_current = new DateTime();
                    $date_current = date_create($date_current->format('Y-m-d H:i:s'));

                    $comment = Comment::find($review->comment_id);
                    $interval = date_diff($date_current,$date_comment);
                    $rates = Rate::where('user_id','=',$user->id)
                                  ->where('product_id','=' , $review->product_id)->get();

                    $rate = 0;
                    foreach($rates as $r) {
                        $rate += $r->rate;
                    }
                    $rate_left = 5 - $rate;
                ?>
                <span class="rate_widget_{{ $review->id }}">
                @for($i = 0; $i < $rate ; $i++)
                    <span class="star_{{ $i }} ratings_voted" value="{{$i}}" id="{{ $review->product_id }}"></span>
                @endfor
                @for($i = 0; $i < $rate_left ; $i++)
                    <span class="star_{{ $i }} ratings_stared" value="{{$i}}" id="{{ $review->product_id }}"></span>
                @endfor
                </span>
                {{ $user->first_name.' '.$user->last_name }}
                <span class="pull-right">{{ $interval->format('%a days %h hours %i minutes %s seconds').' agos'; }}</span>
                <p class="{{$review->id}}">{{ $comment->text }}</p>
                @if(Auth::check())
                    @if(Auth::user()->id == $review->user_id)
                        <a class="btn btn-danger pull-right delete-comment" review-id="{{$review->id}}" product-id="{{$review->product_id}}">Delete</a>
                        <a class="btn btn-primary pull-right edit-comment" review-id="{{$review->id}}" product-id="{{$review->product_id}}">Edit</a> 
                    @endif  
                @endif 
            </div>
        </div>
        <hr class="end-seperate_{{$review->id}}">
        @endforeach
    </div>
</div>
@include('scripts.confirmRemove')
@include('scripts.comment')
@include('scripts.rate')
<style>
    textarea {
        width:100%;
        max-width: 1200px;
        height: 100%;
        max-height: 200px;
        padding: 10px 10px 10px 10px;
    }

    .rate_widget {
        overflow:   visible;
        padding:    10px;
        position:   relative;
        width:      256px;
        height:     32px;
    }
    .ratings_stars {
        background: url('/jf-shop/images/star_empty.png') no-repeat;
        float:      left;
        height:     22px;
        padding:    0px;
        width:      26px;
    }

    .ratings_stared {
        background: url('/jf-shop/images/star_empty.png') no-repeat;
        float:      left;
        height:     22px;
        padding:    0px;
        width:      26px;
    }
    .ratings_vote {
        background: url('/jf-shop/images/star_full.png') no-repeat;
    }

    .ratings_voted {
        background: url('/jf-shop/images/star_full.png') no-repeat;
        float:      left;
        height:     22px;
        padding:    0px;
        width:      26px;
    }

    .rate_widget .ratings_over {
        background: url('/jf-shop/images/star_highlight.png') no-repeat;
    }

</style>
@endsection