<script>

	$(function(){

		// This actually records the vote
        $('body').delegate('.ratings_stars', 'click', function() {
           
   		    var rate = parseInt($(this).attr("value"));
            var widget = $(this).parent();
            var product_id = $(this).attr("id");
            set_votes(rate,widget);

            $.post('/jf-shop/products/show/'+ product_id +'/rate' , { product_id:product_id , rate:rate} ,
            	function(res,status) {
            		if( res.fail ) {
				        window.location.replace("http://128.199.212.108/jf-shop/user/sign_in");
				    }
            	}
             );
        });

		$('.ratings_stars').hover(
		    // Handles the mouseover
		    function() {
		        $(this).prevAll().andSelf().addClass('ratings_over');
		        $(this).nextAll().removeClass('ratings_vote'); 
		    },
		    // Handles the mouseout
		    function() {
		        $(this).prevAll().andSelf().removeClass('ratings_over');
		        
		    }
		);

		function set_votes(count,widget) {
	        
	        $(widget).find('.star_' + count).prevAll().andSelf().addClass('ratings_vote');
	        $(widget).find('.star_' + count).nextAll().removeClass('ratings_vote'); 
	    }
	});

	

</script>