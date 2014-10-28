<div class="row">
	<p>This is an example of using the Login session button from Gplus</p>
	<span id="signinButton">
	  <span
	    class="g-signin"
	    data-callback="signinCallback"
	    data-clientid="<?php echo $client_id; ?>"
	    data-cookiepolicy="single_host_origin"
	    data-requestvisibleactions="http://schemas.google.com/AddActivity"
	    data-scope="https://www.googleapis.com/auth/plus.login">
	  </span>
	</span>
</div>