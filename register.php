<?php
@include 'config.php';
if(isset($_POST['submit'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $user_type = $_POST['user_type'];
   
   // Check if email is from gmail.com domain
   if (!preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $email)) {
      $error[] = 'Only Gmail accounts are allowed!';
   }
   
   // Password validation
   if (strlen($pass) < 8 || 
       !preg_match("/[A-Z]/", $pass) || 
       !preg_match("/[a-z]/", $pass) || 
       !preg_match("/[0-9]/", $pass) || 
       !preg_match("/[\W]/", $pass)) {
      $error[] = 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.';
   } else {
      $pass = md5($pass);
      $cpass = md5($cpass);
      $select = " SELECT * FROM user_info WHERE email = '$email' && password = '$pass' ";
      $result = mysqli_query($conn, $select);
      if(mysqli_num_rows($result) > 0){
         $error[] = 'User already exists!';
      } else {
         if($pass != $cpass){
            $error[] = 'Password not matched!';
         } else {
            $insert = "INSERT INTO user_info(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location:login.php');
         }
      }
   }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
   <form action="" method="post">
      <h3 style="margin-bottom: 20px; text-align: center; color: white;">Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Enter your name" maxlength="20">
      <input type="email" name="email" id="email" required placeholder="Enter your Gmail" maxlength="30" oninput="validateEmail()">
      <div class="password-container">
         <input type="password" name="password" id="password" required placeholder="Enter your password" maxlength="50" oninput="validatePassword()">
         <span id="togglePassword" class="toggle-password">&#128065;</span>
      </div>
      <div class="password-container">
         <input type="password" name="cpassword" id="cpassword" required placeholder="Confirm your password" maxlength="50">
         <span id="toggleCPassword" class="toggle-password">&#128065;</span>
      </div>
      <select name="user_type">
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select>
      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="login.php" style="color: #BB86FC;">Login Now</a></p>
   </form>
</div>
<script>
   function validateEmail() {
   const email = document.getElementById('email');
   const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
   if (!emailPattern.test(email.value)) {
      email.setCustomValidity('Please enter a valid Gmail address.');
   } else {
      email.setCustomValidity('');
   }
}

function validatePassword() {
   const password = document.getElementById('password');
   const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{8,}$/;
   if (!passwordPattern.test(password.value)) {
      password.setCustomValidity('Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.');
   } else {
      password.setCustomValidity('');
   }
}

document.getElementById('togglePassword').addEventListener('click', function () {
   const password = document.getElementById('password');
   const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
   password.setAttribute('type', type);
   this.classList.toggle('show');
});

document.getElementById('toggleCPassword').addEventListener('click', function () {
   const cpassword = document.getElementById('cpassword');
   const type = cpassword.getAttribute('type') === 'password' ? 'text' : 'password';
   cpassword.setAttribute('type', type);
   this.classList.toggle('show');
});
</script>
<style>
   body {
   font-family: Arial, sans-serif;
   background-color:rgb(68, 54, 72); /* A blend of rgb(19, 18, 18) and rgb(123, 104, 125) */
   display: flex;
   justify-content: center;
   align-items: center;
   height: 100vh;
   margin: 0;
}

.form-container {
   background-color: #1E1E1E;
   border: none;
   padding: 20px;
   border-radius: 10px;
   color: white; 
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
   width: 300px;
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
   width: calc(100% - 20px);
   padding: 10px;
   margin: 10px 0;
   border: 1px solid #FFFFFF;
   background-color: #333333;
   color: #FFFFFF;
   border-radius: 5px;
}

.password-container {
   position: relative;
   width: 100%;
}

.toggle-password {
   position: absolute;
   top: 50%;
   right: 10px;
   transform: translateY(-50%);
   cursor: pointer;
   transition: color 0.3s;
}

.toggle-password:hover {
   color: #BB86FC;
}

.error-msg {
   color: #CF6679;
   font-size: 14px;
   text-align: center;
   display: block;
   margin: 10px 0;
}

.form-btn {
   width: 100%;
   padding: 10px;
   border: none;
   border-radius: 5px;
   background-color: #BB86FC;
   color: black;
   cursor: pointer;
   transition: background-color 0.3s;
}

.form-btn:hover {
   background-color: #9b6ef3;
}
</style>
</body>
</html>