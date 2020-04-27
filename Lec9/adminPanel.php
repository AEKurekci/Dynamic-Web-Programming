<?php
    $server = "localhost";
    $userName = "root";
    $password = "";
    $db = "mobilephonedb";
    
    $user = $_POST['userName'];
    $pass = $_POST['password'];

    try{
        $connect = new PDO("mysql:host=$server;dbname=$db",$userName,$password);
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "Select * from admins";
        $result = $connect->query($sql);
        while($row = $result->fetch()){
            if($row['user_name'] == $user && $row['password'] == $pass){
                echo "Giriş Başarılı";
                break;
            }else{
                echo "Böyle bir admin yok!";
            }
        }
    }catch(PDOException $ex){
        print "Connection Failed" . $ex->getMessage();
    }
?>