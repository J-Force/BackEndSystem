
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
	                    <p><a href="/jf-shop{{ $image -> link }}" class="btn btn-primary">Full Size</a> 
	                    <a href="image/delete/{{$image->id}}" class="btn btn-danger" data-method="delete" data-confirm="Are you sure?">Remove</a>
	                    <!-- {{ Form::open(array('url' => 'image/delete','method' => 'delete')) }}
			            {{ Form::token() }}
			            {{ Form::hidden('id',$image->id) }}
			            {{ Form::submit('Remove',array('class'=>'btn btn-danger')) }}
			            {{ Form::close() }} -->
			        	</p>
		            </div>
		        </div>
	        </div>
	        @endforeach
	    </div>
	    <div style="float:right">{{ $images->links() }}</div>
	</div>
	@include('scripts.confirmRemove')
	
		    
