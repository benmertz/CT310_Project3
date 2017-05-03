var masterUrl = "https://www.cs.colostate.edu/~ct310/yr2017sp/more_assignments/project03masterlist.php"
var federatedUrlList = [];
var federation = [];

jQuery(document).ready(function() {
	createUrlList();
});



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




function addStatusRow(json) {
	var rt = "";
	var tab = document.getElementById('fedr_status_table');
		status = getStatus(json.baseURL)
		var trStatus= "";
		if(status=="open"){
				trStatus="success";
		}else if(status=="closed"){
				trStatus="danger";
		}else{
				trStatus="warning";
		}
		rt  = "<tr class=\"stat"+status+" " + trStatus+"\">";
		rt += "<td>"+status+"</td>";
		rt += "<td>"+json.Team+"</td>";
		rt += "<td>"+json.nameShort+"</td>";
		rt += "<td>"+json.nameLong+"</td>";
		rt += "<td><a>"+json.baseURL+"</a></td>";
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
			//this.ingredients = getIngredients(this.baseURL, this.status);
		}
			
		toString(){
			var ret = "";
			ret += this.team + " " + this.nameShort + " " + this.status + " ";
			return ret;
		}
}

function createUrlList(){
	
	$.ajax({
          url:  masterUrl,
          type: "POST",
          async:true,
          success: function(data){
			  
				for(var i = 0; i < data.length; i++) {
					var obj = data[i];
					//console.log(JSON.stringify(obj));
					
					var temp = new fedr(obj.baseURL, obj.Team, obj.nameShort, obj.nameLong);
					
					console.log(temp.toString());
					
					federation.push(temp);
					addStatusRow(obj);
			
				}
				jQuery("#outp2").html("SUCCESS");
          }
       });
	
	


	
}
