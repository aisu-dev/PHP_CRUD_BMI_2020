<?php 

    $pdo;
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=phpexam','root','');
        echo 'connected';
    } catch (PDOException $e) {
        throw $e;
    }

?>