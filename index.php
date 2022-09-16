<?php

include 'function.php';
include 'header.php';

?>

<div class="p-5 mb-4 bg-light rounded-3">

	<div class="container-fluid py-5">

		<h1 class="display-5 fw-bold" style="text-align:center;">Library Management System</h1>

		<p class="fs-4" style="text-align:center;">
			Welcome to our new Online Library Management System. <br>
			Now you can use all the library services remotely.	<br>
			Please Log in below to proceed.
		</p>
		
	</div>

</div>

<div class="row align-items-md-stretch">

	<div class="col-md-6">

		<div class="h-100 p-5 text-white bg-dark rounded-3">

			<h2>Admin Login</h2>
			<p></p>
			<a href="admin_login.php" class="btn btn-outline-light">Admin Login</a>

		</div>

	</div>

	<div class="col-md-6">

		<div class="h-100 p-5 bg-light border rounded-3">

			<h2>User Login</h2>

			<p></p>

			<a href="user_login.php" class="btn btn-outline-secondary">User Login</a>

			<a href="user_registration.php" class="btn btn-outline-primary">User Sign Up</a>

		</div>

	</div>

</div>

<?php

include 'footer.php';

?>