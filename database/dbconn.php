<?php 

    $pdo;
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=phpexam','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        throw $e;
    }

?>