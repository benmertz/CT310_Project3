<?php
require_once "inc/page_setup.php";
$db = new Database();
$pgTitle = "Home";
include ('inc/header.php');
include ('inc/nav.php');
?>
<script type="text/javascript" >

class ingrPage{
	
	constructor(url, i){
		this.link = url;
		this.ingr = i;
		this.name = "";
		this.short = "";
		this.unit = "";
		this.cost = "";
		this.time = "";
		this.desc = "";
		
		}
		
		toString(){
			var ret = "";
			ret += " [" + this.link + " , " + this.ingr + "] ["+ this.name + " , " + this.desc + "] ";
			return ret;
		}
		
		toUrl(){
			var ret = "";
			ret += "" + this.link + "ajax_ingredient.php?ing=\"" + this.ingr + "\"";
			return ret;
			
		}
		toImgUrl(){
			var ret = "";
			ret += "" + this.link + "ajax_ingrimage.php?ing=\"" + this.ingr + "\"";
			return ret;
			
		}

		getData(){
			
				$.ajax({
					url:  ing.toUrl(),
					type: "POST",
					async:true,
					success: function(data){
						console.log(JSON.stringify(data));
          
					}
         
				});
		
		}
}

</script>

</head>


<?php
$ing="";
$link="";

	if (isset ( $_GET ['ing'] )) {
		$ing = $_GET['ing'];
	}else{
			$ing ="#NI#";
	}
	
	if (isset ( $_GET ['link'] )) {
		$link = $_GET['link'];
	}else{
		$link ="#NL#";
		}
		
	if(($link == "#NL#") || ($link == "#NL#")){
		//header ( "Location: ./index.php" );
		
		}
?>

<script type="text/javascript" >
jQuery(document).ready(function() {


		
	
	var ing = new ingrPage("<?php echo $link; ?>","<?php echo $ing; ?>");
	console.log("ing= " + ing.toString());
	console.log("ing= " + ing.toUrl());
	$.ajax({
          url:  ing.toUrl(),
          type: "POST",
          async:false,
          success: function(data){
				console.log(JSON.stringify(data));
				ing.name = data.name;
				ing.short = data.short;
				ing.unit = data.unit;
				ing.cost = data.cost;
				ing.time = data.time;
				ing.desc = data.desc;
                console.log("ing= " + ing.toString());
                $("#ingrName").text(ing.name);
                $("#ingrDesc").text(ing.desc);
                $("#ingrPrice").text("$"+ing.cost+" / "+ ing.unit );
                $("#ingrTime").text(ing.time);
                console.log("ing.name= " + ing.name);
                 console.log("ing.imgUrl= " + ing.toImgUrl());

                jQuery.post(ing.toImgUrl(), {}, function(data, status) {
					$("#ajaxINGR").attr('src', "data:image/png;base64,"+ data);
					$("#ajaxINGR").attr('alt', "Picture of " + ing.name);

					console.log("data  = " + data);

				});




         }

       });
});
</script>

<!-- Start contents of main page here. -->

<div class="col-lg-2 col-md-2 hidden-sm hidden-xs" ></div>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
	<h2 id="ingrName">Ingredient Not Found!</h2>
	<p id="ingrDesc"></p>
	<p id="ingrPrice"></p>
	<p id="ingrTime"></p>


</div>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
	<img  src="" id="ajaxINGR" class="img-circle img-responsive" alt=""/>
	<!--<p class="photoCred">Photo by krosseel at <a href="https://morguefile.com/">Morguefile.com</a></p>-->
</div>

<div class="col-lg-2 col-md-2 hidden-sm hidden-xs" ></div>

<!-- End of contents -->
<?php include('inc/footer.php'); ?>
