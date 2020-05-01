<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="styles/registerStyle.css">
</head>
<body>
    
    <?php
    error_reporting(0);
    session_start();
        $serverName = "localhost";
        $userNameForDB = "root";
        $passwordForDB = "";
        $db = "mobilephonedb";
        
        $name = "";
        $surname = "";
        $year = "";
        $email = "";
        $userName = "";
        $password = "";
        $webSite = "";
        $gender = "";
        $nameErr=$surnameErr=$emailErr=$userNameErr=$passwordErr=$genderErr=$yearErr = "";
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(empty($_POST['name'])){
                $nameErr = "Name is required";
            }else{
                $name = cleanProcess($_POST['name']);
                if(!preg_match("/^[a-zA-Z üğÜĞİşŞçÇöÖ]*$/",$name)){
                    $nameErr = "Only characters and space";
                }else{
                    $nameErr ="";
                }
            }
            if(empty($_POST['surname'])){
                $surnameErr = "Surname is required";
            }else{
                $surname = cleanProcess($_POST['surname']);
                if(!preg_match("/^[a-zA-Z üğÜĞİşŞçÇöÖ]*$/",$surname)){
                    $surnameErr = "Only characters and space";
                }else{
                    $surnameErr = "";
                }
            }
            if(empty($_POST['year'])){
                $yearErr = "Year is required";
            }else{
                $year = cleanProcess($_POST['year']);
                if(!preg_match("/^[0-9]*$/",$year)){
                    $yearErr = "Only numbers";
                }else{
                    $yearErr = "";
                }
            }
            if(empty($_POST['email'])){
                $emailErr = "Email is required";
            }else{
                $email = cleanProcess($_POST['email']);
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $emailErr = "Invalid email format";
                }else{
                    $emailErr ="";
                }
            }
            if(empty($_POST['userName'])){
                $userNameErr = "User Name is required";
            }else{
                $userName = cleanProcess($_POST['userName']);
                if(!preg_match("/^[a-zA-Z üğÜĞİşŞçÇöÖ]*$/",$userName)){
                    $userNameErr = "Only characters and space";
                }else{
                    $userNameErr = "";
                }
            }
            if(empty($_POST['password'])){
                $passwordErr = "Password is required";
            }else{
                $password = cleanProcess($_POST['password']);
                $passwordErr = "";
            }
            if(empty($_POST['gender'])){
                $genderErr = "Gender is required";
            }else{
                $gender = cleanProcess($_POST['gender']);
                $genderErr = "";
            }
            $webSite = cleanProcess($_POST['webSite']);
        }
        try{
            $connect = new PDO("mysql:host=$server;dbname=$db",$userNameForDB,$passwordForDB);
            $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            if($name !="" && $nameErr=="" && $surnameErr=="" && $yearErr=="" && $emailErr=="" && $userNameErr=="" && $passwordErr=="" && $genderErr==""){
                
                $isUniq = isUserExist($connect, $userName);

                if($isUniq){
                    $passwordMD5 = md5($password);
                    $sqlRegister = "INSERT INTO users (name,surname,year,email,user_name,password,web_site,gender) VALUES
                    ('$name','$surname',$year,'$email','$userName','$passwordMD5','$webSite','$gender')";
                    $connect->exec($sqlRegister);
                
                    echo "<script type='text/javascript'>alert('Kayıt başarılı');</script>";
                
                    $name ="";
                    $surname ="";
                    $year ="";
                    $email ="";
                    $userName ="";
                    $password ="";
                    $webSite ="";
                    $gender ="";
                    $userNameErr = "";
                }
                else{
                    $userNameErr = "Kullanıcı adı kullanılıyor!";
                }
            }
        }catch(PDOException $ex){echo $ex;}

        function cleanProcess($input){
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }

        function isUserExist($connection, $user){
            $sqlUsername = "SELECT user_name FROM users WHERE user_name='$user'";
            $resultOfUserName = $connection->query($sqlUsername);
            $row = $resultOfUserName->fetch();
            $resultOfThis = $row[0] == "" ? true : false;
            return $resultOfThis;
        }
        $connect = null;
        
    ?>

    <nav>
        <ul class="topMenu">
            <a href="index.php" ><img src="image/logo.png" alt=""></a>
            <li style="color: #ffffff"><?php echo $_SESSION['user']?></li>
            <li><a href="index.php">Anasayfa</a></li>
            <li><a href="index.php#sepetim">Sepetim</a></li>
            <li><a href="#">Kaydol</a></li>
            <li><a href="userLogin.php">Giriş Yap</a></li>
            <li><a href="userProfil.php">Profil</a></li>
            <li><a href="adminLogin.php">Admin Girişi</a></li>
            <li><a href="logOutUser.php" class="btnOut">Güvenli Çıkış</a></li>
        </ul>
    </nav>

    <div class="register">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
            
            <table>
                <tr><td colspan="3"><span class="error">* : Required</span></td><td></td><td></td></tr>

                <tr><td>Name: </td> <td><input type="text" name="name" value="<?php echo $name ?>"> </td> 
                <td><span class="error">*<?php echo $nameErr ?></span> </td></tr>

                <tr><td>Surname: </td> <td><input type="text" name="surname" value="<?php echo $surname ?>"> </td> 
                <td><span class="error">*<?php echo $surnameErr ?></span> </td></tr>

                <tr><td>Birth Year: </td> <td><input type="number" name="year" value="<?php echo $year ?>" max=2020> </td> 
                <td><span class="error">*<?php echo $yearErr ?></span> </td></tr>

                <tr><td>E-mail: </td> <td><input type="email" name="email" value="<?php echo $email ?>"> </td> 
                <td><span class="error">*<?php echo $emailErr ?></span> </td></tr>

                <tr><td>User Name: </td> <td><input type="text" name="userName" value="<?php echo $userName ?>"> </td> 
                <td><span class="error">*<?php echo $userNameErr ?></span> </td></tr>

                <tr><td>Password: </td> <td><input type="password" name="password" value="<?php echo $password ?>"> </td> 
                <td><span class="error">*<?php echo $passwordErr ?></span> </td></tr>

                <tr><td>Web Site: </td> <td><input type="url" name="webSite" value="<?php echo $webSite ?>"> </td> 
                <td> </td></tr>

                <tr><td>Gender: </td> <td><input type="radio" name="gender" value="male">Male 
                        <input type="radio" name="gender" value="female">Female </td> 
                <td><span class="error">*<?php echo $genderErr ?></span> </td></tr>

                <tr><td colspan="2"><input type="submit" name="btnSubmit" value="Kaydol" style="width:100%"></td><td></td><td></td></tr>
            </table>
            
        </form>
    </div>
    
</body>
</html>