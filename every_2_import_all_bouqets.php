<?php 
header("Content-Type: application/json; charset=UTF-8");
session_start();
require_once "database.php";
    $a='<h2 class="popular_h2">Популярные букеты</h2>
    <div class="popular_bouquets">';
    $db = new DB();
    $list = $db->import_All_flowers();
    while ($row = $list->fetch()) {
        $a=$a."<div class='popular_one_bouquet'> 
        <div class='ret_div'>
        <div class='popular_txt'>
            <h3 class='name'>".$row['name']."</h3>
            <p class='description'>".$row['description']."</p>
            <p class='size'>".$row['size']."</p>
            <h3 class='price'>".$row['price']." руб.</h3>
            <a href='index.php?id=".$row['id']."' class='but'>Заказать</a>
        </div>
        <img src='".$row['photo']."' class='photo'>
    </div>";
    ?> 
        <?php
            if($_SESSION["admin"]){
                $a = $a."<div class='admin_panel'>
                <a href='update.php?id=".$row['id']."' class='edit admin_but'>Редактировать</a>
                <a href='delete.php?id=".$row['id']."' class='delete admin_but'>Удалить</a>
            </div>";
            }
            $a=$a.'</div>';
            }
            if($_SESSION["admin"]){
                $a=$a."<a href='append.php' class='add admin_but'>Добавить новый букет</a>";
            }
            $a=$a."</div>";
            echo json_encode(array('answer'=>$a));
            $db=null;
            exit;
        ?>
