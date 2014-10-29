<div class="row">
	<p>This is an example of using the Login session button from Gplus</p>
	<span id="signinButton">
	  <span
	    class="g-signin"
	    data-callback="signinCallback"
	    data-clientid="<?php echo $client_id; ?>"
	    data-cookiepolicy="single_host_origin"
	    data-requestvisibleactions="http://schemas.google.com/AddActivity"
	    data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/userinfo.email">
	  </span>
	</span>
</div>
<div class="row">
	<button type="button" id="revokeButton" class="btn btn-danger">Revoke Token</button>
</div>
<script type="text/javascript" charset="utf-8" async defer>
var UrlSaveToken = "<?php echo base_url(); ?>tests/save_token";
var UrlGetToken = "<?php echo base_url(); ?>tests/get_token";
function signinCallback(authResult) {
  if (authResult['access_token']) {
  	// console.log( authResult );
  	$.post(UrlSaveToken, { access_token: authResult['access_token'] }, {}, "JSON")
  	.done(function( response ){
  		// console.log("Logged In");
  	}).fail(function(){ alert("Something went wrong")});
    // Autorizado correctamente
    // Oculta el botón de inicio de sesión ahora que el usuario está autorizado, por ejemplo:
    document.getElementById('signinButton').setAttribute('style', 'display: none');
  } else if (authResult['error']) {
    // Se ha producido un error.
    // Posibles códigos de error:
    //   "access_denied": el usuario ha denegado el acceso a la aplicación.
    //   "immediate_failed": no se ha podido dar acceso al usuario de forma automática.
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
	      // Lleva a cabo una acción ahora que el usuario está desconectado
	      // La respuesta siempre está indefinida.
	      document.getElementById('signinButton').setAttribute('style', 'display: inline');
	    },
	    error: function(e) {
	      // Gestiona el error
	      // console.log(e);
	      // Puedes indicar a los usuarios que se desconecten de forma manual si se produce un error
	      // https://plus.google.com/apps
	    }
	  });
	}
	// Se puede activar la desconexión haciendo clic en un botón
	$('#revokeButton').click(function(){
		$.get(UrlGetToken, {}, {}, "JSON")
		.done(function(response){
			disconnectUser( response.access_token );
		});
	});
</script>