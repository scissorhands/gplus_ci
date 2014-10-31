<div class="row">
	<p>This is an example of using the Login session button from Gplus</p>
	<span id="signinButton">
	  <span
	    class="g-signin"
	    data-callback="signinCallback"
	    data-clientid="<?php echo $client_id; ?>"
	    data-cookiepolicy="single_host_origin"
	    data-requestvisibleactions="http://schemas.google.com/AddActivity"
	    data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile">
	  </span>
	</span>
</div>
<div class="row">
	<button type="button" id="revokeButton" class="btn btn-danger">Revoke Token</button>
</div>
<div class="row">
	<div id="gplus-people"></div>
</div><a href="" title=""></a>

<script type="text/javascript" charset="utf-8" async defer>
var BaseUrl = "<?php echo base_url(); ?>";
function signinCallback(authResult) { + ""
  if (authResult['access_token']) {
  	$.post(BaseUrl + "gplus/connect", { code: authResult['code'] }, {}, "JSON")
  	.done(function( response ){
  		
    	document.getElementById('signinButton').setAttribute('style', 'display: none');
    	$("#gplus-people").html("Loading..");
  		console.log("Logged In");
  		$.get(BaseUrl + "gplus/get_people", {}, {}, "JSON")
  		.done( function( people ){
  			$("#gplus-people").html("Done.");
  			$('#gplus-people').empty();

			$('#gplus-people').append('Number of people visible to this app: ' +
			  people.totalItems + '<br/>');
			for (var personIndex in people.items) {
				person = people.items[personIndex];
				$('#gplus-people').append('<a title="' 
					+person.displayName+ '" href="'+person.url+'"><img src="' + person.image.url + '"></a> - ');
			}
  		} )
  		.fail( function(e){ console.log( "Error " + e); } );

  	}).fail(function(){ alert("Something went wrong")});
  } else if (authResult['error']) {
    if( authResult['error'] != "immediate_failed" ){
    	console.log('There was an error: ' + authResult['error']);
    }
  }
}
</script>

<script type="text/javascript">
	function disconnectUser(access_token) {
	  var revokeUrl = 'https://accounts.google.com/o/oauth2/revoke?token=' +
	      access_token;

	  // Realiza una solicitud GET asíncrona.
	  $.ajax({
	    type: 'GET',
	    url: revokeUrl,
	    async: false,
	    contentType: "application/json",
	    dataType: 'jsonp',
	    success: function(nullResponse) {
	      document.getElementById('signinButton').setAttribute('style', 'display: inline');
	    },
	    error: function(e) {
	      // console.log(e);
	    }
	  });
	}
	// Se puede activar la desconexión haciendo clic en un botón
	$('#revokeButton').click(function(){
		$.get(BaseUrl + "gplus/get_token", {}, {}, "JSON")
		.done(function(response){
			disconnectUser( response.access_token );
		});
	});
</script>