<template>
<nav class="navbar ">
  <div class="container-fluid">
    <a class="navbar-brand">Dashboard</a>
  
<!-- Example split danger button -->
<div class="btn-group" >
  <button type="button" class="btn btn-success">My Account</button>
  <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
    <span class="visually-hidden">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Your Profile</a></li>
    <li><a class="dropdown-item" href="#">Logout</a></li>
   
  </ul>
</div>

  </div>
</nav>



    <div class="container mt-5">
        <div class="row">
            <!-- Donut Chart -->
            <div class="col-md-4 col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center ">Overview</h5>
                        <canvas style="height:250px; padding:5px;"id="donutChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Line Chart -->
            <div class="col-md-4 col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Message Reports</h5>
                        <canvas style="height:250px; padding:5px" id="lineChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Line Chart -->
            <div class="col-md-4 col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Contact Reports</h5>
                        <canvas style="height:250px; padding: 5px;" id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Doughnut, Line } from "vue-chartjs";
import { Chart, registerables } from "chart.js";

// Register the components globally

export default {
    name: "Charts",
    mounted() {
        // Donut Chart Configuration
        const donutCtx = document.getElementById("donutChart").getContext("2d");
        new Chart(donutCtx, {
            type: "doughnut",
            data: {
                labels: [
                    "Organisations",
                    "Departments",
                    "Groups",
                ],
                datasets: [
                    {
                        label: "Your Overall overview",
                        data: [12, 19, 3],
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
                responsive: true,
                maintainAspectRatio: true,
                
            },
        });

        // Line Chart Configuration
        const lineCtx = document.getElementById("lineChart").getContext("2d");
        new Chart(lineCtx, {
            type: "line",
            data: {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                ],
                datasets: [
                    {
                        label: "Messages",
                        data: [65, 59, 80, 81, 56, 55, 40],
                        fill: false,
                        borderColor: "rgba(75, 192, 192, 1)",
                        tension: 0.1,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        //bar configuration
        const barCtx = document.getElementById("barChart").getContext("2d");
        new Chart(barCtx, {
            type: "bar",
            data: {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                ],
                datasets: [
                    {
                        label: "Contacts",
                        data: [65, 59, 80, 81, 56, 55, 40],
                        fill: true,
                        borderColor: "rgba(75, 192, 192, 1)",
                        backgroundColor: "rgba(75, 192, 192, 1)",
                        tension: 0.1,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
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

<style scoped>
/* Custom styling to ensure responsiveness and alignment */
.card {
    height: 300px;
}

.card-body {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

canvas {
    max-width: 100%;
    height: auto;
    
}

.row {
    display: flex;
    justify-content: space-between;
}

@media (max-width: 768px) {
    .row {
        flex-direction: column;
    }
}
</style>
