

const products = document.querySelectorAll('.product');
const input_search = document.querySelector('#input_search');
const search_result = document.querySelector('#search_result');

input_search.addEventListener('keyup', (e) => {
    search_result.textContent = e.target.value; 

    products.forEach(item => {
        item.classList.add('hide');
        if(item.textContent.toLocaleLowerCase().includes(e.target.value.toLowerCase())) {
            item.classList.remove('hide');
        }
    });

    if(e.target.value.length == 0) {
        products.forEach(item => {
            item.classList.remove('hide');
        })
    } 

})