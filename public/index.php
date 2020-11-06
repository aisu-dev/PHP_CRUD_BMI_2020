<?php 
// ?Variable
$cur = curl_init();
$info;
$err;
// ?Page
$page_action = isset($_GET['page'])?$_GET['page']:'home';
$page;
$title;

// !Check Page
if($page_action == 'home'){
    $title = 'Home';
    $page = '../template/index.html.php';
    curl_setopt($cur, CURLOPT_URL, 'http://localhost/PHP/PHP_CRUD_BMI_2020/API/info');
    curl_setopt( $cur, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($cur, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($cur);
    $res = json_decode($res,true);
    $info = $res;
}elseif($page_action == 'signin'&&!isset($_COOKIE['uid'])){
    $title = 'SIGNIN';
    $page = '../template/signin.html.php';
}elseif($page_action == 'signup'&&!isset($_COOKIE['uid'])){
    $title = 'SIGNUP';
    $page = '../template/signup.html.php';
}elseif($page_action == 'signout'){
    setcookie('uid','',-3600);
    header('location:index.php?page=home');
}elseif($page_action=='addBMI'){
    $title='ADD BMI';
    $page = '../template/addBMI.html.php';
}else{
    header('location: index.php?page=home');
}
// !Check Input:
if(isset($_POST['signin'])){
    if(isset($_POST['email'])&&$_POST['password']){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $c_email = preg_match('/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$email);
        $c_pass = preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,32}$/',$pass);
        if($c_email&&$c_pass){
            $account = array('email'=>$email,'password'=>$pass);
            $req = json_encode($account);
            curl_setopt($cur,CURLOPT_URL,'http://localhost/PHP/PHP_CRUD_BMI_2020/API/auth');
            curl_setopt($cur,CURLOPT_POSTFIELDS,$req);
            curl_setopt($cur, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cur,CURLOPT_POST,true);
            $res = curl_exec($cur);
            $res = json_decode($res,true);
            if(is_array($res)){
                setcookie('uid',$res['id'],time()+60*60);
                header('location: index.php?page=home');
            }else{
                $err = array(1=>'Please sign up');
            }
        }else{
            $err = array(1=>'incorect email or password.');
        }
    }else{
        $err = array(1=>'Require all input.');
    }
}elseif(isset($_POST['signup'])){
        if(isset($_POST['email'])&&$_POST['password']){
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $c_email = preg_match('/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$email);
            $c_pass = preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,32}$/',$pass);
            if($c_email&&$c_pass){
                $account = array('name'=>$_POST['name'],'email'=>$_POST['email'],'password'=>$_POST['password']);
                $req = json_encode($account);
                curl_setopt($cur,CURLOPT_URL,'http://localhost/PHP/PHP_CRUD_BMI_2020/API/auth');
                curl_setopt($cur,CURLOPT_POSTFIELDS,$req);
                curl_setopt($cur, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($cur,CURLOPT_POST,true);
                $res = curl_exec($cur);
                $res = json_decode($res,true);
                if($res){
                    $err = array(1=>$res);
                }else{
                    header('location: index.php?page=signin');
                }    
            }else{
                $err = array(1=>'incorrect email and password');
            }
        }else{
            $err = array(1=>'require all input');
        }
    
}
elseif(isset($_POST['create'])){
    if (isset($_COOKIE['uid'])&&isset($_POST['w'])&&isset($_POST['h'])) {
        
        $w = (float)$_POST['w'];
        $h = (float)$_POST['h'];
        $data_bmi = array('id'=>$_COOKIE['uid'],'height'=>$h,'weight'=>$w,'bmi'=>solveBMI($h,$w));
        $req = json_encode($data_bmi);
        curl_setopt($cur,CURLOPT_URL,'http://localhost/PHP/PHP_CRUD_BMI_2020/API/info');
        curl_setopt($cur,CURLOPT_POSTFIELDS,$req);
        curl_setopt($cur, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cur,CURLOPT_POST,true);
        $res = curl_exec($cur);
        $res = json_decode($res,true);
        print_r($res);
    }else{
        header('location: index.php?page=home');
    }
}

function solveBMI($height,$weight){
    return round($weight/($height*$height),2);
}
include('../template/layout.html.php');