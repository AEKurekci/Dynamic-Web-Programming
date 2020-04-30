<?php
    error_reporting(0);
    session_start();
    $server = "localhost";
    $userName = "root";
    $password = "";
    $db = "mobilephonedb";
    $isLogin = false;
    try{
        $connect = new PDO("mysql:host=$server;dbname=$db",$userName,$password);
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        if($_POST['btnLogin']){
            $user = $_POST['userName'];
            $pass = md5($_POST['password']);
            $sql = "SELECT user_name, name, password FROM users WHERE user_name='$user' and password='$pass'";
            $result = $connect->query($sql);
            $row = $result->fetch();
            if($row['user_name'] != ""){
                $isLogin = true;
                $_SESSION['user'] = $_POST['userName'];
                echo "<script type='text/javascript'>alert('Giriş yapıldı');</script>";
                header("Location:index.php");
            }else{
                $message = "Hatalı Giriş";    
            }
        }
    }
    catch(PDOException $ex){
        print "Connection Failed" . $ex->getMessage();
    }
    $connect = null;
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="registerStyle.css">
</head>
<body>
    <nav>
        <ul class="topMenu">
            <a href="index.php" ><img src="image/logo.png" alt=""></a>
            <li style="color: #ffffff"><?php echo $_SESSION['user']?></li>
            <li><a href="index.php">Anasayfa</a></li>
            <li><a href="index.php#sepetim">Sepetim</a></li>
            <li><a href="userRegister.php">Kaydol</a></li>
            <li><a href="#">Giriş Yap</a></li>
            <li><a href="logOutUser.php">Güvenli Çıkış</a></li>
        </ul>
    </nav>
    <div class="register">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                
            <table>
                <tr><td>Kullanıcı Girişi</td></tr>
                <tr><td><input type="text" name="userName" placeholder="User Name"> </td></tr>

                <tr><td><input type="password" name="password" placeholder="Password"></td></tr>

                <tr><td><input type="submit" name="btnLogin" value="Giriş" style="width:30%"></td></tr>

                <tr><td style="color:#ff0000;"><?php echo $message?></td></tr>
            </table>
            
        </form>
    </div>    
 
</body>
</html>
