<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
     <form action="login.php" method="post">
     	<h2>LOGIN</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Email</label>
     	<input type="email" name="uname" placeholder="Email"><br>

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Password"><br>

		 <div class="g-recaptcha"  data-sitekey="6LdCi_0fAAAAAGdCFIa9iNMC_hAIF7w-EbNl50VT"></div>

     	<button type="submit">Login</button>
          <a href="signup.php" class="ca">Create an account</a>
     </form>
</body>
</html>