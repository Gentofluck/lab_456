<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reg_style.css">
    <title>Admin</title>
    <script>
        function check_reg(){
            json_par = { "login":document.getElementById('login').value, "password":document.getElementById('password').value };
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
            xmlhttp.open("POST", "input.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("user=" + n); 
        }
    </script>
</head>
<body>
    <form class="input_admin_form">
        <input type="text" name="login" id="login" class="simple_input" placeholder="введите логин">
        <input type="password" name="password" id="password"  class="simple_input" placeholder="введите пароль">
        <button class="to_index" onclick="check_reg(); return false;">Войти</button>
    </form>
</body>
</html>