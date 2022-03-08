function init(){

    const password = document.getElementById('password')
    const passwordConfirmation = document.getElementById('passwordConfirmation')
    const spanNumber = document.getElementById('span-check-num')
    const spanLetter = document.getElementById('span-check-letter')
    const spanCaractere = document.getElementById('span-check-carac')
    const formSubmit = document.getElementById('form-submit')
    const spanObligatoire = document.querySelectorAll('.obligation')
    const input = document.querySelectorAll('.input')

    password.addEventListener('input', updatePassword)
    input.forEach( function(element){
        element.addEventListener('input', function(){
            let inputValue = element.value 
            if(inputValue != ''){
                element.previousElementSibling.classList.remove('span-invalidate')
                element.previousElementSibling.classList.add('span-validate')
            }else{
                element.previousElementSibling.classList.remove('span-validate')
            }

        })
    })

    function updatePassword(){
        let passwordValue = password.value 

        let regexNum = /[0-9]/
        let regexLetter = /[a-zA-Z]/

        if(regexNum.test(passwordValue)){
            spanNumber.classList.add('span-validate')
        }else {
            spanNumber.classList.remove('span-validate')
        }

        if(regexLetter.test(passwordValue)){
            spanLetter.classList.add('span-validate')
        }else {
            spanLetter.classList.remove('span-validate')
        }

        if(passwordValue.length >= 6){
            spanCaractere.classList.add('span-validate')
        }else {
            spanCaractere.classList.remove('span-validate')
        }
    }


    function checkPassword(){
        let passwordValue = password.value 

        let regexNum = /[0-9]/
        let regexLetter = /[a-zA-Z]/

        let result = true

        if(!regexNum.test(passwordValue)){
            result = false
        }
        if(!regexLetter.test(passwordValue)){
            result = false
        }
        if(!passwordValue.length >= 6){
            result = false
        } 

        return result
    }

    function check(){

        let result = true

        for(let i = 0; i < spanObligatoire.length; i++){
            if(spanObligatoire[i].nextElementSibling.value == ''){
                spanObligatoire[i].classList.add('span-invalidate')
                result = false
            }else{
                spanObligatoire[i].classList.add('span-validate')
            }
        }

        return result
    }

    formSubmit.addEventListener('click', function(e){
        if(!check()){
            e.preventDefault()
        }
        if(!checkPassword()){
            e.preventDefault()
        }
        if(!checkPasswordConfirmation()){
            e.preventDefault()
        }

    })

    function checkPasswordConfirmation(){
        const confirmation = document.querySelector('.confirmation')
        let passwordValue = password.value
        let passwordConfirmationValue = passwordConfirmation.value

        let result = true

        if(passwordValue !== passwordConfirmationValue){
            confirmation.style.display = 'inline'
            result = false
        }

        return result
    }

}

window.addEventListener('DOMContentLoaded', init)