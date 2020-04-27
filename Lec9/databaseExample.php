<?php 
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "moviesdb";
    try{
        $connection = new PDO("mysql:host=$serverName;dbname=$databaseName",$userName,$password);
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "Connection Successful<br>";

        //$sql = "INSERT INTO movies(name, genre, year) VALUES ('Shrek 2', 'Animation', '2006')";
        //$connection->exec($sql);
        //echo "New record was created successfully";

        $sql = "SELECT * FROM movies";
        $result = $connection->query($sql);
        echo "Result was returned and rhere are " . $result->rowCount() . " rows.<br>";
        while($row = $result->fetch()){//fetch() gives one row
            echo $row['id'] . " " . $row['name'] . "    " . $row['genre'] . "   " . $row['year'] . "<br>";
        }
        $connection = null;
    }catch(PDOException $ex){
        echo "Connection Failed".$ex->getMessage();
    }
?>