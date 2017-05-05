var masterUrl = "https://www.cs.colostate.edu/~ct310/yr2017sp/more_assignments/project03masterlist.php"
var federatedUrlList = [];
var federation = [];

jQuery(document).ready(function() {
	createUrlList();
});


function changeStatusColor(){
	console.log("change color");

	$(".statopen").css("color","white");
	$(".statopen").css("background-color","green");
	$(".statopen").css("padding","10px");

	$(".statclosed").css("color","white");
	$(".statclosed").css("background-color","red");
	$(".statclosed").css("padding","10px");
	
	$(".statundef").css("background-color","yellow");
	$(".stat").css("padding","10px");

}

function getStatus(baseUrl){
		var statusURL = baseUrl + "ajax_status.php"
		
		
		urlStatus="";

		$.ajax({
          url:  baseUrl + "ajax_status.php",
          type: "POST",
          async:false,
          success: function(data){
             if(data instanceof Array){
				for(var i = 0; i < data.length; i++) {
					var obj = data[i];
					//console.log(obj.status)
					urlStatus =  obj.status;			
				}
			}else{
				//console.log((data.status));
				urlStatus = data.status;
			}
			//console.log("stat = "  + urlStatus);
          }
       });
	
		if(urlStatus=="open" || urlStatus=="closed"){
			return urlStatus;
		}else {
				return "undef"
		}

}

class ingr{
		constructor(n,s,u,c){
			this.name=n;
			this.short=s;
			this.unit=u;
			this.cost=c;
		}
		
		toString(){
			var ret = "";
			ret += this.name  + " " + this.unit + " " + this.cost;
			return ret;
		}
}

function getIngredients(baseUrl, status){
		var retIngr = [];
		var listingURL = baseUrl + "ajax_listing.php"
		if(status === "open"){
			$.ajax({
				url:  listingURL,
				type: "POST",
				async:false,
				success: function(data){
            
				if(data instanceof Array){
					for(var i = 0; i < data.length; i++) {
						var obj = data[i];
						//console.log(obj);
						var tempIngr = new ingr(obj.name, obj.short, obj.unit, obj.cost)
						console.log(tempIngr.toString());
						retIngr.push(tempIngr);

					}
				}
			
				}
       
			});		
		}
		return retIngr;
}

function createIngrTable(fedr) {
	
	var rt = "";
	var tab = document.getElementById('fedr_ingr_table');
	
	for (var x in fedr){
		var temp = fedr[x];
		console.log("temp = " + temp.toString())

		for (var i in temp.ingredients){
			var ingr = temp.ingredients[i];
			
			console.log("ingr = " + ingr.toString())

			rt  = "<tr>";
			rt += "<td><a href=\http://www.cs.colostate.edu/~pello/CT310_Project3/project03/ajax_viewingr.php?ing="+ingr.name+"&link="+temp.baseURL+">"+ingr.name+"</td>";
			rt += "<td>"+ingr.unit+"</td>";
			rt += "<td> $"+ingr.cost+"</td>";
			rt += "<td>"+ingr.short+"</td>";
			rt += "<td><a>"+temp.baseURL+"</a></td>";
			rt += "</tr>";
		
			tab.innerHTML += rt;
		}
	}
}
	
function addStatusRow(json) {
	var rt = "";
	var tab = document.getElementById('fedr_status_table');
		status = getStatus(json.baseURL)
		rt  = "<tr class=\"stat"+status+"\">";
		rt += "<td>"+status+"</td>";
		rt += "<td>"+json.Team+"</td>";
		rt += "<td>"+json.nameShort+"</td>";
		rt += "<td>"+json.nameLong+"</td>";
		rt += "<td>"+json.baseURL+"</td>";
		rt += "</tr>";
		
		tab.innerHTML += rt;

}

class fedr{
		constructor(b, t, nS, nL){
			this.baseURL=b;
			this.team=t;
			this.nameShort=nS;
			this.nameLong=nL;
			this.status = getStatus(this.baseURL);
			this.ingredients = getIngredients(this.baseURL, this.status);
		}
			
		toString(){
			var ret = "";
			ret += this.team + " " + this.nameShort + " " + this.status + " " + this.ingredients.length;
			return ret;
		}
}

function createUrlList(){
	
	$.ajax({
          url:  masterUrl,
          type: "POST",
          async:false,
          success: function(data){
			  
				for(var i = 0; i < data.length; i++) {
					var obj = data[i];
					//console.log(JSON.stringify(obj));
					
					var temp = new fedr(obj.baseURL, obj.Team, obj.nameShort, obj.nameLong);
					
					console.log(temp.toString());
					
					federation.push(temp);
			
				}
				
				createIngrTable(federation);
				jQuery("#outp2").html("SUCCESS");

				
          }
       });
	
	


	
}
