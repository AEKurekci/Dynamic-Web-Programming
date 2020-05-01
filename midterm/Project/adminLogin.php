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
    <link rel="stylesheet" href="styles/registerStyle.css">
</head>
<body>
    <div class="register">
        <form method="post" action="adminPanel.php">
                
            <table>
                <tr><td>Admin Girişi</td></tr>
                <tr><td><input type="text" name="userName" placeholder="Kullanıcı Adı"> </td></tr>

                <tr><td><input type="password" name="password" placeholder="Şifre"></td></tr>

                <tr><td><input type="submit" name="btnLogin" value="Giriş" style="width:30%"></td></tr>

                <tr><td style="color:#ff0000;"><?php echo $message?></td></tr>
            </table>
            
        </form>
    </div>
 
</body>
</html>
