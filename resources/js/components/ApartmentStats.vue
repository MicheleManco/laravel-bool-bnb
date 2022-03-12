<template>
  <div class="chart-container">
    <h1>Statistiche</h1>
    <div class="chart-inner-container">
      <canvas id="myChart" width="400" height="200"></canvas>
    </div>
  </div>
</template>

<script>
const ctx = document.getElementById("myChart");

export default {
  props: {
    statistics: Array,
  },

  mounted() {
    const labels = [];
    const views = [];
    const messages = [];
    const mesi = [
      "Gennaio",
      "Febbraio",
      "Marzo",
      "Aprile",
      "Maggio",
      "Giugno",
      "Luglio",
      "Agosto",
      "Settembre",
      "Ottobre",
      "Novembre",
      "Dicembre",
    ];

    this.statistics.sort(function (a, b) {
      return new Date(b.updated_at) - new Date(a.updated_at);
    });

    this.statistics.forEach((stat) => {
      var date = new Date(stat.updated_at);
      var year = date.getFullYear();
      var month = date.getMonth();
      const label = `${mesi[month]} ${year}`;

      labels.push(label);
      views.push(stat.n_views);
      messages.push(stat.n_messages);
    });

    const ctx = document.getElementById("myChart");
    const myChart = new Chart(ctx, {
      type: "line",
      data: {
        labels,
        datasets: [
          {
            label: "Visite",
            data: views,
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)",
            ],
            borderColor: [
              "rgba(255, 99, 132, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(255, 206, 86, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(255, 159, 64, 1)",
            ],
            borderWidth: 1,
          },
          {
            label: "Messaggi",
            data: messages,
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)",
            ],
            borderColor: [
              "rgba(255, 99, 132, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(255, 206, 86, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(255, 159, 64, 1)",
            ],
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });
  },
};
</script>

<style lang="scss"scoped>
.chart-container {
  padding: 40px 0;
  width: 800px;
  max-width: 100%;
  margin: auto;
  min-height: 50vh;

  .chart-inner-container {}

  .text {
    flex-shrink: 0;
    width: 400px;
  }
  #myChart {
    margin-bottom: 80px;
  }
}
</style>