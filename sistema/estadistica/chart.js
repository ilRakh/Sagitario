$(document).ready(function() {
    fetchTasks()

    function fetchTasks() {
        $.ajax({
            url: 'list.php',
            type: 'GET',
            success: function(response) {
                console.log(response)
                $('#num1').val(response[2])
                $('#num2').val(response[6])
                $('#num3').val(response[10])
                $('#num4').val(response[14])
                $('#num5').val(response[18])
                $('#num6').val(response[22])
                $('#num7').val(response[26])
                $('#num8').val(response[30])
                $('#num9').val(response[34])
                let num1 = parseInt($('#num1').val())
                let num2 = parseInt($('#num2').val())
                let num3 = parseInt($('#num3').val())
                let num4 = parseInt($('#num4').val())
                let num5 = parseInt($('#num5').val())
                let num6 = parseInt($('#num6').val())
                let num7 = parseInt($('#num7').val())
                let num8 = parseInt($('#num8').val())
                let num9 = parseInt($('#num9').val())
                const data = {
                    labels: [
                        'Cancerígenas',
                        'Oftalmológicas',
                        'Odontológicas',
                        'Vacunación',
                        'Cardiacas',
                        'Fisicas(Fracturas, contusiones, etc)',
                        'Otologicas',
                        'Alimenticias',
                        'Psiquiatricas'
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [num1, num2, num3, num4, num5, num6, num7, num8, num9],
                        backgroundColor: [
                            'rgb(241, 148, 138)',
                            'rgb(195, 155, 211)',
                            'rgb(133, 193, 233)',
                            'rgb(118, 215, 196)',
                            'rgb(247, 220, 111)',
                            'rgb(240, 178, 122)',
                            'rgb(0, 126, 255)',
                            'rgb(236, 107, 215)',
                            'rgb(186, 5, 5)',
                        ],
                        hoverOffset: 4
                    }]
                };

                const config = {
                    type: 'pie',
                    data: data,
                };

                var myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );
            }
        });
    }



})