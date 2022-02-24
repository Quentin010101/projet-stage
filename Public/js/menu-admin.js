function init(){

    const button = document.querySelectorAll('.wrapper h3')
    const wrapper = document.querySelectorAll('.wrapper')

    button.forEach( function(element){
        element.addEventListener('click', function(){

            wrapper.forEach(function(wrapperElement){
                if(wrapperElement.contains(element)){
                    wrapperElement.classList.toggle('shadow-class')
                }
            })
            element.nextElementSibling.classList.toggle('menu-open')
            element.querySelector('span').classList.toggle('rotate')


        })
    });
}

window.addEventListener('DOMContentLoaded', init)