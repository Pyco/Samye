$(document).ready(function() {
	
	

    

	//testAjax();

});

function resumeEvt(eventId) {
	var tab = "";
	
	
	$.ajax({
		type : "POST",
		url : "/samye/web/app_dev.php/allEvents/"+eventId,
		data : "id="+eventId,
		dataType: "JSON",
		success : function(msg) {
			
			;
			
			//dateDeb = new Date(msg[0].date, "mm/dd/yyyy");
			
			
			//tab += "<div id='resume'>";
			tab += "<h2>Evénement :"+msg[0].libelle+"</h2>";
			tab += "<table><tr><td></td><td></td></tr><tr><td>Date : </td><td class='contentRow'>"+msg[0].date+"</td></tr>";
			tab += "<tr><td>Heure : </td><td class='contentRow'>"+msg[0].heureDeb+" - "+msg[0].heureFin+"</td></tr>";
			tab += "<tr><td>Lieu : </td><td class='contentRow'>"+msg[0].lieu+"</td></tr>";
			tab += "<tr><td>Catégorie : </td><td class='contentRow'>"+msg[0].categorie+"</td></tr>";
			tab += "<tr><td>Statut : </td><td class='contentRow'>"+msg[0].status+"</td></tr>";
			tab += "<tr><td>Participation : </td><td class='contentRow'>"+msg[0].participation+"€</td></tr>";
			tab += "<tr><td>Description : </td><td class='contentRow'>"+msg[0].description+"</td></tr>";
			tab += "<tr><td>Auteur : </td><td class='contentRow'>"+msg[0].auteur+"</td></tr></table>";
			//tab += "</div>";
		
			
			$('#resume #contentRows').append(tab);
			
		
		
		
			   
			/*$.each(msg, function(i, item) {
				

			});*/
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