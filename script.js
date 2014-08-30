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
	
	$( document ).on( "click", "input:radio[name=gender]", function() {
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
	$( document ).on( "click", "input:radio[name=cond1_4]", function() {
		if($('input:radio[name=cond1_4]:checked').val() == '2'){
			$('#step').val('1_4_2');
			$.getData();
			$('#step2').html(response);
		}else if($('input:radio[name=cond1_4]:checked').val() == '3'){
			$('#step').val('1_4_3');
			$.getData();
			$('#step2').html(response);
		}else if($('input:radio[name=cond1_4]:checked').val() == '4'){
			$('#step').val('1_4_4');
			$.getData();
			$('#step2').html(response);
		}else if($('input:radio[name=cond1_4]:checked').val() == '6'){
			$('#step').val('1_4_6');
			$.getData();
			$('#step2').html(response);
		}else{
			$('#step2').html('');
		}
	});
	$( document ).on( "click", "input:radio[name=cond1_9]", function() {
		if($('input:radio[name=cond1_9]:checked').val() === '1'){
			$('#step').val('1_9_1');
			$.getData();
			$('#step2').html(response);
		}
        });
	$( document ).on( "click", "input:radio[name=cond1_10]", function() {
		if($('input:radio[name=cond1_10]:checked').val() === '2'){
			$('#step').val('1_10_2');
			$.getData();
			$('#step2').html(response);
		}
        });
                
                
    	$( document ).on( "click", "input:radio[name=gender]", function() {
		if($('input:radio[name=gender]:checked').val() === 'f'){
			$('#step').val('2');
			$.getData();
			$('#step1').html(response);
		}
	});
	$( document ).on( "click", "input:radio[name=cond2_1]", function() {
		if($('input:radio[name=cond2_1]:checked').val() == '2'){
			$('#step').val('2_1_2');
			$.getData();
			$('#step2').html(response);
		}else{
			$('#step2').html('');
		}
	});
        
        	$( document ).on( "click", "input:radio[name=cond2_1_2_1]", function() {
		if($('input:radio[name=cond2_1_2_1]:checked').val() === '5'){
			$('#step').val('2_1_2_1_5');
			$.getData();
			$('#step3').html(response);
		}else if($('input:radio[name=cond2_1_2_1]:checked').val() === '6'){
			$('#step').val('2_1_2_1_6');
			$.getData();
			$('#step3').html(response);
		}else{
			$('#step3').html('');
		}
	});
	
	$( document ).on( "click", "input:radio[name=cond2_1_2_1_6_3]", function() {
		if($('input:radio[name=cond2_1_2_1_6_3]:checked').val() == '1'){
			$('#step').val('2_1_2_1_6_3_1');
			$.getData();
			$('#step4').html(response);
		}else{
			$('#step4').html('');
		}
	});


	$( document ).on( "click", "input:radio[name=gender]", function() {
		if($('input:radio[name=gender]:checked').val() === "n"){
			$('#step').val('3');
			$.getData();
			//$('.innerStep').html('');
			$('#step1').html(response);
		}
  	});
        
        
});