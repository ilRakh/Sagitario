$(document).ready(function() {

    fetchTasks();



    function fetchTasks() {
        $.ajax({
            url: 'list.php',
            type: 'GET',
            success: function(response) {
                let notificaciones = JSON.parse(response);
                let template = '';
                notificaciones.forEach(notificacion => {

                    if (notificacion.estado == 'Aceptada') {
                        template += `
                        <div class="alert alert-success alert-dismissible fade show" role="alert" attr= "${notificacion.id_user}" attr2="${notificacion.cuil_paciente}" attr3="${notificacion.id_noti}" attr4="${notificacion.tipo}" attr5="${notificacion.cuil_doctor}">
                            <strong>${notificacion.texto}</strong>
                            <small class="accept">${notificacion.estado}</small>

                        </div>
                        `
                    } else {
                        if (notificacion.estado == 'Rechazada') {
                            template += `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" attr= "${notificacion.id_user}" attr2="${notificacion.cuil_paciente}" attr3="${notificacion.id_noti}" attr4="${notificacion.tipo}" attr5="${notificacion.cuil_doctor}">
                                <strong>${notificacion.texto}</strong>
                                <small class="decline">${notificacion.estado}</small>

                            </div>
                            `
                        } else {
                            if (notificacion.tipo == 2) {
                                template += `
                            <div class="alert alert-primary alert-dismissible fade show" role="alert" attr= "${notificacion.id_user}" attr2="${notificacion.cuil_paciente}" attr3="${notificacion.id_noti}" attr4="${notificacion.tipo}" attr5="${notificacion.cuil_doctor}">
                                <strong>${notificacion.texto}</strong>
                                <a href="#"><i class='bx bxs-check-circle accept-icon'></i></a>
                            </div>
                            `
                            } else {

                                template += `
                                <div class="alert alert-primary alert-dismissible fade show" role="alert" attr= "${notificacion.id_user}" attr2="${notificacion.cuil_paciente}" attr3="${notificacion.id_noti}" attr4="${notificacion.tipo}" attr5="${notificacion.cuil_doctor}">
                                    <strong>${notificacion.texto}</strong>
                                    <a href="#"><i class='bx bxs-no-entry decline-icon'></i></a>
                                    <a href="#"><i class='bx bxs-check-circle accept-icon'></i></a>
                                </div>
                                `
                            }
                        }

                    }
                    if (notificacion.tipo == 2) {
                        $('.decline-icon').hide()
                    }

                });
                $('.notis').html(template);


            }
        });
    }
    $(document).on('click', '.decline-icon', (e) => {
        let elemento = $(this)[0].activeElement.parentElement;
        console.log(elemento)
        let cuil_paciente = $(elemento).attr('attr2')
        const Data = {
            cuil_paciente: cuil_paciente,
            estado: 'Rechazada',
            texto: 'Tu solicitud a sido rechazada',
            tipo: 3
        }

        const updateData = {
            id: $(elemento).attr('attr3'),
            estado: 'Rechazada'
        }
        Swal.fire({
            title: '¿Estas seguro de que quieres rechazar la cita?',
            icon: 'question',
            iconHtml: '?',
            confirmButtonText: 'Rechazar',
            cancelButtonText: 'Cancelar',
            showCancelButton: true,
            showCloseButton: true
        })
        $('.swal2-confirm').click(function() {
            $.post('notificar.php', Data, (response) => {
                console.log(response)


            });
            $.post('update.php', updateData, (response) => {
                fetchTasks();
                console.log(response)


            });
        })
        e.preventDefault();


    })


    $(document).on('click', '.accept-icon', (e) => {
        let elemento = $(this)[0].activeElement.parentElement;
        console.log(elemento)
        let cuil_paciente = $(elemento).attr('attr2')
        let tipo = $(elemento).attr('attr4')
        let texto = " "
        if (tipo == 2) {
            texto = "Se te a asignado un doctor"
        } else {
            texto = "Tu solicitud a sido aceptada"
        }
        const Data = {
            id_paciente: $(elemento).attr('attr'),
            cuil_paciente: cuil_paciente,
            estado: 'Aceptada',
            texto: texto,
            tipo: 3,
            tipo2: tipo
        }
        const updateData = {
            id_paciente: $(elemento).attr('attr'),
            id: $(elemento).attr('attr3'),
            estado: 'Aceptada'
        }
        Swal.fire({
            title: "¿Estas seguro de que quieres aceptar?",
            icon: 'question',
            iconHtml: '?',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            showCancelButton: true,
            showCloseButton: true
        })
        $('.swal2-confirm').click(function() {
            $.post('notificar.php', Data, (response) => {
                fetchTasks();
                console.log(response)


            });
            $.post('update.php', updateData, (response) => {
                fetchTasks();
                console.log(response)


            });
        });
        e.preventDefault();
    })


});