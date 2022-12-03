<?php
    session_start();
    if (isset($_SESSION['admin'])&&$_SESSION['admin']==true){
        header("Content-Type: application/json; charset=UTF-8");
        require_once 'database.php';
        $db = new DB();
        $obj =  json_decode($_POST["id"], false);
        unlink($db->find_Flower($obj->id)['photo']);
        try{
            $db->delete_flower($obj->id);
            $db=null;
            $arr = array('answer' => true);
        }
        catch (PDOException $e){
            $arr = array('answer' => 'Произошла ошибка при удалении, попробуйте повторить попытку позже');
        }
        finally{
            $db=null;
            echo json_encode($arr);
            exit;
        }
    }
    else{
        header ('Location: error_404.php');
    }
?>
