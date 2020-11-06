<?php 
// ?DATABASE CONNECTION
include('../database/dbconn.php');
// ?CLASS
include('../class/Users.php');
$_users = new Users($pdo);

header('Access-Control-Allow-Origin:*');
header('Content-Type: Application/json;charset=UTF-8');
header('Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE');
header('Access-Control-Max-Age:3600');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With');


$uri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

if($_SERVER['REQUEST_METHOD']=='GET'){  
    echo json_encode($_users->readAll());
}elseif($_SERVER['REQUEST_METHOD']=='POST'){
    $data = json_decode(file_get_contents('php://input'));
    $type = isset($data->name)?$data->name:'';
    if($type==''){
        $account = array('email'=>$data->email,'password'=>$data->password);
        $data = $_users->read($account);
        echo json_encode($data);
    }else{
        $account = array('name'=>$data->name,'email'=>$data->email,'password'=>$data->password);
        $data = $_users->insert($account);
        echo json_encode($data);
    }
}else{

}

?>