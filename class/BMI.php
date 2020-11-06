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

    function readAll(){
        $sql = 'select * from bmi inner join user on bmi.uid = user.id';
        $resp = $this->pdo->query($sql)->fetchAll();
        return $resp;
    }

    function readByUID($id){
        $sql = 'select * from bmi where uid = '.$id;
        $resp = $this->pdo->query($sql)->fetch();
        return $resp;
    }

    function create($data){
        $res = $this->readByUID($data['id']);
        if($res){
            $sql = 'update bmi set height = :height , weight = :weight , bmi = :bmi where uid = :id';
            $this->pdo->prepare($sql)->execute($data);
        }else{
            $sql = 'insert into bmi(uid,height,weight,bmi) values(:id,:height,:weight,:bmi)';
            $this->pdo->prepare($sql)->execute($data);
        }
    }

}

?>