<?php
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/header_and_footer_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/one_form_style.css">
    <title>Spb_flower</title>
    <script  src="every_2.js" defer></script>
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
        <section class="popular">
            <?php
                require_once 'all_bouqets_import.php';

            ?>
        </section>
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