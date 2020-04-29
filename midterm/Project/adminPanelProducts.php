<?php 
    error_reporting(0);
    session_start();
    $server = "localhost";
    $userName = "root";
    $password = "";
    $db = "mobilephonedb";
    try{
        $connect = new PDO("mysql:host=$server;dbname=$db",$userName,$password);
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $sql = "Select * from products";
        $result = $connect->query($sql);
        while($row = $result->fetch()){
            echo "ürün" . $row;
        }
    }
        
    }catch(PDOException $ex){
        print "Connection Failed" . $ex->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="adminStyle.css">
</head>
<body>
    <h1>Ürün Listele <?php echo $_SESSION['admin']?></h1>
    <nav>
        <ul class="topMenu">
            <a href="#" ><img src="image/logo.png" alt=""></a>
            <li><a href="#">Ürün Listele</a></li>
            <li><a href="adminPanelAppend.php">Ürün Ekle</a></li>
            <li><a href="#allProducts">Ürün Güncelle</a></li>
            <li><a href="#">Ürün Sil</a></li>
            <li><a href="logOut.php" class="btnOut">Güvenli Çıkış</a></li>
        </ul>
    </nav>
    <div class="listProduct">
        
    </div>
    
</body>
</html>