<template>
    <div>
        {{this.apartment.id}}
        Numero di messaggi = {{this.stat.n_messages}} <br>
        Numero di visualizzazioni = {{this.stat.n_views}} 
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
</template>

<script>

    const ctx = document.getElementById('myChart');

export default {

    data(){
        return{
        }
    },

    props: {

        apartment: Array,
        stat : Array,
    },

    mounted() {

        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
        datasets: [{
            label: '# of Votes',
            data: [this.stat.n_views, this.stat.n_messages],
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
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
    }
}
</script>
