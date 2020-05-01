<?php
    session_start();
    error_reporting(0);
    $server = "localhost";
    $userNameForDB = "root";
    $passwordForDB = "";
    $db = "mobilephonedb";
    if(!isset($_SESSION['admin'])){
        header("Location:adminLogin.php?Login=no");
    }

    $userName = "";
    $password = "";
    $authority = "";
    $userNameErr=$passwordErr=$authErr = "";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(empty($_POST['fUserName'])){
            $userNameErr = "Kullanıcı Adı Giriniz";
        }else{
            $userName = cleanProcess($_POST['fUserName']);
            if(!preg_match("/^[a-zA-Z üğÜĞİşŞçÇöÖ]*$/",$name)){
                $userNameErr = "Sadece boşluk ve karakterler kabul edilir";
            }else{
                $userNameErr ="";
            }
        }
        $passwordErr = empty($_POST['fPassword']) ? "Şifre Giriniz" : "";
        $authErr = empty($_POST['fAuthority']) ? "Yetkinlik Seçiniz" : "";
    }
    try{
        $connect = new PDO("mysql:host=$server;dbname=$db",$userNameForDB,$passwordForDB);
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        if(isset($_POST['btnInsert']) && $userNameErr == "" && $authErr == "" && $passwordErr == ""){
            if($_SESSION['auth'] != "super_admin"){
                echo "<script type='text/javascript'>alert('Yetkinlik Hatası! Admin Eklenmedi');</script>";
            }else{
                $password = md5($_POST['fPassword']);
                $authority = $_POST['fAuthority'];
    
                $sqlTest = "SELECT user_name FROM admins WHERE user_name='$userName'";
                $result = $connect->query($sqlTest);
                $row = $result->fetch();
                if($row['user_name'] != ""){
                    $userNameErr = "Kullanıcı adı zaten mevcut!";
                }else{
                    $sql = "INSERT INTO admins VALUES('$userName','$password','$authority')";
                    $result = $connect->exec($sql);
                    echo "<script type='text/javascript'>alert('Admin Eklendi');</script>";
                }
            }            
        }
        $adminName = $_SESSION['admin'];
        $sqlTest = "SELECT authority FROM admins WHERE user_name='$adminName'";
        $result = $connect->query($sqlTest);
        $row = $result->fetch();
        $_SESSION['auth'] = $row['authority'];
    }  
    catch(PDOException $ex){
        print "Connection Failed" . $ex->getMessage();
    }

    function cleanProcess($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    $connect = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles/adminStyle.css">
    <script src="mobilePhone.js"></script>
</head>
<body>
    <h1>Admin Panel <?php echo $_SESSION['admin']?></h1>
    <h1>Admin Oluştur</h1>
    <nav>
        <ul class="topMenu">
            <a href="adminPanel.php" ><img src="image/logo.png" alt=""></a>
            <li><a href="adminPanel.php">Ürün Listele</a></li>
            <li><a href="adminPanelAppend.php">Ürün Ekle</a></li>
            <li><a href="#" class="btnOut">Admin Ekle</a></li>
            <li><a href="logOut.php" class="btnOut">Güvenli Çıkış</a></li>
        </ul>
    </nav>
    <div class="newProduct">
            <!--
                ürün ekleme formu
            -->
            <form id="ekleForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <table id="tblEkle" style="width:50%;">
                    <tr>
                        <th>Admin Oluştur</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td><label for="fUserName">Kullanıcı Adı: </label></td>
                        <td><input type="text" id="fUserName" name="fUserName"></td>
                        <td><span class="error">*<?php echo $userNameErr ?></span> </td>
                    </tr>
                    <tr>
                        <td><label for="fPassword">Şifre: </label></td>
                        <td><input type="password" id="fPassword" name="fPassword"></td>
                        <td><span class="error">*<?php echo $passwordErr ?></span> </td>
                    </tr>
                    <tr>
                        <td>Yetkinlik: </td> <td><input type="radio" name="fAuthority" value="super_admin">Süper Admin
                            <input type="radio" name="fAuthority" value="admin">Admin </td> 
                        <td><span class="error">*<?php echo $authErr ?></span> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="btnInsert" value="Oluştur">
                        </td>
                    </tr>
                </table>
            </form>
            
        </div>

    
</body>
</html>