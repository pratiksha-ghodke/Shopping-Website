<?php
    include 'config.php';
    if(isset($_POST['submit']))
    {
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);;
        $pass = mysqli_real_escape_string($conn,$_POST['password']);
        $cpass = mysqli_real_escape_string($conn,$_POST['cpassword']);
        $user_type = "user";

        $select_users = mysqli_query($conn, "SELECT * FROM `users` where email =
        '$email' AND password ='$pass' ") or die('query failed');

        if(mysqli_num_rows($select_users)>0)
        {
            $message[] = 'user already exists!';
        }
        else{
            if($pass != $cpass)
            {
                $message[] = 'confirm password not matched!';
            }
            else{
                mysqli_query($conn,"INSERT INTO `users`(name,email,password,user_type) VALUES('$name','$email'
            ,'$cpass','$user_type')") or die('query failed');
            $message[] ='registered successfully!';
            header('location:login.php');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
   
    <?php
        if(isset($message)){
            foreach($message as $message)
            {
                echo '
                <div class="message">
                <span>'.$message.'</span>   
                <i class="fas fa-times"  onclick="this.parentElement.remove();"></i>
                </div>
                ';
            }
        }
    ?>
    <div class="form-container">
        <form action="" method="post">
            <h3>Register now</h3>
            <input type="text" class="box" name="name" placeholder="Enter your name" required>
            <input type="email" class="box" name="email" placeholder="Enter your email" required>
            <input type="password" class="box" name="password" placeholder="Enter your password" required>
            <input type="password" class="box" name="cpassword" placeholder="Confirm your password" required>
            <input type="submit" name="submit" value="register now" class="btn">
            <p>already have an account?<a href="login.php">Login now</a> </p>
        </form>
    </div>
    
</body>
</html>