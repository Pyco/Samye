$(document).ready(function() {
	
	$('#contentRows .id').hide();
	$('#resume a#button').hide();
	
	$('#resume a#button').click(function(){
		$(this).parent("#resume").fadeOut(300);
		$('#insideRight').fadeIn(750).removeClass("hidden");
	});
    
	$('a.detailEvt').click(function(){		
		return false;				
	},resumeEvtTab);
	//testAjax();

});

function resumeEvt(eventId) {
		
	$("#resume").fadeIn(300, function() {				
		$('#resume a#button').fadeIn(300);
	});
	
	var tab = "";
	
	
	$.ajax({
		type : "POST",
		url : "/samye/web/app_dev.php/allEvents/"+eventId,
		data : "id="+eventId,
		dataType: "JSON",
		success : function(msg) {
			
			tab += "<h2>Evénement : "+msg[0].libelle+"</h2>";
			tab += "<div id='list'>";
			tab += "<table><tr><td></td><td></td></tr><tr><td><strong>Date : </strong></td><td class='contentRow'>"+msg[0].date+"</td></tr>";
			tab += "<tr><td><strong>Heure :  </strong></td><td class='contentRow'>"+msg[0].heureDeb+" - "+msg[0].heureFin+"</td></tr>";
			tab += "<tr><td><strong>Lieu :  </strong></td><td class='contentRow'>"+msg[0].lieu+"</td></tr>";
			tab += "<tr><td><strong>Catégorie : </strong> </td><td class='contentRow'>"+msg[0].categorie+"</td></tr>";
			tab += "<tr><td><strong>Statut :  </strong></td><td class='contentRow'>"+msg[0].status+"</td></tr>";
			tab += "<tr><td><strong>Participation :  </strong></td><td class='contentRow'>"+msg[0].participation+"€</td></tr>";
			tab += "<tr><td><strong>Description :  </strong></td><td class='contentRow'>"+msg[0].description+"</td></tr>";
			tab += "<tr><td><strong>Auteur :  </strong></td><td class='contentRow'>"+msg[0].auteur+"</td></tr></table>";
			tab += "</div>";
		
			
			$('#resume #contentRows').append(tab);
		}
	});
}


function resumeEvtTab() {
	
	var recId = $('.detailEvt').attr("data");
	console.log(recId);
	var tab = "";
	
	
	
	$.ajax({
		type : "POST",
		url : "/samye/web/app_dev.php/allEvents/"+recId,
		data : "id="+recId,
		dataType: "JSON",
		success : function(msg) {
			if($('#insideRight').hasClass("hidden")) {
				$('#resume').fadeOut(1000, function() {
					$('#resume #contentRows').html("");
				
					tab += "<h2>Evénement : "+msg[0].libelle+"</h2>";
					tab += "<div id='list'>";
					tab += "<table><tr><td></td><td></td></tr><tr><td><strong>Date : </strong></td><td class='contentRow'>"+msg[0].date+"</td></tr>";
					tab += "<tr><td><strong>Heure :  </strong></td><td class='contentRow'>"+msg[0].heureDeb+" - "+msg[0].heureFin+"</td></tr>";
					tab += "<tr><td><strong>Lieu :  </strong></td><td class='contentRow'>"+msg[0].lieu+"</td></tr>";
					tab += "<tr><td><strong>Catégorie : </strong> </td><td class='contentRow'>"+msg[0].categorie+"</td></tr>";
					tab += "<tr><td><strong>Statut :  </strong></td><td class='contentRow'>"+msg[0].status+"</td></tr>";
					tab += "<tr><td><strong>Participation :  </strong></td><td class='contentRow'>"+msg[0].participation+"€</td></tr>";
					tab += "<tr><td><strong>Description :  </strong></td><td class='contentRow'>"+msg[0].description+"</td></tr>";
					tab += "<tr><td><strong>Auteur :  </strong></td><td class='contentRow'>"+msg[0].auteur+"</td></tr></table>";
					tab += "</div>";
					//tab += '<a id="button">Retour</a>';
					
					$('#resume #contentRows').append(tab);
					$('#resume a#button').fadeOut(2000);
				});
				
			} else {
				$('#insideRight').fadeOut(300).addClass("hidden");
				$("#resume").fadeIn(750, function() {
					//$('#insideRight').hide();
					$('#resume #contentRows').html("");
					
					tab += "<h2>Evénement : "+msg[0].libelle+"</h2>";
					tab += "<div id='list'>";
					tab += "<table><tr><td></td><td></td></tr><tr><td><strong>Date : </strong></td><td class='contentRow'>"+msg[0].date+"</td></tr>";
					tab += "<tr><td><strong>Heure :  </strong></td><td class='contentRow'>"+msg[0].heureDeb+" - "+msg[0].heureFin+"</td></tr>";
					tab += "<tr><td><strong>Lieu :  </strong></td><td class='contentRow'>"+msg[0].lieu+"</td></tr>";
					tab += "<tr><td><strong>Catégorie : </strong> </td><td class='contentRow'>"+msg[0].categorie+"</td></tr>";
					tab += "<tr><td><strong>Statut :  </strong></td><td class='contentRow'>"+msg[0].status+"</td></tr>";
					tab += "<tr><td><strong>Participation :  </strong></td><td class='contentRow'>"+msg[0].participation+"€</td></tr>";
					tab += "<tr><td><strong>Description :  </strong></td><td class='contentRow'>"+msg[0].description+"</td></tr>";
					tab += "<tr><td><strong>Auteur :  </strong></td><td class='contentRow'>"+msg[0].auteur+"</td></tr></table>";
					tab += "</div>";
					//tab += '<a id="button">Retour</a>';
					
					$('#resume #contentRows').append(tab);
					$('#resume a#button').fadeIn(800);
				});
			}
		}
	});
	
	/*$.post('url', {id:"data"}, function(msg) {
		
	});*/
	
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