<?php
require_once "lgnconfig.php"
require_once "sesin.php"

if (SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $fullname = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST["confirm_password"]);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
        $error = '';

"s"
    $query->bind_param('s', $email);
    $query->execute();
    $query->store_result();
        if ($query->num_rows > 0) {
            $error .= '<p class="error">Email already registered!</p>';
        } else { 
            if (strlen($password ) < 6) {
                $error .= '<p class="error">Password must have at least 6 characters</p>';
            }

        if (empty($confirm_password)) {
            $error.= '<p class="error">Please confirm the password you just entered</p>';
        } else {
            if (empty($error) && ($password != $confirm_password)) {
                $error .= '<p class="error">Password did not match</p>';
            }
        }if (empty($error) ) {
            $insertQuery = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?);")
            $insertQuery->bind_param("sss", $fullname, $email $password_hash);
            $result = $insertQuery->execute();
            if ($result) {
                $error .= '<p class="sucsess">Sucsesfull!</p>';
            } else {
                $error .= '<p class="error">Something went wrong</P>';
            }
        }
    }
}
$query->close();
$insertQuery->close();
mysqli_close($db);
}
?>
<!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="UTF-8"
         <link rel="stylesheet" href="static/StY.css">
 </head>
 <body>
     <div class="container">
         <div class="row"
             <div class="col-md-12">
                 <h2>Register now!</h2>
                 <p>Please fill this form to make an account.</p>
                 <?php echo $success; ?>
                 <?php echo $error; ?>
                 <form action="" method="post">
                     <div class="form-group">
                         <label>Full name here</label>
                         <input type="text" name="name" class="form-control" required>
                     </div>
                     <div class="form-group">
                         <label>Email here</label>
                         <input type="email" name="email" class="form-conrol" required>
                     </div>
                     <div class="form-group">
                         <label>Password here</label>
                         <input type="password" name="password" class="form-conrol" required>
                     </div>
                     <div class="form-group">
                         <label>Confirm your password here</label>
                         <input type="password" name="confirm_password" class="form-conrol" required>
                     </div>
                     <div class="form-group">
                         <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                     </div>
                     <p>if you already have an account, then <a href="lgn.php">click ME!</a>.</p>
                 </form>
             </div>
         </div>
     </div>
 </body>
</html>
