if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

const formulario = document.getElementById('formSignup');
const inputs = document.querySelectorAll('.input-signup');

const expresiones = {
    name: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apellido: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    pass: /^.{3,20}$/, // 4 a 12 digitos.
    email: /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    cuil: /^\b(20|23|24|27)(\D)?[0-9]{8}(\D)?[0-9]$/ // Cuil real.
}

const campos = {
    apellido: false,
    name: false,
    pass: false,
    email: false,
    cuil: false
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "apellido":
            validarCampo(expresiones.apellido, e.target, 'apellido');
            break;
        case "name":
            validarCampo(expresiones.name, e.target, 'name');
            break;
        case "pass":
            validarCampo(expresiones.pass, e.target, 'pass');
            break;
        case "email":
            validarCampo(expresiones.email, e.target, 'email');
            break;
        case "cuil":
            validarCampo(expresiones.cuil, e.target, 'cuil');
            break;
    }
}

const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        $('#' + campo).removeClass('input-signup-error')
        $('#' + campo).removeClass('sinput-signup')
        $('#' + campo).addClass('input-signup-success')
        campos[campo] = true;
    } else {
        $('#' + campo).addClass('input-signup-error')
        $('#' + campo).removeClass('sinput-signup')
        $('#' + campo).removeClass('input-signup-success')
        campos[campo] = false;
    }
}


inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});



formulario.addEventListener('submit', (e) => {
    e.preventDefault();

    const postData = {
        name: $("#name").val(),
        apellido: $("#apellido").val(),
        email: $("#email").val(),
        cuil: $("#cuil").val(),
        pass: $("#pass").val()
    }

    let txt = ""
    let msg = ""

    if (campos.apellido && campos.name && campos.pass && campos.email && campos.cuil) {
        $('#name').removeClass('input-signup-success')
        $('#name').addClass('input-signup')
        $('#apellido').removeClass('input-signup-success')
        $('#apellido').addClass('input-signup')
        $('#email').removeClass('input-signup-success')
        $('#email').addClass('input-signup')
        $('#cuil').removeClass('input-signup-success')
        $('#cuil').addClass('input-signup')
        $('#pass').removeClass('input-signup-success')
        $('#pass').addClass('input-signup')


        $.post('backend/reg.php', postData, function(response) {
            console.log("enviando")
            console.log(response)
            if (response == "No se permiten campos vacios" || response == "Ya tienes una cuenta, ¡logeate!") {
                Swal.fire(
                    '¡Error!',
                    response,
                    'error'

                )
            } else {
                Swal.fire(
                    'Bienvenido',
                    response,
                    'success'
                )
                formulario.reset();
            }
        })
    } else {
        Swal.fire(
            '¡Error!',
            'Hay campos invalidos',
            'error'

        )
    }
});