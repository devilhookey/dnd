function dig( position ){
	$.ajax({
		data : {'position' : position, 'act' : 'dig'},
		type : 'get',
		url : './ajax.php',
		dataType : 'json',
		success : function(response){
			if (response.returnCode==0) {
				$( '#'+position ).addClass('dug');
				$( '#'+position ).html('<div>' + response.msg + '</div>');
				$( '#hero' ).html('<div>' + response.hero + '</div>');
			} else{
				alert(response.msg);
			};
		}
	})
}