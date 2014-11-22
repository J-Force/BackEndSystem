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
				var review_id;

				$.post("/jf-shop/products/show/"+product_id+"/comment" , { product_id:product_id , comment: comment} ,
					function(res,status){
						if( res.fail ) {
				            window.location.replace("http://128.199.212.108/jf-shop/user/sign_in");
				        }
				        review_id = res[1];
				        updateReview(comment,product_id,review_id);
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

		function deleteReview(review_id,product_id) {
			$('.row_'+review_id).remove();
			$('.end-seperate_'+review_id).remove();
			var count = parseInt($('.count_'+product_id).html());
			$('.count_'+product_id).html(count-1);
		}

		function updateReview(comment,product_id,review_id) {
		 	var output =  [ "<div class='row row_" +review_id+"'>",
				            "<div class='col-md-12'>",
				                "<span class='glyphicon glyphicon-star'></span>",
				                "<span class='glyphicon glyphicon-star'></span>",
				                "<span class='glyphicon glyphicon-star'></span>",
				                "<span class='glyphicon glyphicon-star'></span>",
				                "<span class='glyphicon glyphicon-star-empty'></span>",
				                "{{ Auth::user()->first_name.' '.Auth::user()->last_name }}",
				                "<span class='pull-right'> Few seconds agos </span>",
				                "<p class='"+review_id+"'>"+comment+"</p>",
                    			"<a class='btn btn-danger pull-right delete-comment' review-id='"+ review_id +"' product-id='"+ product_id+"'>Delete</a>",
                    			"<a class='btn btn-primary pull-right edit-comment' review-id='"+review_id+"' product-id='"+ product_id+"'>Edit</a>", 
				            "</div>",
				        "</div>" , "<hr class='end-seperate_"+ review_id +"'>"].join("");
		    $('.seperate').after(output);
		    var count = parseInt($('.count_'+product_id).html());
		    $('.count_'+product_id).html(count+1);


		}

	});

</script>