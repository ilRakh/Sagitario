$(document).ready(function() {
    fetchChart()
    let myChart;
    let datosChart = []


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