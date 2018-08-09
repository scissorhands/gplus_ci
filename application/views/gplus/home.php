<div class="jumbotron text-center">
	<div class="container">
		<h3><?php echo isset($title)? $title : "Home" ?> </h3>
		<p>Welcome, this is an example of how to use google sign-in button</p>
		<p>
			Please follow <?php echo anchor('example/gplus_sign_in', 'this link'); ?>
			to test the example.
		</p>
	</div>
</div>