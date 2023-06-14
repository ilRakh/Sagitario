$(document).ready(function() {



    $('#h2').hide()
    $('#back').hide()
    $('#historial-paciente').hide()
    fetchTasks()

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
                            <button type="button" class="paciente-item btn btn-info" >
                                Ver Historial
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
                    <button type="button" class="paciente-item btn btn-info">
                      Ver Historial
                    </button>
                    </td>
                    </tr>
                  `

                });
                $('#pacientes').html(template);
            }
        });
    }

    function fetchHistory(id_paciente) {
        $.ajax({
            url: 'list_historial.php',
            data: { id_paciente },
            type: 'POST',
            success: function(response) {
                const historial = JSON.parse(response);
                let template = '';
                historial.forEach(historia => {
                    template += `
                    <tr attr="${historia.id_historial}">
                    <td>${historia.fecha}</td>
                    <td>${historia.razon}</td>
                    <td>${historia.conclusion}</td>
                    <td>${historia.estado}</td>
                    <td>
                    <button type="button" class="historial-item btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Rellenar Historial
                    </button>
                    </td>
                    </tr>
                  `

                });
                $('#historial').html(template);
            }
        });
    }


    $(document).on('click', '.paciente-item', (e) => {
        $('#lista-pacientes').hide()
        $('#inputGroup-sizing-lg').hide()
        $('#search').hide()
        $('#historial-paciente').show()
        $('#h2o').hide()
        $('#back').show()
        $('#h2').show()

        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id = $(elemento).attr('attr');
        $('#id_paciente').val(id)
        fetchHistory(id)

    })

    $(document).on('click', '#back', (e) => {
        $('#lista-pacientes').show()
        $('#inputGroup-sizing-lg').show()
        $('#search').show()
        $('#historial-paciente').hide()
        $('#h2o').show()
        $('#back').hide()
        $('#h2').hide()

    })

    $(document).on('click', '.historial-item', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id = $(elemento).attr('attr');
        $('#id_historial').val(id)
        console.log(id)

    })

    $('#form').submit(e => {
        e.preventDefault();
        const postData = {
            razon: $('#razon').val(),
            conclusion: $('#conclusion').val(),
            estado: $('#estado').val(),
            id: $('#id_historial').val()
        }
        let val1 = false
        let val2 = false
        let val3 = false
        if ($('#razon').val().length > 5) {
            val1 = true
            if ($('#conclusion').val().length > 10) {
                val2 = true
                if ($("#estado").val() == "Critico" || $("#estado").val() == "Malo" || $("#estado").val() == "Regular" || $("#estado").val() == "Bueno" || $("#estado").val() == "Excelente") {
                    val3 = true
                }
            }
        }
        console.log(val1)
        console.log(val2)
        console.log(val3)

        if (val1 == false) {
            Swal.fire(
                '¡Cuidado!',
                'Minimo 5 caracteres en "Razon".',
                'error'
            )

        } else {
            if (val2 == false) {
                Swal.fire(
                    '¡Cuidado!',
                    'Minimo 10 caracteres en "Conclusion".',
                    'error'
                )

            } else {
                if (val3 == false) {
                    Swal.fire(
                        '¡Cuidado!',
                        '"Estado" solo puede contener los valores especificados en rojo.',
                        'error'
                    )
                } else {
                    Swal.fire({
                        title: '¿Estas seguro de que quieres rellenar el historial?',
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
                            fetchHistory($('#id_paciente').val());
                            Swal.fire(
                                'Enviado',
                                response,
                                'success'
                            )
                        });
                    })
                }
            }



        }
    });

});