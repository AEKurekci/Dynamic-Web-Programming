<?php
    session_start();
    error_reporting(0);
    $server = "localhost";
    $userName = "root";
    $password = "";
    $db = "mobilephonedb";
    if(!isset($_SESSION['admin'])){
        header("Location:adminLogin.php?Login=no");
    }
    try{
        $connect = new PDO("mysql:host=$server;dbname=$db",$userName,$password);
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        if(isset($_POST['btnInsert'])){
            $brand = $_POST['fBrand'];
            $model = $_POST['fModel'];
            $screen = $_POST['fScreen'];
            $camera = $_POST['fCamera'];
            $cpu = $_POST['fCPU'];
            $ram = $_POST['fRAM'];
            $memory = $_POST['fMemory'];
            $battery = $_POST['fBattery'];
            $OS = $_POST['fOS'];
            $Extra = $_POST['fExtra'];
            $oldPrice = $_POST['fOldPrice'];
            $price = $_POST['fPrice'];
            $picture = $_POST['fPicture'];
    
            $sql = "INSERT INTO products(brand, model, screen,camera,cpu,ram,memory,battery,os,extra,old_price,
            price,picture_address) VALUES('$brand','$model','$screen','$camera','$cpu','$ram','$memory','$battery','$OS','$Extra',
            '$oldPrice','$price','$picture')";
            $result = $connect->exec($sql);
            echo "Ürün Eklendi";
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
    <link rel="stylesheet" href="adminStyle.css">
    <script src="mobilePhone.js"></script>
</head>
<body>
    <h1>Admin Panel <?php echo $_SESSION['admin']?></h1>
    <h1>Ürün Ekle</h1>
    <nav>
        <ul class="topMenu">
            <a href="adminPanel.php" ><img src="image/logo.png" alt=""></a>
            <li><a href="adminPanel.php">Ürün Listele</a></li>
            <li><a href="adminPanelAppend.php">Ürün Ekle</a></li>
            <li><a href="#">Ürün Güncelle</a></li>
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
                        <th>Telefon Ekle</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td><label for="fBrand">Marka: </label></td>
                        <td><input type="text" id="fBrand" name="fBrand"></td>
                    </tr>
                    <tr>
                        <td><label for="fModel">Model: </label></td>
                        <td><input type="text" id="fModel" name="fModel"></td>
                    </tr>
                    <tr>
                        <td><label for="fScreen">Ekran: </label></td>
                        <td><input type="text" id="fScreen" name="fScreen"></td>
                    </tr>
                    <tr>
                        <td><label for="fCamera">Kamera: </label></td>
                        <td><input type="text" id="fCamera" name="fCamera"></td>
                    </tr>
                    <tr>
                        <td><label for="fCPU">İşlemci: </label></td>
                        <td><input type="text" id="fCPU" name="fCPU"></td>
                    </tr>
                    <tr>
                        <td><label for="fRAM">RAM: </label></td>
                        <td><input type="text" id="fRAM" name="fRAM"></td>
                    </tr>
                    <tr>
                        <td><label for="fMemory">Hafıza: </label></td>
                        <td><input type="text" id="fMemory" name="fMemory"></td>
                    </tr>
                    <tr>
                        <td><label for="fBattery">Batarya: </label></td>
                        <td><input type="text" id="fBattery" name="fBattery"></td>
                    </tr>
                    <tr>
                        <td><label for="fOS">İşletim Sistemi: </label></td>
                        <td><input type="text" id="fOS" name="fOS"></td>
                    </tr>
                    <tr>
                        <td><label for="fExtra">Ekstra Özellik: </label></td>
                        <td><input type="text" id="fExtra" name="fExtra"></td>
                    </tr>
                    <tr>
                        <td><label for="fOldPrice">Eski Fiyat: </label></td>
                        <td><input type="text" id="fOldPrice" name="fOldPrice"></td>
                    </tr>
                    <tr>
                        <td><label for="fPrice">Fiyat: </label></td>
                        <td><input type="text" id="fPrice" name="fPrice"></td>
                    </tr>
                    <tr>
                        <td><label for="fPicture">Fotoğraf Adresi: </label></td>
                        <td> <input type="text" id="fPicture" name="fPicture"><br></td>
                    </tr>
                    <tr>
                        <td>
                            
                        </td>
                        <td>
                            <input type="submit" name="btnInsert" value="Ekle">
                            
                        </td>
                    </tr>
                </table>
            </form>
            
        </div>

    
</body>
</html>