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
    function readAll(){
        $sql = 'select * from user;';
        $resp = $this->pdo->query($sql)->fetchAll();
        return $resp;
    }
    function read($account){
        $sql = 'select * from user where email = "'.$account['email'].'" and password =  "'.$account['password'].'"';
        $resp = $this->pdo->query($sql)->fetch();
        return $resp;
    }
    function readByEmail($account){
        $sql = 'select * from user where email = "'.$account['email'].'"';
        $resp = $this->pdo->query($sql)->fetch();
        return $resp;
    }
    function insert($account){
        $check = $this->readByEmail($account);
        if(is_array($check)){
            return 'have this account.';
        }else{
            $sql = 'insert into user(name,email,password) values(:name,:email,:password);';
            $this->pdo->prepare($sql)->execute($account);
        }
    }

}

?>