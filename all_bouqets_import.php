<?php 
require_once "database.php";
?>
    <h2 class="popular_h2">Популярные букеты</h2>
    <div class="popular_bouquets">
    <?php
    $db = new DB();
    $list = $db->import_All_flowers();
    while ($row = $list->fetch()) {
    ?>
        <div class='popular_one_bouquet'> 
        <div class='ret_div'>
        <div class='popular_txt'>
            <h3 class='name'><?php echo $row['name'];?></h3>
            <p class='description'><?php echo $row['description'];?></p>
            <p class='size'><?php echo $row['size'];?></p>
            <h3 class='price'><?php echo $row['price'];?> руб.</h3>
            <a href='index.php?id=<?php echo $row['id'];?>' class='but'>Заказать</a>
        </div>
        <img src='<?php echo $row['photo'];?>' class='photo'>
    </div>
        <?php
            if($_SESSION["admin"]){
                ?>
                <div class='admin_panel'>
                <a href='update.php?id=<?php echo $row['id'];?>' class='edit admin_but'>Редактировать</a>
                <a href='delete.php?id=<?php echo $row['id'];?>' class='delete admin_but'>Удалить</a>
            </div>
            <?php
            }
            ?>
            </div>
            <?php
            }
            if($_SESSION["admin"]){
                ?>
                <a href='append.php' class='add admin_but'>Добавить новый букет</a>
            <?php
            }
            $db = null;
            ?>
            </div>