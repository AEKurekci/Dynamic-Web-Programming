<?php
    error_reporting(0);
    session_start();
    
    if(!isset($_SESSION['user'])){
        header("Location:userLogin.php");
    }

    $server = "localhost";
    $userName = "root";
    $passwordForDB = "";
    $db = "mobilephonedb";
    $isLogin = false;

    $name ="";
    $surname = "";
    $year = "";
    $password = "";
    $email = "";
    $webSite = "";
    $newPassword = false;
    
    $nameErr=$surnameErr=$emailErr=$passwordErr=$yearErr = "";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(empty($_POST['name'])){
            $name = $_SESSION['currentName'];
        }else{
            $name = cleanProcess($_POST['name']);
            if(!preg_match("/^[a-zA-Z üğÜĞİşŞçÇöÖ]*$/",$name)){
                $nameErr = "Only characters and space";
            }else{
                $nameErr ="";
            }
        }
        if(empty($_POST['surname'])){
            $surname = $_SESSION['currentSurname'];
        }else{
            $surname = cleanProcess($_POST['surname']);
            if(!preg_match("/^[a-zA-Z üğÜĞİşŞçÇöÖ]*$/",$surname)){
                $surnameErr = "Only characters and space";
            }else{
                $surnameErr = "";
            }
        }
        if(empty($_POST['year'])){
            $year = $_SESSION['currentYear'];
        }else{
            $year = cleanProcess($_POST['year']);
            if(!preg_match("/^[0-9]*$/",$year)){
                $yearErr = "Only numbers";
            }else{
                $yearErr = "";
            }
        }
        if(empty($_POST['email'])){
            $email = $_SESSION['currentEmail'];
        }else{
            $email = cleanProcess($_POST['email']);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $emailErr = "Invalid email format";
            }else{
                $emailErr ="";
            }
        }
        if(empty($_POST['newPassword'])){
            $password = $_SESSION['currentPassword'];
            $newPassword = false;
        }else{
            $password = cleanProcess($_POST['newPassword']);
            $newPassword = true;
            $passwordErr = "";
        }
        if(empty($_POST['password'])){
            $passwordErr = "Şifre Gerekli";
        }
        $webSite = empty($_POST['webSite']) ? $_SESSION['currentWeb'] : cleanProcess($_POST['webSite']);
    }
    
    try{
        $connect = new PDO("mysql:host=$server;dbname=$db",$userName,$passwordForDB);
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        if($_POST['btnUpdate'] && $nameErr=="" && $surnameErr=="" && $yearErr=="" && $emailErr=="" && $passwordErr==""){
            $user = $_SESSION["user"];
            $pass = $newPassword ? md5($password) : $password;
            $sqlPassword = "SELECT password FROM users WHERE user_name='$user'";
            $result = $connect->query($sqlPassword);
            $rowPassword = $result->fetch();
            if($rowPassword['password'] != md5($_POST['password'])){
                $passwordErr = "Şifre Yanlış";
            }else{
                $sqlUpdate = "UPDATE users SET name='$name',surname='$surname',year='$year',
                password='$pass',email='$email',web_site='$webSite' WHERE user_name='$user' ";

                $statement = $connect->prepare($sqlUpdate);

                $statement->execute();

                echo $statement->rowCount()." records are Updated";
            }
        }
        $currentUser = $_SESSION["user"];
        $sqlSelect = "SELECT name,surname,year,password,email,web_site FROM users WHERE user_name='$currentUser'";
        $result = $connect->query($sqlSelect);
        $row = $result->fetch();
        
        if($row['name'] != ""){
            $_SESSION['currentName'] = $name =$row['name'];
            $_SESSION['currentSurname'] = $surname = $row['surname'];
            $_SESSION['currentYear'] = $year = $row['year'];
            $_SESSION['currentPassword'] = $password = $row['password'];
            $_SESSION['currentEmail'] = $email = $row['email'];
            $_SESSION['currentWeb'] = $webSite = $row['web_site'];
        }
    }
    catch(PDOException $ex){
        print "Connection Failed" . $ex->getMessage();
    }
    function printInfo(){
        $currentUser = $_SESSION["user"];
        $sqlSelect = "SELECT name,surname,year,password,email,web_site FROM users WHERE user_name='$currentUser'";
        $result = $connect->query($sqlSelect);
        $row = $result->fetch();
        
        if($row['name'] != ""){
            $name =$row['name'];
            $surname = $row['surname'];
            $year = $row['year'];
            $password = $row['password'];
            $email = $row['email'];
            $webSite = $row['web_site'];
        }
    }
    function cleanProcess($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles/profilStyle.css">
</head>
<body>
    <nav>
        <ul class="topMenu">
            <a href="index.php" ><img src="image/logo.png" alt=""></a>
            <li style="color: #ffffff"><?php echo $_SESSION['user']?></li>
            <li><a href="index.php">Anasayfa</a></li>
            <li><a href="index.php#sepetim">Sepetim</a></li>
            <li><a href="userRegister.php">Kaydol</a></li>
            <li><a href="userLogin.php">Giriş Yap</a></li>
            <li><a href="#">Profil</a></li>
            <li><a href="adminLogin.php">Admin Girişi</a></li>
            <li><a href="logOutUser.php" class="btnOut">Güvenli Çıkış</a></li>
        </ul>
    </nav>
    <div class="register">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                
            <table>
                <tr><td>Profil</td><td><?php echo $_SESSION['user']?></td></tr>

                <tr> <td><input type="text" name="name" placeholder="<?php echo $name ?>"> </td> 
                <td><span class="error"><?php echo $nameErr ?></span> </td></tr>

                <tr> <td><input type="text" name="surname" placeholder="<?php echo $surname ?>"> </td> 
                <td><span class="error"><?php echo $surnameErr ?></span> </td></tr>

                <tr> <td><input type="number" name="year" placeholder="<?php echo $year ?>" max=2020> </td> 
                <td><span class="error"><?php echo $yearErr ?></span> </td></tr>

                <tr> <td><input type="email" name="email" placeholder="<?php echo $email ?>"> </td> 
                <td><span class="error"><?php echo $emailErr ?></span> </td></tr>

                <tr> <td><input type="password" name="password" placeholder="Şu Anki Şifre"> </td> 
                <td><span class="error"><?php echo $passwordErr ?></span> </td></tr>

                <tr> <td><input type="password" name="newPassword" placeholder="Yeni Şifre"> </td> </tr>

                <tr> <td><input type="url" name="webSite" placeholder="<?php echo $webSite !='' ? $webSite: "Web Sitesi" ?>"> </td> 
                <td> </td></tr>


                <tr><td><input type="submit" name="btnUpdate" value="Bilgileri Güncelle" style="width:30%"></td></tr>

                <tr><td style="color:#ff0000;"><?php echo $message?></td></tr>
            </table>
            
        </form>
    </div>    
 
</body>
</html>
