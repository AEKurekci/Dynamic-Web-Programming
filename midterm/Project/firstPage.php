<?php 
    error_reporting(0);
    session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $server = "localhost";
        $username = "root";
        $password = "";
        $db = "mobilephonedb";
        try{
            //creating db
            $conn = new PDO("mysql:host=$server", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE $db";
            
            $conn->exec($sql);
            echo "Database created successfully<br>";

            $conn = null;

            //creating tables
            $conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $sqlAdminCreate = "CREATE TABLE `admins` (
                `user_name` varchar(20) NOT NULL,
                `password` varchar(100) NOT NULL,
                `authority` enum('admin','super_admin') NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            $conn->exec($sqlAdminCreate);
            echo "Table admins created successfully<br>";

            $sqlInsertDefaultAdmin = "INSERT INTO `admins` (`user_name`, `password`, `authority`) VALUES
            ('root', '7b24afc8bc80e548d66c4e7ff72171c5', 'super_admin')";
            $conn->exec($sqlInsertDefaultAdmin);
            echo "root admin is inserted successfully<br>";

            $sqlProductTableCreate = "CREATE TABLE `products` (
                `id` int(11) NOT NULL,
                `brand` varchar(30) NOT NULL,
                `model` varchar(30) NOT NULL,
                `screen` varchar(50) NOT NULL,
                `camera` int(11) NOT NULL,
                `cpu` varchar(30) NOT NULL,
                `ram` int(11) NOT NULL,
                `memory` int(11) NOT NULL,
                `battery` int(11) NOT NULL,
                `os` varchar(30) NOT NULL,
                `extra` varchar(1000) NOT NULL,
                `old_price` int(11) NOT NULL,
                `price` int(11) NOT NULL,
                `picture_address` varchar(110) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $conn->exec($sqlProductTableCreate);
            echo "Table products created successfully<br>";

            $sqlInsertDefaultProducts = "INSERT INTO `products` (`id`, `brand`, `model`, `screen`, `camera`, `cpu`, `ram`, `memory`, `battery`, `os`, `extra`, `old_price`, `price`, `picture_address`) VALUES
            (1, 'Huawei', 'P10', '5.1inch', 20, 'Kirin 9', 4, 64, 3200, 'Android 9', 'Tamamen yenilenmiş Leica ön kamera, 2 kat fazla ışık yakalayarak gündüz veya gece fark etmeksizin muhteşem otoportreler çeker. HUAWEI P10, grup selfiesi çekildiğini fark ederek geniş açılı çekime geçiş yapar ve kadraja daha fazla insan girmesini sağlar. Leica tarzında eşsiz selfieler çekin.', 3500, 3000, 'image/huaweip10.jpg'),
            (3, 'Samsung', 'S8', '5.8 inch Full HD', 12, 'Snapdragon 835', 4, 64, 3500, 'Android 9', 'Sınırları aşan sonsuz ekran, iki tarafı kıvrımlı kesintisiz ve sürükleyici bir deneyim için yeni bir görüntüleme standardı sunuyor. Yüksek kasa-ekran oranı ile daha geniş ekran boyutunu, daha büyük bir telefona ihtiyaç olmadan size sunuyor. Böylece ekran boyutu büyürken, Galaxy S8 elinizde çok daha küçük hissediliyor.', 4000, 3500, 'image/samsungs8.jpg'),
            (4, 'Samsung', 'S7', '5.5 inch Full HD', 10, 'Snapdragon 765', 4, 32, 3500, 'Android 7', 'Sınırların zorlanarak en üst seviyede bir telefon üretildi. Herkesin ihtiyaçlarını karşılaması için düşünceleriniz değerlendirildi. Sınırları aşıp ileri doğru güçlü adımlar atarak önemli gelişmeler kaydettik. İhtiyaçlarınıza kulak verdik. Tasarım ve işlevselliği bir araya getirdik. Bugüne kadar akıllı telefonlarda hiç görmediğiniz ama bundan sonra onlarsız yapamayacağınız özellikler ekledik. Samsung S7 edge.', 3200, 3000, 'image/samsungs7.jpg'),
            (5, 'Iphone', '7', '5.5 inch Full HD', 12, 'A10 Fusion', 2, 256, 1960, 'IOS 10', 'iPhone 7 ile iPhone deneyiminiz en iyi hale gelecek. En önemli özellikler önemli ölçüde gelişiyor, değişiyor. Gelişmiş yepyeni kamera sistemleri, bir iPhone’da şimdiye kadar sunulan en iyi performans ve pil ömrü, etkileyici stereo hoparlörler, bugüne kadarki en canlı ve en renkli ekran, suya ve sıçramalara dayanıklı tasarım.Kısacası, her milimetresiyle çok güçlü bir telefon.', 3700, 3299, 'image/iphone7.jpg'),
            (6, 'Xiaomi', 'Mi 9T', '6.39 inch Full HD', 48, 'Snapdragon 855', 64, 64, 4000, 'Android 10', 'Teknoloji dünyasında yenilikçi cep telefon modelleri ile bilinen Xiaomi markası, gelişmiş teknolojik özelliklerle donatılmış Xiaomi Mi 9T 64 GB Duos ile yeniden ön plana çıkıyor. Çentik ekran tasarımına son vererek, ekran kullanılabilirliğini maksimize etmek için pop-up kamera ile telefon tasarımında yeni fikirlere öncülük ediyor. Telefona daha modern bir form kazandırarak ekranın tamamını kullanabilme beklentisini karşılayan marka, ayrıca güvenlik, rahat kullanım, performans ve verimlilik gibi gerekli diğer beklentileri de karşılıyor. Android 9.0 işletim sistemine ve MI UI kullanıcı ara yüzüne sahip akıllı cep telefonu kutu içerisinde, kullanım kılavuzu, sim kart iğnesi, şarj kablosu ve 18 Watt’lık hız şarj cihazı birde koruyucu kılıf ile birlikte geliyor.', 4700, 2700, 'image/xiaomiT9.jpg'),
            (8, 'Xiaomi', 'Mi 9T', '6.39 inch Full HD', 48, 'Snapdragon 855', 64, 64, 4000, 'Android 10', 'Teknoloji dünyasında yenilikçi cep telefon modelleri ile bilinen Xiaomi markası, gelişmiş teknolojik özelliklerle donatılmış Xiaomi Mi 9T 64 GB Duos ile yeniden ön plana çıkıyor. Çentik ekran tasarımına son vererek, ekran kullanılabilirliğini maksimize etmek için pop-up kamera ile telefon tasarımında yeni fikirlere öncülük ediyor. Telefona daha modern bir form kazandırarak ekranın tamamını kullanabilme beklentisini karşılayan marka, ayrıca güvenlik, rahat kullanım, performans ve verimlilik gibi gerekli diğer beklentileri de karşılıyor. Android 9.0 işletim sistemine ve MI UI kullanıcı ara yüzüne sahip akıllı cep telefonu kutu içerisinde, kullanım kılavuzu, sim kart iğnesi, şarj kablosu ve 18 Watt’lık hız şarj cihazı birde koruyucu kılıf ile birlikte geliyor.', 4700, 2700, 'image/xiaomiT9.jpg'),
            (10, 'Iphone', '7', '5.5 inch Full HD', 12, 'A10 Fusion', 2, 256, 1960, 'IOS 10', 'iPhone 7 ile iPhone deneyiminiz en iyi hale gelecek. En önemli özellikler önemli ölçüde gelişiyor, değişiyor. Gelişmiş yepyeni kamera sistemleri, bir iPhone’da şimdiye kadar sunulan en iyi performans ve pil ömrü, etkileyici stereo hoparlörler, bugüne kadarki en canlı ve en renkli ekran, suya ve sıçramalara dayanıklı tasarım.Kısacası, her milimetresiyle çok güçlü bir telefon.', 3700, 3299, 'image/iphone7.jpg')";

            $conn->exec($sqlInsertDefaultProducts);
            echo "Default products are inserted successfully<br>";

            $sqlUserTableCreate = "CREATE TABLE `users` (
                `id` int(255) NOT NULL,
                `name` varchar(30) NOT NULL,
                `surname` varchar(30) NOT NULL,
                `year` int(4) NOT NULL,
                `email` varchar(100) NOT NULL,
                `user_name` varchar(30) NOT NULL,
                `password` varchar(1000) NOT NULL,
                `web_site` varchar(500) NOT NULL,
                `gender` varchar(6) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            
            $conn->exec($sqlUserTableCreate);
            echo "Table users created successfully<br>";

            $sqlInsertDefaultUsers = "INSERT INTO `users` (`id`, `name`, `surname`, `year`, `email`, `user_name`, `password`, `web_site`, `gender`) VALUES
            (1, 'Ali Emre', 'Kürekci', 1997, 'aliemrekurekci@posta.mu.edu.tr', 'AEKurekci', 'c337415f941093f8416242495aa4c1cd', 'https://www.deneme.com', 'male')";

            $conn->exec($sqlInsertDefaultUsers);
            echo "Default users are inserted successfully<br>";

            $sqlIndex = "ALTER TABLE `admins`
            ADD UNIQUE KEY `user_name` (`user_name`)";
            $conn->exec($sqlIndex);
            echo "index 1<br>";

            $sqlIndex = "ALTER TABLE `products`
            ADD PRIMARY KEY (`id`)";
            $conn->exec($sqlIndex);
            echo "index 2<br>";

            $sqlIndex = "ALTER TABLE `users`
            ADD PRIMARY KEY (`id`),
            ADD UNIQUE KEY `user_name` (`user_name`)";
            $conn->exec($sqlIndex);
            echo "index 3<br>";

            $sqlIndex = "ALTER TABLE `products`
            MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14";
            $conn->exec($sqlIndex);
            echo "index 4<br>";

            $sqlIndex = "ALTER TABLE `users`
            MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2";
            $conn->exec($sqlIndex);
            echo "index 5<br>";

            echo "<script type='text/javascript'>alert('Database was created successfully');</script>";
            header("Location:index.php");

        }catch(PDOException $ex){
            echo $ex;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create DataBase</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <input type="submit" value="Create Database and Go Index.php">
    </form>
</body>
</html>