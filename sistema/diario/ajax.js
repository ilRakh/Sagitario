$(document).ready(function() {



    console.log('jquery is working!');
    fetchTasks();
    $('#task-result').hide();



    $('#search').keyup(function() {
        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: 'search.php',
                data: { search },
                type: 'POST',
                success: function(response) {
                    if (!response.error) {
                        let busquedas = JSON.parse(response);
                        let template = '';
                        busquedas.forEach(busqueda => {
                            template += `
                            <tr attr="${busqueda.id_user}">
                            <td>${busqueda.nombre}</td>
                            <td>${busqueda.apellido}</td>
                            <td>${busqueda.cuil}</td>
                            <td>
                            <button type="button" class="paciente-item btn btn-info" data-bs-toggle="modal" data-bs-target="#diarioModal">
                                Ver Diario
                            </button>
                            </td>
                            </tr>
                      `
                        });
                        $('#search-result').show();
                        $('#lista-pacientes').hide();
                        $('#container').html(template);
                    }
                }
            })
        }
    });


    function fetchTasks() {
        $.ajax({
            url: 'list.php',
            type: 'GET',
            success: function(response) {
                const pacientes = JSON.parse(response);
                let template = '';
                pacientes.forEach(paciente => {
                    template += `
                    <tr class="reference" attr="${paciente.id_user}">
                    <td>${paciente.nombre}</td>
                    <td>${paciente.apellido}</td>
                    <td>${paciente.cuil}</td>
                    <td>
                    <button type="button" class="paciente-item btn btn-info" data-bs-toggle="modal" data-bs-target="#diarioModal">
                      Ver Diario
                    </button>
                    </td>
                    </tr>
                  `

                });
                $('#pacientes').html(template);
            }
        });
    }

    $(document).on('click', '.paciente-item', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id = $(elemento).attr('attr');
        console.log(id)
        $.post('single.php', { id }, (response) => {
            const datosDiario = JSON.parse(response);
            $("#diarioTitle").html(datosDiario.titulo + " - " + datosDiario.nombre + " " + datosDiario.apellido)
            $("#diarioText").html(datosDiario.texto)
            $("#diarioDate").html(datosDiario.fecha)
            $("#cuilPaciente").val(datosDiario.cuil)
            $("#idDiario").val(datosDiario.id_diario)



        });
        e.preventDefault();


    })

    $('#answerForm').submit(e => {
        e.preventDefault();
        const postData = {
            answer: $('#answer').val(),
            cuilPaciente: $('#cuilPaciente').val(),
            idDiario: $('#idDiario').val()
        };
        console.log(postData.answer)
        let val
        if ($("#answer").val().length < 50) {
            val = false;
            console.log(val)
        } else {
            val = true
            console.log(val)

        }

        if (val == false) {
            Swal.fire(
                '¡Cuidado!',
                'No puede enviar una respuesta de menos de 50 caracteres',
                'error'
            )

        } else {
            Swal.fire({
                title: '¿Estas seguro de que quieres enviar esta respuesta?',
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
                    $('#answer').val(' ');
                    fetchTasks();
                    Swal.fire(
                        'Enviado',
                        response,
                        'success'
                    )
                });
            })
        }
    });
});