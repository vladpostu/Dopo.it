

const categories = document.querySelectorAll('.category');
const productsCategories = document.querySelectorAll('.product');
const buttonsProd = document.querySelectorAll('.buy-button');


buttonsProd.forEach((button, i=0) => {
    if(button.getAttribute('isUserProd') == 'true') {
        productsCategories[i].setAttribute('isUserProd', 'true');
    }
})

categories.forEach((item, i=0) => {
    item.addEventListener('click', () => {
        categories.forEach(el => {
            el.classList.remove('category-selected');
        })
        item.classList.add('category-selected');

        productsCategories.forEach(product => {
            if(i == 0) {
                product.classList.remove('hide');
            } else if(i == 6) {
                product.classList.add('hide');
                if(product.getAttribute('isUserProd') == 'true') {
                    product.classList.remove('hide');
                }
            } 
            else {
                product.classList.add('hide');
                if (product.getAttribute('category') == i) {
                    product.classList.remove('hide');
                }
            }
        })
    })
})

function hideAt(n) {
    productsCategories[n].classList.add('hide');
}

function showAt(n) {
    productsCategories[n].classList.remove('hide');
}