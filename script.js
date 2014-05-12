$(document).ready(function() {	
	// Check for the blur event
	var response = '';
	$.getData = function(){
		$.ajax({
				type: "POST",
				url: "ajax.php",
				async   : false,
				data: $( "form" ).serialize()
				})
				.done(function( data ) {
					response = data;
					//$('#response').html(data);
		});
	}
	
	$( "#first" ).blur(function() {
		if($('input:radio[name=gender]:checked').val() === "m"){
			$('#step').val('1');
			$.getData();
			//$('.innerStep').html('');
			$('#step1').html(response);
		}
  	});
	$( document ).on( "click", "input:radio[name=cond1_1_1]", function() {
		if($('input:radio[name=cond1_1_1]:checked').val() === '5'){
			$('#step').val('1_1_1_5');
			$.getData();
			$('#step2').html(response);
		}else if($('input:radio[name=cond1_1_1]:checked').val() === '6'){
			$('#step').val('1_1_1_6');
			$.getData();
			$('#step2').html(response);
		}else{
			$('#step2').html('');
		}
	});
	
	$( document ).on( "click", "input:radio[name=cond1_1_1_6_3]", function() {
		if($('input:radio[name=cond1_1_1_6_3]:checked').val() == '1'){
			$('#step').val('1_1_1_6_3_1');
			$.getData();
			$('#step3').html(response);
		}else{
			$('#step3').html('');
		}
	});
	
	
});