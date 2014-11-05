<script>
	$(window).on('hashchange', function() {
	    if (window.location.hash) {
	        var page = window.location.hash.replace('#', '');
	        if (page == Number.NaN || page <= 0) {
	            return false;
	        } else {
	            getPosts(page);
	        }
	    }
	});

	$(document).ready(function() {
	    $(document).on('click', '.pagination a', function (e) {
	        getPosts($(this).attr('href').split('page=')[1]);
	        e.preventDefault();
	    });
	});

	function getPosts(page) {
	     document.getElementById("content").innerHTML='<div id="wait"><img src="/jf-shop/images/wait.gif" alt="" /><br /><br />Loading...</div>';
	    $.ajax({
	        url : '?page=' + page,
	        dataType: 'json',
	    }).done(function (data) {
	        document.getElementById("content").innerHTML=data;
	        console.log(document.getElementById(".shop-cart"));
      // 			alert('a');
    		// }
	        console.log(data);
	        location.hash = page;
	    }).fail(function () {
	        alert('Posts could not be loaded.');
	    });
	    //$('html, body').animate({ scrollTop: "600px" });
	}
</script>