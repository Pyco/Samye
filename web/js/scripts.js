$(document).ready(function() {

    // page is now ready, initialize the calendar...
    
   var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
    var tab;
    var recLib;
	$.ajax({
			type: "POST",
			url: "/samye/web/app_dev.php/test/",
			data: "lieu=ici",
			success: function(msg) {
				$.each(msg, function(i, item) {
					
					/*tab = '[{';
					tab += 'title:'+item.libelle+",";
					tab += 'start: new Date(y, m, 25)';					
					tab += '}]';*/
					
					recLib = item.libelle;
					
					
				});
				/*tab = '{';
					tab += "title: 'All Day Event',";
					tab += "start: new Date(y, m, 25)";					
					tab += '}';*/
					
					
				$('#calendar').fullCalendar({
				
					editable: true,					
					events: [
						{
							title: recLib,
							start: new Date(y, m, 25)
						}
					],					
					eventDrop: function(event, delta) {
						alert(event.title + ' was moved ' + delta + ' days\n' +
							'(should probably update your database)');
					},					
					loading: function(bool) {
						if (bool) $('#loading').show();
						else $('#loading').hide();
					}
					
				});
				
			}
			
			
		});
	
    
		
	testAjax();

});

function testAjax() {
	
	var url = $("#formEvt").attr("action");
	//alert(url);
	
	$(".addEvt").click(function() {
		alert("ok");
		$.ajax({
			type: "POST",
			url: url,
			data: "pouet=pouet",
			success: function(msg) {
				if(msg == "pouet") {
					alert("POP POP !");
				} else {
					alert("KO");
				}
			}
			
			
		});
		return false;
	});
}