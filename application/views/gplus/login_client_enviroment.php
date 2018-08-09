<div class="jumbotron text-center">
	<div class="container">
		<h3><?php echo isset($title)? $title : "Gplus CI" ?> </h3>
		<p>This is an example of using the Login session button from Gplus</p>	
		<div class="content ">
			<span id="signinButton">
			  <span
			    class="g-signin"
			    data-callback="signinCallback"
			    data-clientid="<?php echo $client_id; ?>"
			    data-redirecturi="postmessage"
			    data-accesstype="offline"
			    data-cookiepolicy="single_host_origin"
			    data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile">
			  </span>
			</span>
		</div>
		<button type="button" id="revokeButton" class="btn btn-small btn-danger d-none">Revoke Token</button>
		<div class="mt-2" id="profile-img"></div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="" id="gplus-people"></div>
		</div>
	</div>
</div>

<script type="text/javascript" charset="utf-8" async defer>
	var State = "<?php echo $state; ?>";
</script>
<script src="/assets/main.js" type="text/javascript"></script>