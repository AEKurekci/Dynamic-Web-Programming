<?php
    session_start();
    error_reporting(0);
    $server = "localhost";
    $userName = "root";
    $password = "";
    $db = "mobilephonedb";
    
    try{
        $connect = new PDO("mysql:host=$server;dbname=$db",$userName,$password);
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } 
    catch(PDOException $ex){
        print "Connection Failed" . $ex->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexStyle.css">
    <title>Tuval Mobile Phone</title>
</head>
<body>
    <script src="mobilePhone.js"></script>
    <nav>
        <ul class="topMenu">
            <a href="#" ><img src="image/logo.png" alt=""></a>
            <li><a href="#">Anasayfa</a></li>
            <li><a href="#sepetim">Sepetim</a></li>
            <li><a href="userRegister.php">Kaydol</a></li>
            <li><a href="#">Giriş Yap</a></li>
            <li><a href="#">Güvenli Çıkış</a></li>
        </ul>
    </nav>
        <header id="best" class="best">
        <h3 style="text-align: center; color: rgb(158, 168, 187);">Öne Çıkan Ürün!</h3>
        
        </header>
    <div class="flex-container">
        <div class="filtreleme" style="flex-grow: 1">
            <ul>
                <h4><li>Filtrele</li></h4>
                <li><a href="#">Marka</a></li>
                <li><a href="#">Model</a></li>
                <li><a href="#">Screen</a></li>
                <li><a href="#">Kamera</a></li>
                <li><a href="#">İşlemci</a></li>
                <li><a href="#">Ram</a></li>
                <li><a href="#">Hafıza</a></li>
                <li><a href="#">Batarya</a></li>
                <li><a href="#">İşletim Sistemi</a></li>
                <li><a href="#">Fiyat</a></li>
            </ul>        
        </div>
        <section id="allProducts" style="flex-grow: 2">
            
        </section>
    </div>
    
    
    <footer>
        
        <!-- sepet-->
        <div class="sepet" id="sepetim">
            <h3 style="text-align: center; color: rgb(12, 32, 23);">Sepetiniz</h3>
            
        </div>

        <div id="buyDiv" class="payButtons">
            <p id="totalCost" style="color: aliceblue; margin-right: 20px;"></p>
            <button id="buy"style="margin-right: 20px;" onclick="document.getElementById('paymentType').style.visibility='visible'">Satın Al</button> 
            <button id="continue" style="margin-right: 20px;" ><a href="#allProducts">Alışverişe Devam Et</a></button> 
        </div>

        <div id="paymentType" class="payment">
            <h5>Ödeme Tipini Seçiniz</h5>
            <input type="radio" id="wire" name="odeme">
            <label for="wire">Elektronik Transfer</label><br>
            <input type="radio" id="credit" name="odeme" >
            <label for="credit" style="margin-right: 65px;">Kredi Kartı</label><br>
            
            <button type="button" onclick="document.getElementById('odemeBasariliAlert').style.visibility = 'visible';
            document.getElementById('paymentType').style.visibility = 'hidden';
            document.getElementById('buyDiv').style.visibility = 'hidden';
            var theLength = totalPrice.length
            for(var k = 0; k < theLength; k++){
                document.getElementById('sepetim').lastChild.remove();
                totalPrice.pop();                
            }">Öde
            </button>
        </div>
        <div id="odemeBasariliAlert" class="alert">
            <span class="closebtn" onclick="this.parentElement.style.visibility = 'hidden';">&times;</span> 
            Ödeme başarılı bir şekilde yapıldı! Siparişiniz kargoda.
        </div>
        
       
        <p style="background-color: beige; text-align: center; font-size: small;">Tuval Yazılım Copyright &copy;</p>
    </footer>

    <!--
        Ürünlerin oluşturulması ve ana ekrana yerleştirilmesi
    -->
    <script>
        var products = [];
        <?php 
            $sql = "Select * from products";
            $result = $connect->query($sql);
            $products = array();
            while($row=$result->fetch()){
                array_push($products,$row);
            }
            echo "var products = " . json_encode($products) . ";" ;
            $productLength = count($products);
        ?>
        console.log(products[0].brand);
        
        var counter = 0;
        var productLength = <?php echo $productLength ?>;
        var phoneList = new Array();
        for(var i = 0; i < productLength;i++){
                       
            phoneList.push(new phone(products[i].brand,products[i].model,
            products[i].screen,parseInt(products[i].camera),products[i].cpu,parseInt(products[i].ram),
            parseInt(products[i].memory),parseInt(products[i].battery),products[i].os,products[i].extra,
            parseInt(products[i].old_price),parseInt(products[i].price),products[i].picture_address));
        }

        var lengthOfList = phoneList.length;
        for(var i=0;i< lengthOfList; i++){
            var thePhone = phoneList[i];
            if(i == 0){
                placedBest(thePhone);
            }
            placedProduct(thePhone,i);
            counter = i;
        }
        
    </script>
</body>
</html>