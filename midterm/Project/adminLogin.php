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
</head>
<body>
    <form action="adminPanel.php" method="POST">   
        <input type="text" name="userName" placeholder="User Name">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="btnLogin" value="Log In">
    </form>
    <p style="color:'red';"><?php echo $message?></p>
 
</body>
</html>
