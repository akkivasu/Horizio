<html>
    <head>
    
        <title>Sign Up</title>
    
    </head>

    <body>
        Register Here!

        <form action="login1.php" method="post">
        
            UID:
            <input type="number" name="UID">
            
            Name:
            <input type="text" name="name">
            
            Email:
            <input type="email" name="email">
            
            Password:
            <input type="password" name="password">
        
            <input type="submit" name="signup" value="Sign Up">
        </form>


    </body>

<?php
    
    $db = mysqli_connect("localhost", "root", "", "reg");
    if(isset($_POST["signup"])){
        $UID = mysqli_real_escape_string($db, $_POST['UID']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
        
        
        if (empty($username)) { array_push($errors, "Username is required"); }
        if (empty($email)) { array_push($errors, "Email is required"); }
        if (empty($password_1)) { array_push($errors, "Password is required"); }
        if ($password_1 != $password_2) {
	       array_push($errors, "The two passwords do not match");
        }
        
        
        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
  
        if ($user) { // if user exists
            if ($user['username'] === $username) {
                array_push($errors, "Username already exists");
            }

            if ($user['email'] === $email) {
                array_push($errors, "email already exists");
            }
        }

        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
  	        //encrypt the password before saving in the database

  	        //$query = "INSERT INTO users (username, email, password) 
  			//  VALUES('$username', '$email', '$password')";
  	        //mysqli_query($db, $query);
            mysqli_query($db, "INSERT INTO user(id,name,password,email) VALUES ('$UID','$name','$password_1','$email')");
  	        $_SESSION['username'] = $username;
  	        $_SESSION['success'] = "You are now logged in";
  	        header('location: index.php');
        }        
        
    }
?>

</html>



