<?php
        session_start();
        header("Content-Type: application/json; charset=UTF-8");
        require_once 'database.php';
        $db = new DB();
        $obj =  json_decode($_POST["id"], false);
        if (isset($obj->id)&&!empty($obj->id)){
            $db = new DB();
            $_SESSION['id'] = $obj->id;
            if($row = $db->find_Flower($_SESSION['id'])){
                $a='<div class="popular_one_bouquet" style="margin-bottom:50px">
                <div class="ret_div">
                    <div class="popular_txt">
                    <h3 class="name">'.$row['name'].'</h3>
                    <p class="description">'.$row['description'].'</p>
                    <p class="size" style="margin:24px 0;">'.$row['size'].'</p>
                    <h3 class="price">'.$row['price'].'руб.</h3>
                    <a href="" class="but">Заказать</a>
                </div>
                <img src="'.$row['photo'].'" class="photo"></div>';
            if($_SESSION["admin"]){
                $a = $a."<div class='admin_panel'>
                <a href='update.php?id=".$row['id']."' class='edit admin_but'>Редактировать</a>
                <a href='delete.php?id=".$row['id']."' class='delete admin_but'>Удалить</a>";
            }
            $arr = array('answer'=>$a.'</div>');
            }
            else{
                $arr = array('answer'=>'error');
            }
        }
        else{
            $arr = array('answer'=>'error');
        }
        $db = null;
        echo json_encode($arr);
        exit;
        ?>