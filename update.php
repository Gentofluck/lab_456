<?php
    session_start();
    if (isset($_SESSION['admin'])&&$_SESSION['admin']==true){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/update_append_style.css">
    <link rel="stylesheet" href="styles/one_form_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <title>admin_update_Flower_SPb</title>
    <script src="createElement.js"></script>
    <script src="preview.js" defer></script>
</head>
<body>
    <?php
        require_once 'database.php';
        if (isset($_GET['id'])&& !empty($_GET["id"])){
            $db = new DB();
            $_SESSION['id'] = $_GET['id'];
            if ($row = $db->find_Flower($_SESSION['id'])){
    ?>
            <form class="update_form" enctype="multipart/form-data">
                <label for="name">Название: </label>
                <textarea maxlength="40" name="name" class="text_update"><?php echo $row['name']?></textarea>
                <label for="description">Описание: </label>
                <textarea maxlength="120" name="description" class="text_update"><?php echo $row['description']?></textarea>
                <label for="size">Размер: </label>
                <input type="text" maxlength="12" class="text_update" name="size" value="<?php echo $row['size']?>">
                <label for="price">Цена: </label>
                <input type="number" max="99999999" class="text_update" name="price" value="<?php echo $row['price']?>">
                <p style="margin: 0">Фото:</p>
                <label for="photo" class="text_update label_photo">Фото выбрано</label>
                <input type="file" accept="image/jpeg,image/png" name="photo" id="photo" onchange="openFile(event)">
                <div class="admin_panel">
                    <button id="prev" class="text_update admin_but delete" onclick="preview('<?php echo $row['photo']?>'); return false;">Предосмотр</button>
                    <button id="change" class="admin_but edit" onclick="change_db('<?php echo $row['photo']?>', <?php echo $row['id']?>); return false;">Изменить</button>
                </div>
                <a href="index.php" class="add admin_but">Назад</a>
                <?php $_SESSION['photo']=$row['photo'];?>
            </form>
            
    <?php
            }
            else{
                header ('Location: error_404.php');
            }
        }
        else{
            header ('Location: error_404.php');
        }

    ?>
</body>
</html>
<?php
        }
        else{
            header ('Location: error_404.php');
        }
?>