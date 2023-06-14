$(document).ready(function() {



    console.log('jquery is working!');
    fetchTasks();
    $('#task-result').hide();

    $('#diagnostico').keyup(function() {
        if ($('#diagnostico').val() == "10") {
            console.log($('#diagnostico').val())
            $('#enfermedad').attr('type', 'text');
        } else {
            $('#enfermedad').val(" ")
            $('#enfermedad').attr('type', 'hidden');
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
                    <tr class="reference" attr="${paciente.id_user}" attr2="${paciente.cuil}">
                    <td>${paciente.nombre}</td>
                    <td>${paciente.apellido}</td>
                    <td>${paciente.cuil}</td>
                    <td>
                    <button type="button" class="paciente-item btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Diagnosticar
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
        let cuil = $(elemento).attr('attr2');
        $('#id').val(id)
        $('#cuil').val(cuil)
        console.log(id)
        e.preventDefault();


    })



    $('#answerForm').submit(e => {
        e.preventDefault();


        const postData = {
            diagnostico: $('#diagnostico').val(),
            id: $('#id').val(),
            cuil_paciente: $('#cuil').val()
        };
        const extraData = {
            diagnostico: $('#enfermedad').val(),
            id: $('#id').val(),
            cuil_paciente: $('#cuil').val()
        };


        if ($('#enfermedad').val().length > 0 && $('#diagnostico').val() == "10") {

            Swal.fire({
                title: '¿Estas seguro de que quieres enviar este diagnostico?',
                icon: 'question',
                iconHtml: '?',
                confirmButtonText: 'Enviar',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                showCloseButton: true
            })

            $('.swal2-confirm').click(function() {
                $.post('add_extra.php', extraData, (response) => {
                    console.log(response);

                });
            });

        } else {
            let val
            if ($("#diagnostico").val() == "9" || $("#diagnostico").val() == "8" || $("#diagnostico").val() == "7" || $("#diagnostico").val() == "6" || $("#diagnostico").val() == "5" || $("#diagnostico").val() == "4" || $("#diagnostico").val() == "3" || $("#diagnostico").val() == "2" || $("#diagnostico").val() == "1") {
                val = true;

            } else {
                val = false
                console.log(val)

            }

            if (val == false) {
                Swal.fire(
                    '¡Cuidado!',
                    'Inserta un numero valido',
                    'error'
                )

            } else {
                Swal.fire({
                    title: '¿Estas seguro de que quieres enviar este diagnostico?',
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
                        fetchTasks();
                        Swal.fire(
                            'Enviado',
                            response,
                            'success'
                        )

                    });
                })
            }

        }
    });


});