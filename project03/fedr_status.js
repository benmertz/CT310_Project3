var masterUrl = "https://www.cs.colostate.edu/~ct310/yr2017sp/more_assignments/project03masterlist.php"
var federatedUrlList = [];

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
			console.log("stat = "  + urlStatus);
          }
       });
	
		if(urlStatus=="open" || urlStatus=="closed"){
			return urlStatus;
		}else {
				return "n/a"
		}

}
	
	
function addRow(json) {
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

function getSound(n) {
	jQuery.post("asound.php", {a : n}, function(data, status) {
		target = "#" + n + "_sound";
        jQuery(target).text(data);
	})
}

function createUrlList(){
	
	jQuery.post(masterUrl, {}, function(data, status) {

		for(var i = 0; i < data.length; i++) {
			var obj = data[i];
			//console.log(JSON.stringify(obj))
			addRow(obj);
			
		}
		console.log("doen " + federatedUrlList.length)
		changeStatusColor();

	});

	
}
