
jQuery(document).ready(function() {
	console.log("START");

	getIngr();
});

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

function getIngr(){
	var rt = "ZZZZ";
	var tab = document.getElementById('placeholder');
	tab.innerHTML = rt;
	
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
                console.log("ing= " + ing.name);




         }

       });
}
