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
    <title>admin_delete_Flower_SPb</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/one_form_style.css">
    <link rel="stylesheet" href="styles/error_style.css">
    <script>
        function delete_by_id(id){
            json_par = {"id":id};
            n = JSON.stringify(json_par);
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200){
                        answ = JSON.parse(this.responseText).answer;
                        if(answ==true){
                            window.location.href = "index.php";
                        }
                        else{
                            alert (answ);
                        }
                    }
                    else{
                        alert('Произошла ошибка на сервере, попробуйте повторить попытку');
                    }
                }
            };
            xmlhttp.open("POST", "destroy.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id=" + n); 
        }
    </script>
</head>
<body>
    <?php
        require_once 'database.php';
        if (isset($_GET['id'])&& !empty($_GET["id"])){
            $db = new DB();
            $_SESSION['id'] = $_GET['id'];
            if($row = $db->find_Flower($_SESSION['id'])){
    ?>
        <div class="popular_one_bouquet">
            <div class="ret_div">
                <div class="popular_txt">
                <h3 class="name"><?php echo $row['name']?></h3>
                    <p class="description"><?php echo $row['description']?></p>
                    <p class="size" style="margin:24px 0;"><?php echo $row['size']?></p>
                    <h3 class="price"><?php echo $row['price']?> руб.</h3>
                    <a href="" class="but">Заказать</a>
                </div>
                <img src="<?php echo $row['photo']?>" class="photo">
            </div>
            <div class="admin_panel">
                <a href="index.php" class="edit admin_but">Назад</a>
                <button onclick="delete_by_id(<?php echo $row['id']?>); return false;" class="delete admin_but">Удалить</button>
            </div>
        </div>
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