<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once 'database.php';
    $db = new DB();
    $obj =  json_decode($_POST["user"], false);
    try{
        if($db->check($obj->login, $obj->password)){
            session_start();
            $_SESSION['admin'] = true;
            $arr = array('answer' => true);
        }
        else{
            $arr = array('answer' => 'Неверный логин или пароль');
        }
    }
    catch (PDOException $e){
        $arr = array('answer' => 'Произошла ошибка при проверке данных, попробуйте повторить попытку позже');
    }
    finally{
        $db=null;
        echo json_encode($arr);
        exit;
    }

?>