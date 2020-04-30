<?php 
    error_reporting(0);
    if($_GET['Login'] == "no"){
        $message = "Hatalı Giriş";
    }
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="adminLoginStyle.css">
</head>
<body>
    <div class="login">
        <div class="loginMenu">
            <h4>Admin Girişi</h4>
            <form action="adminPanel.php" method="POST">   
                <input type="text" name="userName" placeholder="User Name"><br>
                <input type="password" name="password" placeholder="Password"><br>
                <input type="submit" name="btnLogin" value="Log In"><br>
            </form>
            <p style="color:'red';"><?php echo $message?></p>
        </div>
    </div>
    
 
</body>
</html>
