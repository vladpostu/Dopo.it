
const loginButton = document.querySelector('#login_button');
const login = document.querySelector('.login');
const registerButton = document.querySelector('#register_button');
const register = document.querySelector('.register');
const grayLayer = document.querySelector('.gray-layer');
const closeButtons = document.querySelectorAll('.close-button');
const register_from_login = document.querySelector('#register_from_login');
const login_from_register = document.querySelector('#login_from_register');
const insert_ad_container = document.querySelector('.insert_ad_container');
const insert_ad = document.querySelector('#insert_ad');
const view_prod = document.querySelector('.view_prod');
const view_prod_close = document.querySelector('#view_prod_close');
const productsView = document.querySelectorAll('.product');

productsView.forEach(prod => {
    prod.addEventListener('click', () => {
        grayLayer.classList.add('gray-layer-active');
        view_prod.classList.add('active');
        document.querySelector('#prod_title').textContent = prod.getAttribute('title');
        document.querySelector('#prod_img').setAttribute('src', prod.getAttribute('img_src'));
        document.querySelector('#prod_cell').textContent = prod.getAttribute('cellphone');
        document.querySelector('#prod_city').textContent = prod.getAttribute('city');
        document.querySelector('#prod_price').textContent = '€' + prod.getAttribute('price');
    })
})

view_prod_close.addEventListener('click', () => {
    grayLayer.classList.remove('gray-layer-active');
    view_prod.classList.remove('active');
})

loginButton.addEventListener('click', () => {
    grayLayer.classList.add('gray-layer-active');
    login.classList.add('login-active');
});

registerButton.addEventListener('click', () => {
    grayLayer.classList.add('gray-layer-active');
    register.classList.add('register-active');
})

register_from_login.addEventListener('click', () => {
    login.classList.remove('login-active');
    register.classList.add('register-active');
})

login_from_register.addEventListener('click', () => {
    login.classList.add('login-active');
    register.classList.remove('register-active');
})

try {
    insert_ad.addEventListener('click', () => {
        grayLayer.classList.add('gray-layer-active');
        insert_ad_container.classList.add('active');
    })
} catch {
    
}

closeButtons.forEach(item => {
    item.addEventListener('click', () => {
        grayLayer.classList.remove('gray-layer-active');
        login.classList.remove('login-active');
        register.classList.remove('register-active');
        insert_ad_container.classList.remove('active');
    })
})

var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
});

