function init(){

    const input = document.getElementById('file')
    const fileName = document.getElementById('input-file-name')
    const fileSize = document.getElementById('input-file-size')
    
    input.addEventListener('change', function(event){

        const file = event.target.files

        fileName.innerText = 'nom: ' + file[0].name
        fileSize.innerText = 'taille: ' + file[0].size + ' ko'
    })

}

window.addEventListener('DOMContentLoaded', init)