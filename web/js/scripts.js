$(document).ready(function() {

    

	//testAjax();

});

function resumeEvt(eventId) {
	var tab = [];
	
	
	$.ajax({
		type : "POST",
		url : "/samye/web/app_dev.php/vcal/",
		data : "id="+eventId,
		success : function(msg) {

			$.each(msg, function(i, item) {
				$("#infoEvt").html("");
				info += "<ul>";
				info += "<li><p>"+item.title+"</p><p>"+item.id+"</p><li>";
				info += "<ul>";
		        $("#infoEvt").append(info);

			});
			//callback(tab);
			
		}
	});
}

/*****************************************/
function setEvts() {
	
	
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	var tab = [];
	
	
	$.ajax({
		type : "POST",
		url : "/samye/web/app_dev.php/vcal/",
		data : "lieu=Belfort",
		success : function(msg) {

			$.each(msg, function(i, item) {

				tab.push({
					title : item.title,
					start : new Date(y, m, d)
				});

			});
			//callback(tab);
			
		}
	});
}

function testAjax() {

	var url = $("#formEvt").attr("action");
	//alert(url);

	$(".addEvt").click(function() {
		alert("ok");
		$.ajax({
			type : "POST",
			url : url,
			data : "pouet=pouet",
			success : function(msg) {
				if (msg == "pouet") {
					alert("POP POP !");
				} else {
					alert("KO");
				}

			}
			
		});

});
}