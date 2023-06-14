$(document).ready(function() {
    $('.contenedor-estadistica').hide()
    $('#btn-reset').hide()
    $('#back').hide()
    fetchTasks()
    fetchChart()
    let myChart;








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
                            <tr attr="${busqueda.id_user}"attr2="${busqueda.nombre}"attr3="${busqueda.apellido}"attr4="${busqueda.sexo}"attr5="${busqueda.cuil}">
                            <td>${busqueda.nombre}</td>
                            <td>${busqueda.apellido}</td>
                            <td>${busqueda.cuil}</td>
                            <td>
                            <button type="button" class="paciente-item btn btn-info" >
                                Ver Estadisticas
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
                    <tr class="reference" attr="${paciente.id_user}"attr2="${paciente.nombre}"attr3="${paciente.apellido}"attr4="${paciente.sexo}"attr5="${paciente.cuil}">
                    <td>${paciente.nombre}</td>
                    <td>${paciente.apellido}</td>
                    <td>${paciente.cuil}</td>
                    <td>
                    <button type="button" class="paciente-item btn btn-info">
                      Ver Estadisticas
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
        $('#mes').html(" ")

        $('#lista-pacientes').hide()
        $('#inputGroup-sizing-lg').hide()
        $('#search').hide()
        $('#back').show()
        $('.contenedor-estadistica').show()


        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id = $(elemento).attr('attr');
        let nombre = $(elemento).attr('attr2');
        let apellido = $(elemento).attr('attr3');
        let cuil_paciente = $(elemento).attr('attr5');

        $('#id_paciente').val(id)
        $('#cuil_paciente').val(cuil_paciente)
        $('.card-title').html(`${nombre}<br>${apellido}`)
        fetchChart()

        const getIndex = {
            id_paciente: $('#id_paciente').val()
        }
        $.post('count.php', getIndex, (response) => {
            const indice = JSON.parse(response);
            let index = parseInt(indice[0].index) - 1
            console.log(index)

            let op = parseInt(Math.random() * (10 - 1) + 1)
            let num = 5

            let meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre', 'Simulacion completa. Haz click en el voton de reinicio para volver a simular']
            let estado
            $("#mes").html(meses[index])
            $('#btn-reset').click(function() {
                num = 5
                index = -1
                $('#btn-flecha').show()
                $('#btn-reset').hide()
                $("#mes").html("Reiniciado")
                const postData = {
                    id_paciente: $('#id_paciente').val()

                }
                $.post('reset.php', postData, (response) => {
                    fetchChart()

                });

            })

            $(document).on('click', '#back', (e) => {
                window.location.reload();


            })

            $("#btn-flecha").click(function(e) {
                op = parseInt(Math.random() * (3 - 1) + 1)
                index = index + 1
                $("#mes").html(meses[index])
                console.log(meses[index])
                console.log(index)
                if (index >= 12) {
                    console.log("Simulacion terminada")
                    $('#btn-reset').show()
                    $('#btn-flecha').hide()
                } else {
                    if (op == 1 || num <= 0) {
                        if (num < 10) {
                            num = num + 1
                        } else {
                            num = num - 1
                        }
                        if (num == 0 || num == 1 || num == 2 || num == 3) {
                            estado = "Critico"
                        } else {
                            if (num == 4 || num == 5) {
                                estado = "Malo"
                            } else {
                                if (num == 6 || num == 7) {
                                    estado = "Regular"

                                } else {
                                    if (num == 8) {
                                        estado = "Bueno"

                                    } else {
                                        estado = "Excelente"

                                    }
                                }
                            }
                        }

                        const postData = {
                            datos: num,
                            estado: estado,
                            cuil_paciente: $('#cuil_paciente').val(),
                            id_paciente: $('#id_paciente').val()

                        }
                        $.post('add.php', postData, (response) => {
                            fetchChart()


                        });
                    } else {
                        num = num - 1
                        if (num == 0 || num == 1 || num == 2 || num == 3) {
                            estado = "Critico"
                        } else {
                            if (num == 4 || num == 5) {
                                estado = "Malo"
                            } else {
                                if (num == 6 || num == 7) {
                                    estado = "Regular"

                                } else {
                                    if (num == 8) {
                                        estado = "Bueno"

                                    } else {
                                        estado = "Excelente"

                                    }
                                }
                            }
                        }
                        const postData = {
                            datos: num,
                            estado: estado,
                            cuil_paciente: $('#cuil_paciente').val(),
                            id_paciente: $('#id_paciente').val()

                        }
                        $.post('add.php', postData, (response) => {
                            fetchChart()


                        });

                    }
                }


            })
        });

    })

    let datosChart = []

    $(document).on('click', '.paciente-item', (e) => {
        datosChart = []
    })


    function fetchChart() {
        const data = {
            id_paciente: $('#id_paciente').val()
        }

        $.ajax({
            url: 'list-chart.php',
            type: 'POST',
            data: data,
            success: function(response) {
                datosChart = []
                console.log(response)
                const pacientes = JSON.parse(response);
                pacientes.forEach(paciente => {
                    datosChart.push(parseInt(paciente.datos))
                    console.log(datosChart)

                });


                const labels = [
                    'Enero',
                    'Febrero',
                    'Marzo',
                    'Abril',
                    'Mayo',
                    'Junio',
                    'Julio',
                    'Agosto',
                    'Septiembre',
                    'Octubre',
                    'Noviembre',
                    'Diciembre',
                ];
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Evolucion del paciente',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: datosChart,
                    }]
                };

                const config = {
                    type: 'line',
                    data: data,
                    options: {}
                };

                if (myChart) {
                    myChart.destroy();
                }

                myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );



            }
        });
    }

})