<template>
    <div>
        <!-- <button @click="generateGrafic(statistics_views)">
            views
        </button>

        <button @click="generateGrafic(statistics_messages)">
            message
        </button>

        {{statistics}} -->

        <canvas id="myChart" width="400" height="200"></canvas>
    </div>
</template>

<script>

    const ctx = document.getElementById('myChart');

export default {

    data(){
        return{

            statistics: this.statistics_views,

        }
    },

    props: {

        statistics_messages : Array,
        statistics_views : Array,
    },

    mounted() {

        console.log(this.statistics_messages);

        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
        type: 'line',
        data: {
        labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
        datasets: [
            {
            label: '# of viwes',
            data: this.statistics_views,
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
        },
        {
            label: '# of mwssages',
            data: this.statistics_messages,
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
    },

    methods: {

        // changeArray(statistics) {

        //     this.statistics = statistics;

        // },
        

    }
}
</script>
