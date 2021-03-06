<script>

	$(function(){
		
		$("body").delegate(".send-comment","click",function(){
			

			var comment = $('textarea').val();
			$('textarea').val('');
			if(comment === '') {
				alert('Please type your comment before submit');
			}
			else {
				var product_id = $(this).attr("id");
				var user_id = $(this).attr("user-id");
				var review_id;

				$.post("/jf-shop/products/show/"+product_id+"/comment" , { product_id:product_id , comment: comment} ,
					function(res,status){
						if( res.fail ) {
				            window.location.replace("http://128.199.212.108/jf-shop/user/sign_in");
				        }
				        review_id = res[1];
				        updateReview(comment,product_id,review_id,user_id);
					}
				);
			}
		});

		$("body").delegate(".delete-comment","click",function() {
			

			var review_id = $(this).attr("review-id");
			var product_id = $(this).attr("product-id");

			var cf = confirm('Do you want to remove this review');

			if(cf) {
				$.post("/jf-shop/products/show/"+product_id+"/comment/"+ review_id +"/delete" ,
				  { review_id:review_id , product_id:product_id},
				  function(res,status){

				  }
				);

				deleteReview(review_id,product_id);
			}

		});



		$("body").delegate(".edit-comment","click",function(){
		

			var review_id = $(this).attr("review-id");
			var product_id = $(this).attr("product-id");
			var text = $('.'+review_id).text();

			var p = $('.'+review_id);
			p.replaceWith("<textarea col='100' row='30' name='comment_"+ review_id +"'>" + text + "</textarea>");

			var edit_button = $(".edit-comment[review-id='"+ review_id +"']");
			edit_button.replaceWith("<a class='btn btn-primary pull-right confirm-comment' review-id='"+review_id+"' product-id='"+product_id+"'>Confirm</a>");

			$("body").delegate(".confirm-comment[review-id='"+ review_id +"']","click",function(){
				
				text = $("textarea[name='comment_"+ review_id +"']").val();
				
				$.post("/jf-shop/products/show/"+product_id+"/comment/"+review_id+"/edit",
					{review_id:review_id , product_id:product_id , text:text},
					function(res,status){
						
					}
				);

				p = $("textarea[name='comment_"+ review_id +"']");
				edit_button = $(this);
				edit_button.replaceWith("<a class='btn btn-primary pull-right edit-comment' review-id='"+review_id+"' product-id='"+product_id+"'>Edit</a>");
				p.replaceWith("<p class='"+ review_id +"'>"+ text +"</p>");
			});
			
		});

		$('body').delegate('.ratings_stars', 'click', function() {
           
   		    rate = parseInt($(this).attr("value"));

   		});


		function deleteReview(review_id,product_id) {
			$('.row_'+review_id).remove();
			$('.end-seperate_'+review_id).remove();
			var count = parseInt($('.count_'+product_id).html());
			$('.count_'+product_id).html(count-1);
		}

		function updateReview(comment,product_id,review_id,user_id) {
		
			$.get('/jf-shop/products/show/'+product_id+'/getRate' , {product_id:product_id} ,
				function(res,status){
					if(res.rate) {
						var rate = parseInt(res.rate);
						var left = 5 - rate;
						var star = "";
						var star_left = "";
						for(var i = 0 ; i < rate ;i++) {
							star += "<span class='star_"+i+" ratings_voted' value='"+i+"' id='"+product_id+"'></span>";
						}
						for(var j = 0 ; j < left ; j++) {
							star_left += "<span class='"+ j+" ratings_stared' value='"+j+"' id='"+ product_id +"'></span>"; 
						}
						var output =  [ "<div class='row row_" +review_id+"'>",
								            "<div class='col-md-12'>",
								               "<span class='rate_widget_"+review_id+"'>", 
								               "@if(Auth::check())",
				                    				star,
				                    				star_left,
				                				"</span>",
								                "{{ Auth::user()->first_name.' '.Auth::user()->last_name }}",
								                "@endif",
								                "<span class='pull-right'> Few seconds agos </span>",
								                "<p class='"+review_id+"'>"+comment+"</p>",
				                    			"<a class='btn btn-danger pull-right delete-comment' review-id='"+ review_id +"' product-id='"+ product_id+"'>Delete</a>",
				                    			"<a class='btn btn-primary pull-right edit-comment' review-id='"+review_id+"' product-id='"+ product_id+"'>Edit</a>", 
								            "</div>",
								        "</div>" , "<hr class='end-seperate_"+ review_id +"'>"].join("");
						    $('.seperate').after(output);
						    var count = parseInt($('.count_'+product_id).html());
						    $('.count_'+product_id).html(count+1);
						    $('.' +user_id).hide();

					} 
				}
			);

		 	

		}

	});

</script>