<?php 

class Users{

    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
        $sql = "CREATE TABLE IF NOT EXISTS user(
            id int auto_increment primary key not null,
            name varchar(255) not null,
            email varchar(255) not null,
            password varchar(255) not null
        )";
        $this->pdo->exec($sql);
    }

}

?>