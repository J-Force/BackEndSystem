<style type="text/css">
  @import url("//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css");
  .menu, .menu-bar {
   position: fixed;
   top: 100;
   left: 0;
   height: 100%;
   list-style-type: none;
   margin: 0;
   padding: 0;
   background: #f7f7f7;
   z-index:10; 
   overflow:hidden;
   box-shadow: 2px 0 18px rgba(0, 0, 0, 0.26);
  }
  .menu li a{
   display: block;
   text-indent: -500em;
   height: 4em;
   width: 4em;
   line-height: 4em;
   text-align:center;
   color: #72739f;
   position: relative;
   border-bottom: 1px solid rgba(0, 0, 0, 0.05);
   transition: background 0.1s ease-in-out;
  }
  .menu li a:before {
   font-family: FontAwesome;
   speak: none;
   text-indent: 0em;
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   font-size: 1.4em;
   content: "\f002";
  }
  .menu li a.search:before {
   content: "\f002";
  }
  .menu li a.archive:before {
   content: "\f187";
  }
  .menu li a.pencil:before {
   content: "\f040";
  }
  .menu li a.contact:before {
   content: "\f003";
  }
  .menu li a.about:before {
   content: "\f007";
  }
  .menu li a.home:before {
   content: "\f039";
  }
  .menu li a:hover,
  .menu-bar li a:hover,
  .menu li:first-child a {
   background: #ca544e;
   color: #fff;
  }
  .menu-bar{
   overflow:hidden;
   left:4em;
   z-index:5;
   width:0;
   height:0;
   transition: all 0.1s ease-in-out;
  }
  .menu-bar li a{
   display: block;
   height: 4em;
   line-height: 4em;
   text-align:center;
   color: #72739f;
   text-decoration:none; 
   position: relative;
   font-family:verdana;
   border-bottom: 1px solid rgba(0, 0, 0, 0.05);
   transition: background 0.1s ease-in-out;
  }
  .menu-bar li:first-child a{
   height:4em;
   background: #ca544e;
   color: #fff; 
   line-height:4
  }
  .open_left_menu{
   width:10em;
   height:100%;
  }
  @media all and (max-width: 500px) {
   .menu{
   height:5em;
   width:100%;
   }
   .menu li{
   display:inline-block;
   float:left;
   }
   .menu-bar li a{
   width:100%;
   }
   .menu-bar{
   width:100%;
   left:0;
   height:0;
   }
   .open_left_menu{
   width:100%;
   height:auto;
   }
  }
  @media screen and (max-height: 34em){
   .menu li,
   .menu-bar {
   font-size:70%;
   }
  }
  @media screen and (max-height: 34em) and (max-width: 500px){
   .menu{
   height:3.5em;
   }
  }
</style>
<script type="text/javascript">
 $(document).ready(function(){
  $(".menu-button").click(function(e){
    e.preventDefault();
   $(".menu-bar").toggleClass( "open_left_menu" );
  })
 })
</script>
<ul class="menu">
<li title="menu"><a href="#" class="menu-button home">menu</a></li>
<li title="search"><a href="#" class="search">search</a></li>
<!-- <li title="pencil"><a href="#" class="pencil">pencil</a></li>
<li title="about"><a href="#" class="active about">about</a></li>
<li title="archive"><a href="#" class="archive">archive</a></li>
<li title="contact"><a href="#" class="contact">contact</a></li> -->
</ul>
<ul class="menu-bar">
<li><a href="#" class="menu-button">Menu</a></li>
<li><a href="{{ URL::route('products') }}">Show Products</a></li>
<li><a href="{{ URL::route('product-add-view') }}">Add Product</a></li>
<li><a href="{{ URL::route('upload') }}">Upload Image</a></li>
<li><a href="{{ URL::route('image-all') }}">Show Images</a></li>
</ul>