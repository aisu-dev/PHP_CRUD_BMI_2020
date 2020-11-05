<?php 

class BMI{

    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
        $sql = "CREATE TABLE IF NOT EXISTS bmi(
            id int auto_increment primary key not null,
            uid int not null,
            height float not null,
            weight float not null,
            bmi float not null,
            constraint fk_uid foreign key (uid) references user(id)
        )";
        $this->pdo->exec($sql);
    }

}

?>