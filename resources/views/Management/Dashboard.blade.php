<!DOCTYPE html>
<html lang="en">
<head>
    <title>DASHBOARD</title>

    <meta charset="UTF-8">

    <link href="../bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Design.css">
    <script src="../bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
<div class="container-fluid" ID="BG">
    @include ('../Navigation_UI/SideBar')
    <div class="container"  align="left">
        <div class="container" ID="blank"></div>
         <hr>
         <h1 align="left">DASHBOARD</h1>
         <h5>ORDER STATISTICS</h5>
         <div class="container" ID="Dash">
          <div class="col-6"><canvas id="myChart"></canvas></div>
          <div class="col-6" ID="DashCol">
          <h5>THIS MONTH</h5>
          <hr>
          <p>Number of Orders : 450 orders</p>
          <p>Average number of orders: 340 orders</p>
          <hr>
          </div>
        </div>
         <hr>
         <h5>SHOPS' STATISTICS</h5>
         <div class="container" ID="Dash">
          <div class="col-6"><canvas id="myChartBar"></canvas></div>
         <div class="col-6" ID="DashCol">
          <h5>THIS MONTH</h5>
          <hr>
          <p>Shops available : 92 Shops</p>
          <p>Average number of shops: 70 Shops</p>
          <hr>     
         </div>
         </div>
         <hr>
         <h5>PRODUCTS' STATISTICS</h5>
         <div class="container" ID="Dash">
          <div class="col-6" ID="DashCol"><canvas id="myChartItems"></canvas></div>
          <div class="col-6" ID="DashCol">
          <h5>THIS MONTH</h5>
          <hr>
          <p>Products available : 12564 products</p>
          <p>Average number of products: 11540 products</p>
          <hr>     
          </div>
         </div>
         <hr>
</div>
</body>
</html>

<script>
const xValues = [1,2,3,4,5,6,7,8,9,10,11,12];
const yValues = [234,355,219,199,254,367,377,261,399,433,346,455];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 100, max:500}}],
    }
  }
});
</script>

<script>
const aValues = ["Jan", "Feb", "Mar", "Apr", "May", "June",
                "July","Aug","Sept","Oct","Nov","Dec"
                ];
const bValues = [50, 69, 77, 75, 70, 65,79, 78, 72, 67,89,92];
const barColors = ["blue","gray","blue","gray","blue","gray",
                  "blue", "gray","blue","gray","blue","gray"
                  ];

new Chart("myChartBar", {
  type: "bar",
  data: {
    labels: aValues,
    datasets: [{
      backgroundColor: barColors,
      data: bValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
  }
});

const eValues = ["Jan", "Feb", "Mar", "Apr", "May", "June",
                 "July","Aug","Sept","Oct","Nov","Dec"
                ];
const dValues = [2340, 2456, 1323, 3475, 5570, 2465, 3479, 2378, 1172, 2367,4589,2592];

new Chart("myChartItems", {
  type: "bar",
  data: {
    labels: eValues,
    datasets: [{
      backgroundColor: barColors,
      data: dValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
  }
});

</script>

