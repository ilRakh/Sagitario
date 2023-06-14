$(document).ready(function() {



    console.log('jquery is working!');
    fetchAll();
    $('#task-result').hide();
    $('#lista-news').hide()
    $('#all').hide()



    


    function fetchAll() {
        $.ajax({
            url: 'list.php',
            type: 'GET',
            success: function(response) {
                const pacientes = JSON.parse(response);
                let template = '';
                let rol
                let alta

                pacientes.forEach(paciente => {
                    if(paciente.rol == 2){
                        rol = "Doctor"
                    }else{
                        rol = "Paciente"
                    }
                    if(paciente.alta == 0){
                        alta = "Inactivo"
                    }else{
                        alta = "Activo"
                    }

                    if (paciente.alta == 0) {
                        template += `
                    <tr class="reference" attr="${paciente.id_user}" attr2="${paciente.cuil}">
                    <td>${paciente.nombre}</td>
                    <td>${paciente.apellido}</td>
                    <td>${paciente.correo}</td>
                    <td>${paciente.cuil}</td>
                    <td>${rol}</td>
                    <td>${alta}</td>
                    <td>
                    <button type="button" class="paciente-item btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Dar Alta
                    </button>
                    </td>
                    </tr>
                  `
                    } else {

                        template += `
                        <tr class="reference" attr="${paciente.id_user}" attr2="${paciente.cuil}">
                        <td>${paciente.nombre}</td>
                        <td>${paciente.apellido}</td>
                        <td>${paciente.correo}</td>
                        <td>${paciente.cuil}</td>
                        <td>${rol}</td>
                        <td>${alta}</td>
                        </tr>
                      `
                    }


                });
                $('#pacientes-all').html(template);
            }
        });
    }

    function fetchNews() {
        $.ajax({
            url: 'list-news.php',
            type: 'GET',
            success: function(response) {
                const pacientes = JSON.parse(response);
                let template = '';
                let rol
                let alta
                pacientes.forEach(paciente => {
                    if(paciente.rol == 2){
                        rol = "Doctor"
                    }else{
                        rol = "Paciente"
                    }
                    if(paciente.alta == 0){
                        alta = "Inactivo"
                    }else{
                        alta = "Activo"
                    }
                    template += `
                    <tr class="reference" attr="${paciente.id_user}" attr2="${paciente.cuil}">
                    <td>${paciente.nombre}</td>
                    <td>${paciente.apellido}</td>
                    <td>${paciente.correo}</td>
                    <td>${paciente.cuil}</td>
                    <td>${rol}</td>
                    <td>${alta}</td>
                    <td>
                    <button type="button" class="paciente-item btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Dar Alta
                    </button>
                    </td>
                    </tr>
                  `

                });
                $('#pacientes-news').html(template);
            }
        });
    }

    $(document).on('click', '.paciente-item', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id = $(elemento).attr('attr');
        let cuil = $(elemento).attr('attr2');
        $('#id_user').val(id)
        $('#cuil').val(cuil)
    });

    $('#news').click(function() {
        $('#lista-all').hide()
        $('#lista-news').show()
        $('#news').hide()
        $('#all').show()
        fetchNews()

    })

    $('#all').click(function() {
        $('#lista-all').show()
        $('#lista-news').hide()
        $('#news').show()
        $('#all').hide()
    })

    $('#rol').change(function(){
        let rol = $(this);
        console.log(rol.val())
        if(rol.val() != "" && rol.val() != 0){
            rolAsignado = rol.val()
        }else{
            rolAsignado = 0
        }
    })



    $('#form').submit(e => {
        if(rolAsignado == 0){
            Swal.fire(
                'Error',
                response,
                'error'
            )
            e.preventDefault()

        }else{
            
            const postData = {
                rol: rolAsignado,
                id: $('#id_user').val(),
                cuil_paciente: $('#cuil').val()
            };
    
            Swal.fire({
                title: '¿Estas seguro de que quieres asginar este rol?',
                icon: 'question',
                iconHtml: '?',
                confirmButtonText: 'Enviar',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                showCloseButton: true
            })
            $('.swal2-confirm').click(function() {
                $.post('add.php', postData, (response) => {
                    console.log(response);
                    fetchAll();
                    fetchNews();
                    Swal.fire(
                        'Enviado',
                        response,
                        'success'
                    )
                });
            })
            e.preventDefault()
        }
    })


    
});