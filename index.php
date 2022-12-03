<?php
    session_start();
    if (!isset($_SESSION['admin'])){
        $_SESSION['admin'] = false;
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/header_and_footer_style.css">
    <link rel="stylesheet" href="styles/one_form_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <title>Spb_flower</title>
    <script>
        <?php if (!(isset($_GET['id']))){?>
        window.setInterval(function(){
            let popular = document.getElementsByClassName('popular')[0];
            let element = document.createElement('section');
            element.className = 'popular';
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200){
                        element.innerHTML = JSON.parse(this.responseText).answer + '<a href="list.php" class="view_all but">Посмотреть все букеты</a>';
                        if(element.innerHTML!=popular.innerHTML){
                            popular.innerHTML = element.innerHTML;
                        }
                    }
                    else{
                        alert('Произошла ошибка на сервере, попробуйте повторить попытку');
                    }
                }
            };
            xmlhttp.open("GET", "every_2_import_all_bouqets.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(); 
        }, 2000);
        <?php }
        else{?>
        function get_one(id){
            function one_id(){
                let popular =  document.getElementsByTagName('main')[0];
                let element = document.createElement('main');
                json_par = {"id":id};
                n = JSON.stringify(json_par);
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200){
                            if (JSON.parse(this.responseText).answer!='error'){
                                element.innerHTML = JSON.parse(this.responseText).answer;
                                if(element.innerHTML!=popular.innerHTML){
                                    popular.innerHTML = element.innerHTML;
                                }
                            }
                            else{
                                window.location.href = "error_404.php";
                            }
                        }
                        else{
                            alert('Произошла ошибка на сервере, попробуйте повторить попытку');
                        }
                    }
                };
                xmlhttp.open("POST", "one_bouquet.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("id=" + n);
            }
            one_id();
            window.setInterval(one_id, 2000); 

        }
        <?php }?>
    </script>
</head>
<body>
    <?php
        if($_SESSION['admin']){
            print("<div class='gray_filter'>");
        }
        require_once 'header.html';
        if($_SESSION['admin']){
            print("</div>");
        }
    ?>
    <main>
        <?php 
            if (!(isset($_GET['id']))){
                if($_SESSION['admin']){
                    print("<div class='gray_filter'>");
                }
        ?>
        <section class="main space_between container">
            <div class="main_txt">
                <h1 id="h1" class="head_txt">Авторские букеты в <i>Петербурге</i></h1>
                <h3 class="h3_txt original_txt color_beige">Оригинальные свежие букеты с доставкой по всему городу</h2>
                <a href="#" class="main_but simple_txt">Смотреть каталог</a>
            </div>
            <img src="img/main_img.png" alt="main_img" id="main_img">
        </section>
        <section class="benifits container space_between">
            <div class="benefit_element">
                <div id="delivery_icon"></div>
                <div class="benifit_txt">
                    <h4 class="h4_name">Быстрая доставка</h3>
                    <p class="simple_txt color_beige">Можем создать букет и передать его в доставку всего за час.</p>
                </div>
            </div>
            <div class="benefit_element">
                <div id="flower_icon"></div>
                <div class="benifit_txt">
                    <h4 class="h4_name">Всегда свежие цветы</h3>
                    <p class="simple_txt color_beige">Тщательно следим за состоянием цветов, а опытные флористы отбирают для букетов каждый цветок.</p>
                </div>
            </div>
            <div class="benefit_element">
                <div id="photo_icon"></div>
                <div class="benifit_txt">
                    <h4 class="h4_name">Отправляем фото цветов</h3>
                    <p class="simple_txt color_beige">Перед доставкой сделаем фотографию букета и отправим вам.</p>
                </div>
            </div>
        </section>
        <?php 
            if($_SESSION['admin']){
                print("</div>");
            }
        ?>
        <section class="popular">
            <?php
                require_once 'all_bouqets_import.php';
            ?>
            <a href='list.php' class='view_all but'>Посмотреть все букеты</a>
        </section>
        <?php 
            if($_SESSION['admin']){
                print("<div class='gray_filter'>");
            }
        ?>
        <section class="sale container">
            <div class="sale_txt">
                <h2 class="h2_white head_txt">Скидка 10% на первый заказ</h2>
                <h3 class="simple_txt_white h3_txt">Если заказываете у нас букет впервые — при оформлении заказа введите промокод «Botanika2021» и получите скидку 10%.</h3>
            </div>
            <div id="sale_bouquet"></div>
        </section>
        <section class="container reviews">
            <h2 class="popular_h2" style="margin: 40px 0">Отзывы</h2>
            <div class="reviews_txt">
                <div class="one_review">
                    <p class="simple_txt color_beige" style="margin-bottom: 16px;">Всё очень понравилось! Быстрое оформление заказа, выбор удобного времени доставки. Всем большое спасибо!</p>
                    <h4 class="h4_name">Марина</h4>
                </div>
                <div class="one_review">
                    <p class="simple_txt color_beige" style="margin-bottom: 16px;">Внимательные флористы, вежливые. Магазин находится прям рядом с метро. Букет очень понравился, буду ещё заказывать!</p>
                    <h4 class="h4_name">Татьяна</h4>
                </div>
                <div class="one_review">
                    <p class="simple_txt color_beige" style="margin-bottom: 16px;">Выбор букетов на любой вкус и цену. Бывают хорошие скидки, а флористы всегда помогут и точно соберут красивый букет!</p>
                    <h4 class="h4_name">Ольга</h4>
                </div>
            </div>
        </section>
        <?php 
            if($_SESSION['admin']){
                echo "</div>";
            }
            }
            else{
                echo "<script>get_one(".$_GET['id'].")</script>";
            }
        ?>
    </main>
    <?php 
        if($_SESSION['admin']){
            print("<div class='gray_filter'>");
        }
        require_once 'footer.html';
        if($_SESSION['admin']){
            print("</div>");
        }
    ?>
</body>
</html>