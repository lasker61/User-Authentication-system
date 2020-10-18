<?php include_once 'resource/session.php' ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Homepage</title>
</head>
<body>
	<section class="main">
		
			<nav class="navbar navbar-expand-lg navbar-light bg-dark">
             <div class="container">
             	<a class="navbar-brand" href="index.php">Navbar</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
             </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
               <a class="nav-link " href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
               <a class="nav-link" href="login.php">login</a>
             </li>
              <li class="nav-item">
              <a class="nav-link" href="signup.php">signup</a>
              </li>
      
             </ul>
    
         </div>



         </div>
         </nav>
         <section class="features">
         	<div class="container">
         		<div class="row">
         			<div class="col-md-2">
         				
         			</div>
         			<div class="col-md-8">
         				<h2>Welcome to User Authentication System </h2>
         				<p class="text-center">Learn to code a Login and Registration system . <br> Enhance your coding skills</p>

         				<hr>

							<?php if(!isset($_SESSION['username'])): ?>
							<P >You are currently not signed in . you can login here <a href="login.php" class="btn btn-info">Login</a><br>Not yet a member? <a href="signup.php" class="btn btn-info">Signup</a> </P>
							<?php else: ?>
								<h1 class="text-center">congartulations!</h1>
							<p class="text-center">You are logged in as <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?> <a href="logout.php">Logout</a> </p>
							<?php endif ?>

         			</div>
         			<div class="col-md-2">
         				
         			</div>
         		</div>
         	</div>
         </section>


		
	</section>

	











    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="js/bootstrap.min.js"> </script>

</body>
</html>