$(document).ready(function() {

    fetchTasks();
    listLast();

    $(".reference").hide()

    $('#add_form').submit(e => {
        e.preventDefault();
        const postData = {
            title: $('#title').val(),
            textarea: $('#textarea').val()
        }
        let val
        if ($("#textarea").val().length < 50) {
            val = false;
            console.log(val)
        } else {
            val = true
            console.log(val)

        }

        if (val == false) {
            Swal.fire(
                '¡Cuidado!',
                'El articulo no puede contener menos de 50 caracteres',
                'error'
            )

        } else {
            Swal.fire({
                title: '¿Estas seguro de que quieres actualizar tu diario??',
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
                    listLast();
                    $('#add_form').trigger('reset');
                    Swal.fire(
                        'Agregado',
                        response,
                        'success'
                    )
                });
            })
        }
    });

    function fetchTasks() {
        $.ajax({
            url: 'list.php',
            type: 'GET',
            success: function(response) {
                let articulos = JSON.parse(response);
                console.log(response)
                let template = '';
                articulos.forEach(articulo => {


                    template += `
                    <div class="col h-100">
                        <div class="card text-white bg-primary" attr="${articulo.id}">
                            <div class="card-body">
                                <h5 class="card-title">${articulo.title}</h5>
                                <p class="card-text">${articulo.textarea}</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted" style="color: white !important;">${articulo.fecha}</small>
                                <button type="submit" class="my-btn btn btn-light" data-bs-toggle="modal" data-bs-target="#diarioModal">Ver</button>
                            </div>
                        </div>
                    </div>
                    `
                });
                $('.cards-container').html(template);

            }
        });
    }

    $(document).on('click', '.my-btn', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        console.log(elemento)
        let id = $(elemento).attr('attr');
        console.log(id)
        $.post('single.php', { id }, (response) => {
            console.log(response)
            const datosDiario = JSON.parse(response);
            $("#diarioTitle").html(datosDiario.titulo)
            $("#diarioText").html(datosDiario.texto)
            $("#diarioDate").html(datosDiario.fecha)
            $("#cuilPaciente").val(datosDiario.cuil)
            $("#recomendacion").html(datosDiario.recomendacion)
            $("#recomendacionText").html(datosDiario.recomendacion)


        });
        e.preventDefault();


    })

    function listLast() {
        $.ajax({
            url: 'lista-last.php',
            type: 'GET',
            success: function(response) {
                let lastArticulo = JSON.parse(response);
                console.log(response)
                let template = '';
                lastArticulo.forEach(articulo => {


                    template += `
                    <div class="card border-primary" attr="${articulo.id}">
                        <div class="card-body">
                            <h5 class="card-title">${articulo.title}</h5>
                            <p class="card-text">${articulo.textarea}</p>
                        </div>
                        <div class="card-footer border-primary">
                            <small class="text-muted">${articulo.fecha}</small>
                            <button type="submit" class="my-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#recomendacionModal">Ver Respuesta</button>
                        </div>
                    </div>
                    `
                });
                $('.lastArticulo').html(template);

            }
        });
    }

    // $(document).on('click', '.my-btn-last', (e) => {
    //     let elemento = $(this)[0].activeElement.parentElement.parentElement;
    //     console.log(elemento)
    //     let id = $(elemento).attr('attr');
    //     console.log(id)
    //     $.post('single.php', { id }, (response) => {
    //         console.log(response)
    //         const datosDiario = JSON.parse(response);
    //         $("#recomendacionText").html(datosDiario.recomendacion)


    //     });
    //     e.preventDefault();


    // })
});