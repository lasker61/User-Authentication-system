<?php
//add our database connection script
include_once 'resource/Database.php';
include_once 'resource/utilities.php';

//process the form
if(isset($_POST['signupBtn'])){
    //initialize an array to store any error message from the form
    $form_errors = array();

    //Form validation
    $required_fields = array('email', 'username', 'password');

    //call the function to check empty field and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //Fields that requires checking for minimum length
    $fields_to_check_length = array('username' => 4, 'password' => 6);

    //call the function to check minimum required length and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    //email validation / merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_email($_POST));

    //check if error array is empty, if yes process form data and insert record
    if(empty($form_errors)){
        //collect form data and store in variables
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        //hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try{

            //create SQL insert statement
            $sqlInsert = "INSERT INTO users (username, email, password, join_date)
              VALUES (:username, :email, :password, now())";

            //use PDO prepared to sanitize data
            $statement = $db->prepare($sqlInsert);

            //add the data into the database
            $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password));

            //check if one new row was created
            if($statement->rowCount() == 1){
                $result = "<p style='padding:20px; border: 1px solid gray; color: green;'> Registration Successful</p>";
            }
        }catch (PDOException $ex){
            $result = "<p style='padding:20px; border: 1px solid gray; color: red;'> An error occurred: ".$ex->getMessage()."</p>";
        }
    }
    else{
        if(count($form_errors) == 1){
            $result = "<p style='color: red;'> There was 1 error in the form<br>";
        }else{
            $result = "<p style='color: red;'> There were " .count($form_errors). " errors in the form <br>";
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
    <title>Register Page</title>
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
              <li class="nav-item ">
               <a class="nav-link" href="login.php">login </a>
             </li>
              <li class="nav-item active">
              <a class="nav-link" href="signup.php">signup <span class="sr-only">(current)</span></a>
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
                    <h3 class="text-center">Registration Form</h3>

                    <?php if(isset($result)) echo $result; ?>
                    <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>

                         <div class="main-form" id="reg">
                             <form method="post" action="" class="form-group">
                       
                            Email:<input type="text" value="" name="email" class="form-control">
                            Username:<input type="text" value="" name="username" class="form-control">
                            Password:<input type="password" value="" name="password" class="form-control">
                            <input style="float: right;" type="submit" name="signupBtn" value="Signup" class="btn btn-primary mt-2">
                       
                    </form>
                         </div>
                         
                 </div>
                 <div class="col-md-2">
                     
                 </div>
             </div>
         </section>
         <section class="feature-2">
             <div class="container">
                 <div class="row">
                     <div class="col-md-4">
                         
                     </div>
                     <div class="col-md-4">
                        <div class="back">
                             <p class="text-center"><a href="index.php" class="btn btn-primary mt-5">Back</a> </p>
                        </div>
                         
                     </div>
                     <div class="col-md-4">
                         
                     </div>
                 </div>
             </div>
         </section>

</body>
</html>