
@include('scripts.ajax-paging')
<style type="text/css">
	.thumbnail_img {
	    position: relative;
	    height: 300px;
	    overflow: hidden;
	}
</style>
	
	<div id="content">
		{{ $images->links() }}
	    <div class="row">
	    	@foreach($images as $image)
	        <div class="col-xs-3">
	        	<div class="thumbnail">
		            <div class="thumbnail_img">
		            	<a href="/jf-shop{{ $image -> link }}">
		                	<!-- <img src="avatar.jpg" alt="Sample Image"> -->
		                	{{ HTML::image($image -> link, $image -> id) }}
		            	</a>
		            </div>
		            <div class="caption">
	                    <h3>{{ $image -> id }}</h3>
	                    <p>{{ $image -> link }}</p>
	                    <p><a href="/jf-shop{{ $image -> link }}" class="btn btn-primary">Full Size</a> <a href="#" class="btn btn-danger">Remove</a></p>
		            </div>
		        </div>
	        </div>
	        @endforeach
	    </div>
	    {{ $images->links() }}
	</div>
	
		    
