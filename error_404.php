<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/error_style.css">
    <link rel="stylesheet" href="styles/header_and_footer_style.css">
</head>
<body>
    <head>
        <?php
        if (isset($_SESSION['admin'])&&$_SESSION['admin']==true){
            print("<div class='gray_filter'>");
        }
        require_once 'header.html';
        if (isset($_SESSION['admin'])&&$_SESSION['admin']==true){
            print("</div>");
        }
        ?>
    </head>
    <main>
    <div class="error_div">
        <h1 class="error_404">Ошибка 404</br>Страница не найдена</h1>
        <div class="close">
    </div>
    </main>
    <footer>
        <?php
            if (isset($_SESSION['admin'])&&$_SESSION['admin']==true){
                print("<div class='gray_filter'>");
            }
            require_once 'footer.html';
            if (isset($_SESSION['admin'])&&$_SESSION['admin']==true){
                print("</div>");
            }
        ?>
    </footer>
</body>
</html>
