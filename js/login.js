$('#formLogin').submit(e => {
    e.preventDefault();
    const postData = {
        cuil: $('#cuilLogin').val(),
        pass: $('#passLogin').val()
    };
    $.post('backend/login.php', postData, (response) => {
        console.log(response);
        if (response == "Ingrese un usuario y contraseña" || response == "Cuil o Contraseña incorrectos") {
            Swal.fire(
                '¡Error!',
                response,
                'error'

            )
        } else {
            window.location.reload()
        }
    });
});