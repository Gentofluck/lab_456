window.setInterval(function(){
    let popular = document.getElementsByClassName('popular')[0];
    let element = document.createElement('section');
    element.className = 'popular';
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200){
                element.innerHTML = JSON.parse(this.responseText).answer;
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