function toggleSigned(){
	if( !$('#signinButton').hasClass('d-none') ){
		$('#signinButton').addClass('d-none');
    	$('#revokeButton').removeClass('d-none');
	} else {
		$('#signinButton').removeClass('d-none');
    	$('#revokeButton').addClass('d-none');
	}
	$("#gplus-people").empty();
	$("#profile-img").empty();
}

function signInSuccessHandler(data){
	$('#profile-img').html('<img src="'+data.image.url+'">');
	$('#gplus-people').html(
		"<strong>email:</strong> "+data.emails[0].value+
		"<br><strong>displayName:</strong> "+data.displayName+
		"<br><strong>gender:</strong> "+data.gender+
		"<br><strong>language:</strong> "+data.language+
		"<br><strong>url:</strong> <a href='"+data.url+"' target='_blank'>"+data.url+"</a>"
	);
}

function signinCallback(authResult) {
  if (authResult['access_token']) {
  	$.post("/gplus/connect", { code: authResult['code'], state: State }, {}, "JSON")
  	.done(function( response ){
  		toggleSigned();
    	$("#gplus-people").html("Loading..");
  		$.get("/gplus/get_people", {}, {}, "JSON")
  		.done( signInSuccessHandler )
  		.fail( function(e){ console.log( "Error " + e); } );

  	}).fail(function(){ alert("Something went wrong")});
  } else if (authResult['error']) {
    if( authResult['error'] != "immediate_failed" ){
    	console.log( authResult['error'] );
    }
  }
}

$('#revokeButton').click(function(){
	$.post("/gplus/disconnect", {}, {}, "JSON")
	.done(function(response){
		toggleSigned();
	});
});