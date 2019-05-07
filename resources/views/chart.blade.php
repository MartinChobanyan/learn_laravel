<canvas id="{{ $id ?? $id = str_random(10) }}" width="350" height="250"></canvas>
@php
    $labels = $values = [];
    foreach ($data as $label => $value) {
        array_push($labels, $label);
        array_push($values, $value);
    }
@endphp
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script>
    var Chart = new Chart($("#{{ $id }}"), {
        type: "{{ $type ?? 'pie' }}",
        data: {
            labels: @json($labels),
            datasets: [{
                data: @json($values),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
    })
    function updateChart(){
        Chart.data.labels.forEach((label, i) => {
            let sum = 0;
            $('table tr').find('td:contains("' + label + '")').parent().map((j, el) => {
            sum += parseInt($(el).children('td#salary').text());
            });
            Chart.data.datasets[0].data[i] = sum;
        });
        Chart.update({
            duration: 1000,
            easing: 'easeOutSine'
        });
    }
</script>