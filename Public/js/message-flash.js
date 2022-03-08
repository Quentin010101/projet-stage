function initi(){
    const message = document.getElementById('message-flash')
    if(message){

        setTimeout(function(){
            disapear(message)
        }, 3000)

    }

    function disapear(element){
        element.classList.add('disapear')
        setTimeout(function(){
            element.style.display = 'none'
        }, 500)
    }

}

window.addEventListener('DOMContentLoaded', initi)