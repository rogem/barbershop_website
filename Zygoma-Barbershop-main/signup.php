<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
     <form action="signup-check.php" method="post">
     	<h2>SIGN UP</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php header("Location:index.php"); ?></p>
          <?php } ?>

          <label>Name</label>
          <?php if (isset($_GET['name'])) { ?>
               <input type="text"
                      name="name"
                      placeholder="Name"
                      value="<?php echo $_GET['name']; ?>"><br>
          <?php }else{ ?>
               <input type="text"
                      name="name"
                      placeholder="Name"><br>
          <?php }?>

          <label>Email</label>
          <?php if (isset($_GET['uname'])) { ?>
               <input type="email"
                      name="uname"
                      placeholder="Email"
                      value="<?php echo $_GET['uname']; ?>"><br>
          <?php }else{ ?>
               <input type="email"
                      name="uname"
                      placeholder="Email"><br>
          <?php }?>


     	<label>Password</label>
     	<input type="password"
                 name="password"
                 placeholder="Password"><br>

          <label>Retype Password</label>
          <input type="password"
                 name="re_password"
                 placeholder="Retype Password"><br>

          <div class="g-recaptcha"  data-sitekey="6LdCi_0fAAAAAGdCFIa9iNMC_hAIF7w-EbNl50VT"></div>

     	<button type="submit">Sign Up</button>
          <a href="index.php" class="ca">Already have an account?</a>
     </form>
</body>
</html>