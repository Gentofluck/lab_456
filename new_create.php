<?php
    session_start();
    if (isset($_SESSION['admin'])&&$_SESSION['admin']==true){
        require_once 'database.php';
        $db = new DB();
        $id = $db->get_last_id() + 1;
        $json = json_decode($_POST["all_files"], false);
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
        else{
            $n = $_SESSION['photo'];
        }

        if(isset($id, $json->name, $json->description, $json->size, $json->price, $n)){
            try{
                $db->add_New_flower($id, $json->name, $json->description, $json->size, $json->price, $n);
                $arr = array('answer' => true, 'id'=>$id);
            }
            catch (PDOException $e){
                $arr = array('answer' => 'Букет с данным фото уже существует');
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