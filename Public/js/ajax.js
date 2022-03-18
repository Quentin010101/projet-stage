

//--------Input Section set
let inputNom = document.getElementById('nom').value
let inputVille = document.getElementById('ville')
let inputCode = document.getElementById('code')
let inputLat = document.getElementById('lat')
let inputLong = document.getElementById('long')


let arr = [inputNom, inputVille, inputCode, inputLat, inputLong];
//-------------------

//Apparition section
const button_set = document.getElementById('button-set')
const section_set = document.getElementById('lieux-set')
const button_modify = document.getElementById('button-modify')
const section_modify = document.getElementById('lieux-modify')
if(button_set){
    button_set.addEventListener('click', function () {
        section_set.classList.remove('hidden')
        arr.forEach(function (element) {
            element.value = ''
            element.previousElementSibling.classList.remove('span-invalidate')
        })
    })
}
if(button_modify){
    button_modify.addEventListener('click', function () {
        section_modify.classList.remove('hidden')
    })
}

//Disparition section
const close_set = document.querySelector('#lieux-set .fa-close')
if(close_set){
    close_set.addEventListener('click', function () {
        section_set.classList.add('hidden')
    })
}


// Ajout Lieux
const button_validate_set = document.querySelector('.button-validate-set')

const select = document.getElementById('lieux')

//Ajax Ajout Lieux
if(button_validate_set){
button_validate_set.addEventListener('click', function () {
    let url = '/lieux'
    //Formulaire :

    let xmlHttp = new XMLHttpRequest();

    let validation = true;
    arr.forEach(function (element) {
        if (element.value == '') {
            validation = false
            element.previousElementSibling.classList.add('span-invalidate')
        } else {
            element.previousElementSibling.classList.remove('span-invalidate')

        }
    })

    if (validation) {
        let postObj = {
            nom: inputNom.value,
            ville: inputVille.value,
            code: inputCode.value,
            lat: inputLat.value,
            long: inputLong.value
        }


        let post = JSON.stringify(postObj)

        xmlHttp.open("POST", url, true)
        xmlHttp.setRequestHeader("Content-Type", "application/json");

        xmlHttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                let regex = /option/
                if (regex.test(this.responseText)) {
                    select.innerHTML = this.responseText
                }

                section_set.classList.add('hidden')

            }
        }
        xmlHttp.send(post)

        arr.forEach(function (element) {
            element.value = ''
        })
    }

})
}


function close_modify() {
    section_modify.classList.add('hidden')
}
function b_v_modify(e) {


    let url = '/lieux/modify'
    let container_ajax_modify = document.querySelector('#lieux-modify .overlay')

    let xmlHttp = new XMLHttpRequest();

    let validation = true;
    e.parentElement.parentElement.parentElement.querySelectorAll('input').forEach(function (element) {
        if (element.value == '') {
            validation = false
            element.previousElementSibling.querySelector('span').classList.add('span-invalidate')
        } else {
            element.previousElementSibling.querySelector('span').classList.remove('span-invalidate')

        }
    })
    let i_m_nom = e.parentElement.parentElement.parentElement.querySelector('.nom-modify')
    let i_m_ville = e.parentElement.parentElement.parentElement.querySelector('.ville-modify')
    let i_m_code = e.parentElement.parentElement.parentElement.querySelector('.code-modify')
    let i_m_lat = e.parentElement.parentElement.parentElement.querySelector('.lat-modify')
    let i_m_long = e.parentElement.parentElement.parentElement.querySelector('.long-modify')
    let i_m_id = e.parentElement.parentElement.parentElement.querySelector('.id-modify')

    if (validation) {
        let postObj = {
            nom: i_m_nom.value,
            ville: i_m_ville.value,
            code: i_m_code.value,
            lat: i_m_lat.value,
            long: i_m_long.value,
            id: i_m_id.value
        }


        let post = JSON.stringify(postObj)

        xmlHttp.open("POST", url, true)
        xmlHttp.setRequestHeader("Content-Type", "application/json");

        xmlHttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                let regex = /input/
                if (regex.test(this.responseText)) {
                    container_ajax_modify.innerHTML = this.responseText
                    section_modify.classList.add('hidden')
                    updateSelet()
                }

                // section_set.classList.add('hidden')

            }
        }
        xmlHttp.send(post)

    }

}
function b_delete(e) {

    let url = '/lieux/delete'
    let container_ajax_modify = document.querySelector('#lieux-modify .overlay')

    let xmlHttp = new XMLHttpRequest();

    let validation = true;
    e.parentElement.parentElement.querySelectorAll('input').forEach(function (element) {
        if (element.value == '') {
            validation = false
            element.previousElementSibling.classList.add('span-invalidate')
        } else {
            element.previousElementSibling.classList.remove('span-invalidate')

        }
    })
    let i_m_id = e.parentElement.parentElement.parentElement.querySelector('.id-modify')

    if (validation) {
        let postObj = {
            id: i_m_id.value
        }


        let post = JSON.stringify(postObj)

        xmlHttp.open("POST", url, true)
        xmlHttp.setRequestHeader("Content-Type", "application/json");

        xmlHttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let regex = /input/

                if (regex.test(this.responseText)) {
                    container_ajax_modify.innerHTML = this.responseText
                    section_modify.classList.add('hidden')
                    updateSelet()
                }

                // section_set.classList.add('hidden')

            }
        }
        xmlHttp.send(post)

    }

}
function b_modify(e) {
    e.parentElement.parentElement.previousElementSibling.classList.remove('hidden')
    e.parentElement.parentElement.querySelectorAll('button').forEach(function (element) {
        element.classList.toggle('hidden')
    })
}
function b_cancel(e) {
    e.parentElement.parentElement.previousElementSibling.classList.add('hidden')
    e.parentElement.parentElement.querySelectorAll('button').forEach(function (element) {
        element.classList.toggle('hidden')
    })
}
function updateSelet() {
    let url = '/lieux/update'
    //Formulaire :

    let xmlHttp = new XMLHttpRequest();

    xmlHttp.open("POST", url, true)
    xmlHttp.setRequestHeader("Content-Type", "application/json");

    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            let regex = /option/
            if (regex.test(this.responseText)) {
                select.innerHTML = this.responseText
            }

            // section_set.classList.add('hidden')

        }
    }
    xmlHttp.send()

}


//Selection
const divLieux = document.getElementById('container-lieux-selected')

function iconClose(element){
        element.parentElement.remove()
} 



if(select){
    select.addEventListener('change', function(){
        if(select.value !== ''){
            const div_cont = document.createElement('div')
            divLieux.appendChild(div_cont)

            const hiddenInput = document.createElement('input')
            hiddenInput.setAttribute('type', 'hidden') 
            hiddenInput.setAttribute('name', 'lieux[]') 
            hiddenInput.setAttribute('value', select.options[select.selectedIndex].value) 

            const lieu = document.createElement('p')
            lieu.innerHTML = select.options[select.selectedIndex].innerHTML

            const text1 = document.createElement('p')
            text1.innerText = 'Le: '
            const text2 = document.createElement('p')
            text2.innerText = 'à: '

            const date = document.createElement('input')
            date.setAttribute('type', 'date')
            date.setAttribute('name', 'date[]')

            const time = document.createElement('input')
            time.setAttribute('type', 'time')
            time.setAttribute('name', 'time[]')

            const close_i = document.createElement('i')
            close_i.setAttribute('onclick', 'iconClose(this)')
            close_i.classList.add('fas')
            close_i.classList.add('fa-close')

            div_cont.appendChild(hiddenInput)
            div_cont.appendChild(lieu)
            div_cont.appendChild(text1)
            div_cont.appendChild(date)
            div_cont.appendChild(text2)
            div_cont.appendChild(time)
            div_cont.appendChild(close_i)

            select.selectedIndex = 0
        }
    })
}