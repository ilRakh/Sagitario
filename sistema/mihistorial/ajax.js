$(document).ready(function() {


    fetchTasks();
    fetchHistory();

    function fetchTasks() {
        $.ajax({
            url: 'get.php',
            type: 'GET',
            success: function(response) {
                const datos = JSON.parse(response)
                console.log(datos.cuil_paciente)
                datos.forEach(dato => {
                    $('#cuilPaciente').val(dato.cuil_paciente);
                    $('#cuilDoctor').val(dato.cuil_doctor);
                });
            }
        });
    }

    $('#form').submit(e => {
        e.preventDefault();
        const postData = {
            texto: "El paciente con el cuil: " + $('#cuilPaciente').val() + " ha solicitado una cita medica contigo",
            cuil_paciente: $('#cuilPaciente').val(),
            cuil_doctor: $('#cuilDoctor').val()
        }
        console.log(postData.answer)
        Swal.fire({
            title: '¿Estas seguro de que quieres pedir una cita medica?',
            icon: 'question',
            iconHtml: '?',
            confirmButtonText: 'Enviar',
            cancelButtonText: 'Cancelar',
            showCancelButton: true,
            showCloseButton: true
        })

        $('.swal2-confirm').click(function() {
            $.post('add.php', postData, (response) => {
                fetchTasks();
                console.log(response)
                Swal.fire(
                    'Enviado',
                    response,
                    'success'
                )
            });
        })
    });


    function fetchHistory() {
        $.ajax({
            url: 'list.php',
            type: 'GET',
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
                    </tr>
                  `

                });
                $('#historial').html(template);
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

});