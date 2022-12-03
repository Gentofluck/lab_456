<?php
    session_start();
    if (isset($_SESSION['admin'])&&$_SESSION['admin']==true){
        require_once 'database.php';
        $db = new DB();
        $json = json_decode($_POST["all_files"], false);
        if (isset($_FILES['photo'])){
            if ($_FILES['photo']['tmp_name']){
                $fileTmpName = $_FILES['photo']['tmp_name'];
                $image = getimagesize($fileTmpName);
                $name = md5_file($fileTmpName);
                $extension = image_type_to_extension($image[2]);
                

                $format = str_replace('jpeg', 'jpg', $extension);
                $n = 'img/' . $name .$format;
                if (!move_uploaded_file($fileTmpName, $n)) {
                    $arr = array('answer' => 'При записи изображения на диск произошла ошибка');
                }
            }
            if(isset($_SESSION['id'], $json->name, $json->description, $json->size, $json->price, $n)){
                unlink($db->find_Flower($_SESSION['id'])['photo']);
                $db->change_Flower($_SESSION['id'], $json->name, $json->description, $json->size, $json->price, $n);
                $arr = array('answer' => true);
            }
        }
        else{
            if(isset($_SESSION['id'], $json->name, $json->description, $json->size, $json->price)){
                $db->change_Flower($_SESSION['id'], $json->name, $json->description, $json->size, $json->price, false);
                $arr = array('answer' => true);
            }
        }
        $db = null;
        echo json_encode($arr);
        exit;
    }
    else{
        header ('Location: error_404.php');
    }
?>