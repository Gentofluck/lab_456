var src;
var name_photo;
var input;
let fileSelector = document.getElementById('photo');
    function openFile(event){
        input = event.target;
        name_photo = event.target.files[0].name;
        let reader = new FileReader();
        reader.onload = function(){
            src = reader.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
    function check(name, description, size, price, photo){
        if ((name.trim().length>40)||(name.trim().length<3)){
            alert ('Название должно быть длиной от 3 до 40 символов');
            return false;
        }
        if ((description.trim().length>120)||(description.trim().length<6)){
            alert ('Описание должно быть длиной от 6 до 120 символов');
            return false;
        }
        if ((size.trim().length>12)||(size.trim().length<3)){
            alert ('Размер должен быть длиной от 3 до 12 символов');
            return false;
        }
        if (price[0]=='0'){
            alert ('Цена не может начинаться с 0');
            return false;
        }
        if (price>99999999 || price<50){
            alert ('Цена должна быть от 50 до 99999999 символов и не содержать символов');
            return false;
        }
        if (photo.length>4){
            switch(photo.substr(-4, 4)){
                case '.jpg':
                    return true;
                case '.png':
                    return true;
                case '.svg':
                    return true;
                default:
                    if (photo.substr(-5, 5)=='.jpeg'){
                        return true;
                    }
                    alert ('Фото должно быть в формате .jpg, .png, .jpeg или .svg');
                    return false;
            }
        }


    }
    function preview(auto){
        if (!(name_photo)){
            src = auto;
            name_photo = auto;
        }
        if (check(document.getElementsByName('name')[0].value, document.getElementsByName('description')[0].value,document.getElementsByName('size')[0].value,document.getElementsByName('price')[0].value, name_photo)){
            div = createElement(document.getElementsByName('name')[0].value, document.getElementsByName('description')[0].value,document.getElementsByName('size')[0].value,document.getElementsByName('price')[0].value, src);
            alert_el = document.createElement ('div');
            alert_el.className = ' alert';
            alert_el.appendChild (div);
            but = document.createElement('button');
            but.className = 'exit'
            but.onclick = function(){
                let el = document.getElementsByClassName("alert")[0];
                el.parentNode.removeChild(el);
            };
            alert_el.appendChild (but);
            document.getElementsByTagName('body')[0].appendChild(alert_el);
        }
    }
    function change_db(auto, id){
        if (!(src)){
            name_photo = auto;
        }
        if (check(document.getElementsByName('name')[0].value, document.getElementsByName('description')[0].value,document.getElementsByName('size')[0].value,document.getElementsByName('price')[0].value, name_photo)){
            formData=new FormData();
            json_par = { "name":document.getElementsByName('name')[0].value, "description":document.getElementsByName('description')[0].value, "size":document.getElementsByName('size')[0].value, "price":document.getElementsByName('price')[0].value};
            formData.append ('photo', document.getElementById('photo').files[0]);
            var json = JSON.stringify(json_par);
            formData.append ('all_files', json);
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200){
                        answ = JSON.parse(this.responseText).answer;
                        if(answ==true){
                            window.location.href = "index.php?id="+id;
                        }
                        else{
                            alert(answ);
                        }
                    }
                    else{
                        alert('Произошла ошибка на сервере, попробуйте повторить попытку');
                    }
                }
            };
            xmlhttp.open("POST", "change.php", true);
            xmlhttp.send(formData); 
        }
    }
    
