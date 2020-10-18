<?php
include_once 'resource/session.php';
include_once 'resource/Database.php';
include_once 'resource/utilities.php';

if(isset($_POST['loginBtn'])){
    //array to hold errors
    $form_errors = array();

//validate
    $required_fields = array('username', 'password');
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    if(empty($form_errors)){

        //collect form data
        $user = $_POST['username'];
        $password = $_POST['password'];

        //check if user exist in the database
        $sqlQuery = "SELECT * FROM users WHERE username = :username";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(':username' => $user));

       while($row = $statement->fetch()){
           $id = $row['id'];
           $hashed_password = $row['password'];
           $username = $row['username'];

           if(password_verify($password, $hashed_password)){
               $_SESSION['id'] = $id;
               $_SESSION['username'] = $username;
               header("location: index.php");
           }else{
               $result = "<p style='padding: 20px; color: red; border: 1px solid gray;'> Invalid username or password</p>";
           }
       }

    }else{
        if(count($form_errors) == 1){
            $result = "<p style='color: red;'>There was one error in the form </p>";
        }else{
            $result = "<p style='color: red;'>There were " .count($form_errors). " error in the form </p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Login Page</title>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
             <div class="container">
              <a class="navbar-brand" href="index.php">Navbar</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
             </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav ml-auto">
              <li class="nav-item ">
               <a class="nav-link " href="index.php">Home</a>
              </li>
              <li class="nav-item active">
               <a class="nav-link" href="login.php">login  <span class="sr-only">(current)</span></a>
             </li>
              <li class="nav-item">
              <a class="nav-link" href="signup.php">signup</a>
              </li>     
             </ul>
    
         </div>

         </div>
         </nav>

         <section class="features">
           <div class="row">
             <div class="col-md-2">
               
             </div>
             <div class="col-md-8">
              <h2 class="text-center">User Authentication System </h2><hr>

              <h3 class="text-center">Login Form</h3>

                  <?php if(isset($result)) echo $result; ?>
                  <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>

                  <div class="main-form ">
                    <form method="post" action="" class="form-group ">

                          Username:<input type="text" value="" name="username" class="form-control ">
                          Password:<input type="password" value="" name="password" class="form-control mb-3">

                          <a href="forgot_password.php" >Forgot Password?</a>
                          <input style="float: right;" type="submit" name="loginBtn" value="Signin" class="btn btn-primary">
                      
                  </form>
                  </div>
                  <p class="text-center"><a href="index.php" class="btn btn-primary mt-5">Back</a> </p>
               
             </div>
             <div class="col-md-2">
               
             </div>
           </div>
         </section>








</body>
</html>