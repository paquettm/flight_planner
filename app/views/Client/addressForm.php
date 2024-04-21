
<div class='clock'></div>
<form method='get' action=''>
<label class='form-label'>City:<input type='text' name='city' id='city' class='form-control' disabled /></label>
<label class='form-label'>Province:<input type='text' name='province' id='province' class='form-control' disabled /></label>
<label class='form-label'>Country:<input type='text' name='country' id='country' class='form-control' value='Canada' disabled/></label>
<label class='form-label'>Postal:<input type='text' name='postal' id='postal' class='form-control' /></label>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
	$('#postal').bind('keyup',function(){
		if($('#postal').val().length == 3){
//			$.getJSON('https://api.zippopotam.us/CA/' + $('#postal').val(), //direct call without caching
			$.getJSON('/AddressAPI/inCanadaFromPostal/' + $('#postal').val(), // call to caching interface
				function(data){
					if(typeof data.places !== 'undefined'){
						$('#province').val(data.places[0].state);		//use dot notation as wanted
						$('#city').val(data.places[0]['place name']);	//use bracket notation if there are spaces in the key name
					}else{
						$('#province').val('');
						$('#city').val('');
					}

				});
		}
	}
);
</script>