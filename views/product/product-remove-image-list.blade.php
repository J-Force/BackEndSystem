
@include('scripts.ajax-paging')
<style type="text/css">
	.thumbnail_img {
	    position: relative;
	    height: 300px;
	    overflow: hidden;
	}
	.button-select:hover, .button-select:focus{
		border: 1px solid #28c3ab;
		outline: 0;
		color: #000;
		background-color: #F1F1F1;
	}
</style>
	<div id="content">
			{{ $images->links() }}
	    <div class="row">
	    	@foreach($images as $image)
	        <div class="col-xs-3">
	        	<div class="thumbnail">
	        		<label for="{{ $image -> id }}" class="btn button-select">
			            <div class="thumbnail_img">
			            	
			                	<!-- <img src="avatar.jpg" alt="Sample Image"> -->
			                	{{ HTML::image($image -> link, $image -> id,array('width' => 360 , 'height' => 400)); }}
			            	
			            </div>
			            <div class="caption">
		                    <h3>ID: {{ $image -> id }}</h3>
		                    <p style="font-size:12px">{{ $image -> link }}</p>
		                    <p>
		                    	<label for="{{ $image -> id }}" class="btn btn-success">
		                    		<input id="{{ $image -> id }}" type="checkbox" name="image[]" value="{{ $image -> id }}"/> 
		                    		Select
		                    	</label>
		                    <a href="/jf-shop{{ $image -> link }}" class="btn btn-primary">Full Size</a> 
		                    </p>
			            </div>
		            </label>
		        </div>
	        </div>
	        @endforeach
	    </div>
	    <div style="float:right">{{ $images->links() }}</div>
	</div>

	
		    
