function createElement (name_content, description_content, size_content, price_content, src){

    let ret_div = document.createElement('div');
    ret_div.className = 'ret_div';

    let div = document.createElement('div');
    div.className = 'popular_txt';

    let name = document.createElement('h3');
    name.className = 'name';
    name.textContent = name_content;

    let description = document.createElement('p');
    description.className = 'description';
    description.textContent = description_content;

    let size = document.createElement('p');
    size.className = 'size';
    size.textContent = size_content;

    let price = document.createElement('h3');
    price.className = 'price';
    price.textContent = price_content+' руб.';

    let photo = document.createElement('img');
    photo.className = 'photo';
    photo.src = src;

    let but = document.createElement('a');
    but.textContent = "Заказать"
    but.className = "but"

    div.appendChild(name);
    div.appendChild(description);
    div.appendChild(size);
    div.appendChild(price);
    div.appendChild(but);

    ret_div.appendChild(div);
    ret_div.appendChild(photo);
    
    return ret_div;

}