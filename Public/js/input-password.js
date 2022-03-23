function init() {

    const password_eye = document.querySelectorAll(".fa-eye")


    password_eye.forEach(function (element) {
        element.addEventListener('mousedown', function () {
            if (element.parentElement.querySelector("input[type='password']")) {
                element.parentElement.querySelector("input[type='password']").type = "text"
                element.parentElement.querySelector(".fa-eye-slash").style.opacity = 1
                element.style.opacity = 0
            }
        })

        element.addEventListener('mouseup', function () {
            if (element.parentElement.querySelector("input[type='text']")) {
                element.parentElement.querySelector("input[type='text']").type = "password"
                element.parentElement.querySelector(".fa-eye-slash").style.opacity = 0
                element.style.opacity = 1
            }
        })
        element.addEventListener('mouseleave', function () {
            if (element.parentElement.querySelector("input[type='text']")) {
                element.parentElement.querySelector("input[type='text']").type = "password"
                element.parentElement.querySelector(".fa-eye-slash").style.opacity = 0
                element.style.opacity = 1
            }
        })
    })



}

window.addEventListener('DOMContentLoaded', init)