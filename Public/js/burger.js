
function init(){
    const burger = document.querySelector('.burger i')
    const nav = document.querySelector('nav')

    burger.addEventListener('click', function(){
        nav.classList.toggle('menu')
    })
}

window.addEventListener('DOMContentLoaded', init)