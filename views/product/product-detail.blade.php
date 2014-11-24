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
					              
                          <!--   <li>
                                <a href="#">
                                <img class="etalage_thumb_image" src="/jf-shop/images/image1_thumb.jpg" />
                                <img class="etalage_source_image" src="/jf-shop/images/image1_large.jpg" />
                                </a>
                            </li> -->
                            <!-- <li>
                                <img class="etalage_thumb_image" src="/jf-shop/images/image2_thumb.jpg" />
                                <img class="etalage_source_image" src="/jf-shop/images/image2_large.jpg" />
                            </li>
                            <li>
                                <img class="etalage_thumb_image" src="/jf-shop/images/image3_thumb.jpg" />
                                <img class="etalage_source_image" src="/jf-shop/images/image3_large.jpg" />
                            </li>
                            <li>
                                <img class="etalage_thumb_image" src="/jf-shop/images/image4_thumb.jpg" />
                                <img class="etalage_source_image" src="/jf-shop/images/image4_large.jpg" />
                            </li>
                            <li>
                                <img class="etalage_thumb_image" src="/jf-shop/images/image5_thumb.jpg" />
                                <img class="etalage_source_image" src="/jf-shop/images/image5_large.jpg" />
                            </li>
                            <li>
                                <img class="etalage_thumb_image" src="/jf-shop/images/image6_thumb.jpg" />
                                <img class="etalage_source_image" src="/jf-shop/images/image6_large.jpg" />
                            </li>
                            <li>
                                <img class="etalage_thumb_image" src="/jf-shop/images/image7_thumb.jpg" />
                                <img class="etalage_source_image" src="/jf-shop/images/image7_large.jpg" />
                            </li> -->
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
                                            $avg = $sum / $rates->count();
                                        else
                                            $avg = $sum / 1;

                                        $left = 5 - $avg;
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
                                    <label style="color:green;font-size:40px">Price : <span class="price_{{$product->id}}">{{ $product->price }}</span> baht</label>
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
         <div class="col-md-12">
            <!-- description -->
            <div  class="thumbnail">
                <table class="detail">
                    <tbody>
                        <tr class="detail-head" style="color:white">
                            <td>ขนาด<br/>(Size)</td>
                            <td>ความยาว</td>
                            <td>ไหล่</td>
                            <td>อก</td>
                            <td>ชายเสื้อ</td>
                            <td>แขนยาว</td>
                            <td>ปลายแขน</td>
                            <td>วงแขน</td>
                        </tr>
                        <tr class="detail-body-1">
                            <td>S</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                        </tr>
                        <tr class="detail-body-2">
                            <td>M</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                        </tr>
                        <tr class="detail-body-1">
                            <td>L</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="well">
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
                ?>
                <span class="rate_widget_{{ $review->id }}">
                @for($i = 0; $i < $rate ; $i++)
                    <span class="star_{{ $i }} ratings_voted" value="{{$i}}" id="{{ $review->product_id }}"></span>
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