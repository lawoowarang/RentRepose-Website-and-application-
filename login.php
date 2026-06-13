<?php
@include 'config.php';
session_start();
if(isset($_POST['submit'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];
   $select = " SELECT * FROM user_info WHERE email = '$email' && password = '$pass' ";
   $result = mysqli_query($conn, $select);
   if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);
      if($row['user_type'] == 'admin'){
         $_SESSION['admin_name'] = $row['name'];
         header('location:ownerdshbrd.html');
      }elseif($row['user_type'] == 'user'){
         $_SESSION['user_name'] = $row['name'];
         header('location:home.html');
      }
   }else{
      $error[] = 'incorrect email or password!';
   }
};

if(isset($_POST['forgot_password'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $select = "SELECT * FROM user_info WHERE email = '$email'";
   $result = mysqli_query($conn, $select);
   if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);
      $reset_link = "http://yourwebsite.com/reset_password.php?email=$email";
      // For demonstration, we will just simulate the process
      // In a real scenario, you should use a mail function to send the email
      mail($email, "Password Reset", "Reset your password using this link: $reset_link");
      echo "<script>alert('A password reset link has been sent to your registered email address.');</script>";
   }else{
      $error[] = 'Email not found!';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>
   <style>
      body {
   background-color:rgb(68, 54, 72); /* A blend of rgb(19, 18, 18) and rgb(123, 104, 125) */
   font-family: 'Arial', sans-serif;
   display: flex;
   justify-content: center;
   align-items: center;
   height: 100vh;
   margin: 0;
}

.form-container {
   background-color: #1E1E1E;
   color: #FFFFFF;
   padding: 2rem;
   border-radius: 10px;
   box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
   width: 300px;
   text-align: center;
   animation: fadeIn 1s ease-in-out;
}

form h3 {
   margin-bottom: 1rem;
   color: #FFFFFF;
   font-size: 2rem;
   animation: slideIn 1s ease-in-out;
}

form input {
   width: 100%;
   padding: 0.5rem;
   margin: 0.5rem 0;
   border: 1px solid #FFFFFF;
   background-color: #333333;
   color: #FFFFFF;
   border-radius: 5px;
   transition: all 0.3s ease;
   animation: inputFadeIn 1s ease-in-out;
}

form input:focus {
   border-color: #BB86FC;
   box-shadow: 0 0 5px rgba(187, 134, 252, 0.5);
}

form .form-btn {
   background-color: #BB86FC;
   color: #FFFFFF;
   border: none;
   padding: 0.5rem;
   border-radius: 5px;
   cursor: pointer;
   transition: background-color 0.3s ease;
   animation: buttonFadeIn 1s ease-in-out;
}

form .forgot-btn {
   background-color: #CF6679;
   color: #FFFFFF;
   border: none;
   padding: 0.3rem 0.5rem;
   border-radius: 5px;
   cursor: pointer;
   transition: background-color 0.3s ease;
   animation: buttonFadeIn 1s ease-in-out;
   margin-bottom: 0.5rem;
}

.error-msg {
   color: #CF6679;
   margin-bottom: 1rem;
   display: block;
   animation: shake 0.5s ease-in-out;
}

@keyframes fadeIn {
   from {
       opacity: 0;
       transform: translateY(-10px);
   }
   to {
       opacity: 1;
       transform: translateY(0);
   }
}

@keyframes slideIn {
   from {
       transform: translateX(-200px);
       opacity: 0;
   }
   to {
       transform: translateX(0);
       opacity: 1;
   }
}

@keyframes inputFadeIn {
   from {
       opacity: 0;
       transform: translateY(20px);
   }
   to {
       opacity: 1;
       transform: translateY(0);
   }
}

@keyframes buttonFadeIn {
   from {
       opacity: 0;
       transform: translateY(30px);
   }
   to {
       opacity: 1;
       transform: translateY(0);
   }
}

@keyframes shake {
   0% { transform: translateX(0); }
   25% { transform: translateX(-5px); }
   50% { transform: translateX(5px); }
   75% { transform: translateX(-5px); }
   100% { transform: translateX(0); }
}
   </style>
</head>
<body>
<div class="form-container">
   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email" maxlength="30">
      <input type="password" name="password" required placeholder="enter your password" maxlength="20">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <input type="submit" name="forgot_password" value="forgot password" class="forgot-btn">
      <p>don't have an account? <a href="register.php" style="color: #BB86FC;">register now</a></p>
   </form>
</div>
</body>
</html>