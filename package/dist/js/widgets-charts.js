$(function () {
  // =====================================
  // widgest-chart-1
  // =====================================
  var options = {
    chart: {
      id: "widgest-chart-1",
      type: "area",
      height: 90,
      sparkline: {
        enabled: true,
      },
      group: "widgest-chart-1",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: '',
        color: "#6AAD45",
        data: [12, 254, 110, 548, 203, 209, 789, 236],
      },
    ],
    stroke: {
      curve: "straight",
      width: 2,
    },

    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 0,
        inverseColors: false,
        opacityFrom: 0.20,
        opacityTo: 0,
        stops: [0, 200],
      },
    },
  
    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#widgest-chart-1"), options).render();




  // =====================================
  // widgest-chart-2
  // =====================================
  var options = {
    series: [
      {
        name: "",
        data: [2095, 1544, 3058, 2584, 1296, 1883, 2009],
      },
    ],

    chart: {
      toolbar: {
        show: false,
      },
      height: 80,
      type: "bar",
      sparkline: {
        enabled: true
      },
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    colors: ["#0779AB", "#0779AB", "#F8CF29", "#0779AB", "#6AAD45", "#0779AB", "#0779AB"],
    plotOptions: {
      bar: {
        borderRadius: 3,
        columnWidth: "48%",
        distributed: true,
        endingShape: "rounded",
      },
    },

    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      yaxis: {
        lines: {
          show: false,
        },
      },
    },
    xaxis: {
      axisBorder: { 
        show: false,
      },
      labels: {
        show: false
      },
      axisTicks: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
    },
  };

  var chart = new ApexCharts(document.querySelector("#widgest-chart-2"), options);
  chart.render();



  // =====================================
  // widgest-chart-3
  // =====================================
  var options = {
    chart: {
      id: "widgest-chart-3",
      type: "area",
      height: 90,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: '',
        color: "#F8CF29",
        data: [847, 739, 578, 689, 1245, 673, 543, 787],
      },
    ],
    stroke: {
      curve: "straight",
      width: 2,
    },
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 0,
        inverseColors: false,
        opacityFrom: 0.20,
        opacityTo: 0,
        stops: [20, 180],
      },
    },

  
    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#widgest-chart-3"), options).render();



  // =====================================
  // widgest-chart-4
  // =====================================
  var options = {
    series: [
      {
        name: "",
        data: [40, 102, 90, 73, 93, 108, 116, 85, 143],
      },
    ],

    chart: {
      toolbar: {
        show: false,
      },
      height: 55,
      type: "bar",
      sparkline: {
        enabled: true
      },
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    colors: ["#6AAD45", "#0779AB", "#0779AB", "#0779AB", "#0779AB", "#0779AB", "#0779AB", "#0779AB", "#F8CF29"],
    plotOptions: {
      bar: {
        borderRadius: 3,
        columnWidth: "45%",
        distributed: true,
        endingShape: "rounded",
      },
    },

    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      yaxis: {
        lines: {
          show: false,
        },
      },
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      labels: {
        show: false
      },
      axisTicks: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
    },
  };

  var chart = new ApexCharts(document.querySelector("#widgest-chart-4"), options);
  chart.render();



  // =====================================
  // widgest-chart-5
  // =====================================
  var options = {
    series: [
      {
        name: "",
        data: [3, 4, 3, 1, 2, 3],
      },
      {
        name: "",
        data: [-2, -1, -1, -2, -1, -3],
      },
    ],
    chart: {
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      height: 200,
      stacked: true,
    },
    colors: ["#0779AB", "#6AAD45"],
    plotOptions: {
      bar: {
        horizontal: false,
        barHeight: "60%",
        columnWidth: "20%",
        borderRadius: [5],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    stroke: {
      show: false
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      show: false,
      padding: {
        top: 0,
        right: 0,
        bottom: 0,
        left: 0
      }
    },
    yaxis: {
      min: -5,
      max: 5,
      tickAmount: 4
    },
    xaxis: {
      categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
      axisTicks: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
    },
    
  };

  var chart = new ApexCharts(document.querySelector("#widgest-chart-5"), options);
  chart.render();




  // =====================================
  // widgest-chart-6
  // =====================================
  var options = {
    series: [
      {
        name: "",
        data: [3, 2, 3, 2, 4, 5],
      },
      {
        name: "",
        data: [-2, -2, -3, -1, -1, -2],
      },
    ],
    chart: {
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      height: 200,
      stacked: true,
    },
    colors: ["#F8CF29", "#0779AB"],
    plotOptions: {
      bar: {
        horizontal: false,
        barHeight: "60%",
        columnWidth: "20%",
        borderRadius: [5],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    stroke: {
      show: false
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      show: false,
      padding: {
        top: 0,
        right: 0,
        bottom: 0,
        left: 0
      }
    },
    yaxis: {
      min: -5,
      max: 5,
      tickAmount: 4
    },
    xaxis: {
      categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
      axisTicks: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
    },
    
  };

  var chart = new ApexCharts(document.querySelector("#widgest-chart-6"), options);
  chart.render();




  // =====================================
  // Current Year
  // =====================================
  var options = {
    color: "#adb5bd",
    series: [120, 88, 40],
    labels: ["2021", "2022", "2023"],
    chart: {
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    plotOptions: {
      pie: {
        donut: {
          size: '89%',
          background: 'transparent',
          labels: {
            show: true,
            name: {
              show: true,
              offsetY: 7,
            },
            value: {
              show: false,
            },
            total: {
              show: true,
              color: '#5A6A85',
              fontSize: '20px',
              fontWeight: "600",
              label: '248',
            },
          },
        },
      },
    },

    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: false,
    },
    legend: {
      show: false,
    },
    colors: ["#F8CF29", "#0779AB", "#6AAD45"],

    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
  };

  var chart = new ApexCharts(document.querySelector("#current-year"), options);
  chart.render();




  // =====================================
  // Breakup
  // =====================================
  var options = {
    color: "#adb5bd",
    series: [257, 386, 322],
    labels: ["2023", "2022", "2021"],
    chart: {
      width: 180,
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    plotOptions: {
      pie: {
        startAngle: 0,
        endAngle: 360,
        donut: {
          size: '75%',
        },
      },
    },
    stroke: {
      show: false,
    },

    dataLabels: {
      enabled: false,
    },

    legend: {
      show: false,
    },
    colors: ["#6AAD45", "#F8CF29", "#0779AB"],

    responsive: [
      {
        breakpoint: 991,
        options: {
          chart: {
            width: 120,
          },
        },
      },
    ],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
  };

  var chart = new ApexCharts(document.querySelector("#breakup"), options);
  chart.render();



  // =====================================
  // monthly-earning
  // =====================================
  var options = {
    chart: {
      id: "monthly-earning",
      type: "area",
      height: 70,
      sparkline: {
        enabled: true,
      },
      group: "monthly-earning",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: 'Derrotas',
        color: "#6AAD45",
        data: [25, 66, 20, 40, 12, 58, 20],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 0,
        inverseColors: false,
        opacityFrom: 0.12,
        opacityTo: 0,
        stops: [20, 180],
      },
    },

    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#monthly-earning"), options).render();




  // =====================================
  // Most Visited
  // =====================================
  var options = {
    series: [
      {
        name: "2022",
        data: [44, 55, 41, 67, 22, 43],
      },
      {
        name: "2023",
        data: [13, 23, 20, 8, 13, 27],
      },
    ],
    chart: {
      height: 265,
      type: 'bar',
      fontFamily: "Plus Jakarta Sans,sans-serif",
      foreColor: '#adb0bb',
      toolbar: {
          show: false,
      },
      stacked: true,
    },

    colors: ["#6AAD45", "#F8CF29"],

    plotOptions: {
      bar: {
          borderRadius: [6],
          horizontal: false,
          barHeight: '60%',
          columnWidth: '40%',
          borderRadiusApplication: 'end',
          borderRadiusWhenStacked: 'all',
      }
    },
    stroke: {
      show: false
   },

    dataLabels: {
      enabled: false,
    },

    legend: {
      show: false,
    },

    grid: {
      show: false,
    },

    yaxis: {
      tickAmount: 4,
    },

    xaxis: {
      categories: ['01', '02', '03', '04', '05', '06'],
      axisTicks: {
          show: false
      }
    },

    tooltip: {
      theme: 'dark',
      fillSeriesColor: false,
      x: {
          show: false
      }
    },

  };

  var chart = new ApexCharts(document.querySelector("#most-visited"), options);
  chart.render();




  // =====================================
  // Yearly Salary
  // =====================================
  var options = {
    series: [
      {
        name: "",
        data: [20, 15, 30, 25, 10, 15],
      },
    ],

    chart: {
      toolbar: {
        show: false,
      },
      height: 310,
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    colors: ["#0779AB", "#0779AB", "#F8CF29", "#0779AB", "#6AAD45", "#0779AB"],
    plotOptions: {
      bar: {
        borderRadius: 3,
        columnWidth: "45%",
        distributed: true,
        endingShape: "rounded",
      },
    },

    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      yaxis: {
        lines: {
          show: false,
        },
      },
    },
    xaxis: {
      categories: [["Abr"], ["Mai"], ["Jun"], ["Jul"], ["Ago"], ["Set"]],
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
    },
  };

  var chart = new ApexCharts(document.querySelector("#yearly-salary"), options);
  chart.render();

  

  // =====================================
  // Impressions
  // =====================================
  var options = {
    series: [
      {
        name: "",
        data: [10, 4, 12, 8, 2],
      },
    ],

    chart: {
      toolbar: {
        show: false,
      },
      height: 100,
      type: "bar",
      sparkline: {
        enabled: true
      },
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    colors: ["#0779AB", "#0779AB", "#F8CF29", "#0779AB", "#6AAD45"],
    plotOptions: {
      bar: {
        borderRadius: 3,
        columnWidth: "64%",
        distributed: true,
        endingShape: "rounded",
      },
    },

    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      yaxis: {
        lines: {
          show: false,
        },
      },
    },
    xaxis: {
      axisBorder: { 
        show: false,
      },
      labels: {
        show: false
      },
      axisTicks: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
    },
  };

  var chart = new ApexCharts(document.querySelector("#impressions"), options);
  chart.render();



  // =====================================
  // Customers
  // =====================================
  var options = {
    chart: {
      id: "customers",
      type: "area",
      height: 80,
      sparkline: {
        enabled: true,
      },
      group: "customers",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },

    series: [
      {
        name: '',
        color: "#6AAD45",
        data: [110, 207, 126, 188, 122, 148],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 0,
        inverseColors: false,
        opacityFrom: 0.12,
        opacityTo: 0,
        stops: [20, 180],
      },
    },

    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#customers"), options).render();




  // =====================================
  // Projects
  // =====================================
  var options = {
    series: [
      {
        name: "",
        data: [4, 10, 9, 7, 9, 10, 11, 8, 10],
      },
    ],

    chart: {
      toolbar: {
        show: false,
      },
      height: 80,
      type: "bar",
      sparkline: {
        enabled: true
      },
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    colors: ["#6AAD45", "#0779AB", "#0779AB", "#0779AB", "#0779AB", "#0779AB", "#F8CF29", "#0779AB", "#0779AB"],
    plotOptions: {
      bar: {
        borderRadius: 2,
        columnWidth: "40%",
        distributed: true,
        endingShape: "rounded",
        borderRadiusApplication: 'end',
      },
    },

    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      yaxis: {
        lines: {
          show: false,
        },
      },
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      labels: {
        show: false
      },
      axisTicks: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
    },
  };

  var chart = new ApexCharts(document.querySelector("#projects"), options);
  chart.render();



  // =====================================
  // Revenue Updates
  // =====================================
  var options = {
    series: [
      {
        name: "Subidas",
        data: [0.5, 1.7, 1.2, 0.6, 1.4],
      },
      {
        name: "Descidas",
        data: [-0.8, -0.4, -0.6, -0.9, -0.9],
      },
    ],
    chart: {
      height: 320,
      type: 'bar',
      fontFamily: "Plus Jakarta Sans,sans-serif",
      toolbar: {
          show: false
      },
      offsetX: -20,
      stacked: true
    },
    colors: ["#0779AB", "#6AAD45"],
    plotOptions: {
      bar: {
          horizontal: false,
          barHeight: '60%',
          columnWidth: '20%',
          borderRadius: [5],
          borderRadiusApplication: 'end',
          borderRadiusWhenStacked: 'all'
      }
    },
    stroke: {
      show: false
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      show: false,
    },
    yaxis: {
      min: -5,
      max: 5,
      tickAmount: 4
    },
    xaxis: {
      categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
      axisTicks: {
          show: false
      }
    },
    tooltip: {
      theme: "dark",
    },

  };

  var chart = new ApexCharts(document.querySelector("#revenue-updates"), options);
  chart.render();




  // =====================================
  // Sales Overview
  // =====================================
  var options = {
    color: "#adb5bd",
    series: [{
      name: "radarPadel",
      data: [80, 74, 52, 74, 52],
      markers: {
        size: 6,
      },
    }],
    labels: ["Padel", "Ténis", "Basquetebol", "Ténis", "Basquetebol"],
    chart: {
      height: 300, 
      width: '100%',
      type: "radar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    dataLabels: {
      enabled: true,
      formatter: function(val, opts) {
        return val;
      },
    },
    stroke: {
      show: true,
      width: 2,
    },
    legend: {
      show: false,
    },
    colors: ["#044967", "#0779AB", "#6AAD45", "#0779AB", "#6AAD45"],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
   };

   var chart = new ApexCharts(document.querySelector("#radarPadel"), options);
  chart.render();


  var options = {
    color: "#adb5bd",
    series: [{
      name: "radarTenis",
      data: [80, 74, 52, 74, 52],
      markers: {
        size: 6,
      },
    }],
    labels: ["Padel", "Ténis", "Basquetebol", "Ténis", "Basquetebol"],
    chart: {
      height: 300, 
      width: '100%',
      type: "radar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    dataLabels: {
      enabled: true,
      formatter: function(val, opts) {
        return val;
      },
    },
    stroke: {
      show: true,
      width: 2,
    },
    legend: {
      show: false,
    },
    colors: ["#45702d", "#0779AB", "#6AAD45", "#0779AB", "#6AAD45"],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
   };

   var chart = new ApexCharts(document.querySelector("#radarTenis"), options);
  chart.render();

  var options = {
    color: "#adb5bd",
    series: [{
      name: "radarBasket",
      data: [80, 74, 52, 74, 52],
      markers: {
        size: 6,
      },
    }],
    labels: ["Padel", "Ténis", "Basquetebol", "Ténis", "Basquetebol"],
    chart: {
      height: 300, 
      width: '100%',
      type: "radar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    dataLabels: {
      enabled: true,
      formatter: function(val, opts) {
        return val;
      },
    },
    stroke: {
      show: true,
      width: 2,
    },
    legend: {
      show: false,
    },
    colors: ["#FFAE1F", "#0779AB", "#6AAD45", "#0779AB", "#6AAD45"],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
   };

   var chart = new ApexCharts(document.querySelector("#radarBasket"), options);
  chart.render();

  var options = {
    color: "#adb5bd",
    series: [{
      name: "radarFutsal",
      data: [80, 74, 52, 74, 52],
      markers: {
        size: 6,
      },
    }],
    labels: ["Padel", "Ténis", "Basquetebol", "Ténis", "Basquetebol"],
    chart: {
      height: 300, 
      width: '100%',
      type: "radar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    dataLabels: {
      enabled: true,
      formatter: function(val, opts) {
        return val;
      },
    },
    stroke: {
      show: true,
      width: 2,
    },
    legend: {
      show: false,
    },
    colors: ["#FA896B", "#0779AB", "#6AAD45", "#0779AB", "#6AAD45"],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
   };

   var chart = new ApexCharts(document.querySelector("#radarFutsal"), options);
  chart.render();

  var options = {
    color: "#adb5bd",
    series: [{
      name: "histogram",
      data: [
        { x: "Padel", y: 80 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
      ],
    }],
    chart: {
      height: 300,
      width: '100%',
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    plotOptions: {
      bar: {
        columnWidth: "95%",
        borderRadius: 5,
        borderRadiusApplication: "end",
      }
    },
    fill: {
      colors: '#044967',
      opacity: 0.3,
    },
    stroke: {
      width: 2,
      colors: ['#044967']
    },
    dataLabels: {
      enabled: false,
    },
    grid: {
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      }
    },
    xaxis: {
      type: "category",
      categories: ["Padel", "Ténis", "Basquetebol", "Ténis", "Basquetebol"],
      title: {text: "Sports", offsetY: 70},
      axisBorder: {
        color: "#000000"
      }
    },
    yaxis: {
      title: {text: "Sales"},
      axisBorder: {
        show: true,
        color: "#000000"
      }
    },
    tooltip:{
      onDatasetHover: {
        highlightDataSeries: true,
      },
    }
   };
   
   var chart = new ApexCharts(document.querySelector("#barPadel"), options);
   chart.render();

   var options = {
    color: "#adb5bd",
    series: [{
      name: "histogram",
      data: [
        { x: "Padel", y: 80 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
      ],
    }],
    chart: {
      height: 300,
      width: '100%',
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    plotOptions: {
      bar: {
        columnWidth: "95%",
        borderRadius: 5,
        borderRadiusApplication: "end",
      }
    },
    fill: {
      colors: '#044967',
      opacity: 0.3,
    },
    stroke: {
      width: 2,
      colors: ['#044967']
    },
    dataLabels: {
      enabled: false,
    },
    grid: {
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      }
    },
    xaxis: {
      type: "category",
      categories: ["Padel", "Ténis", "Basquetebol", "Ténis", "Basquetebol"],
      title: {text: "Sports", offsetY: 70},
      axisBorder: {
        color: "#000000"
      }
    },
    yaxis: {
      title: {text: "Sales"},
      axisBorder: {
        show: true,
        color: "#000000"
      }
    },
    tooltip:{
      onDatasetHover: {
        highlightDataSeries: true,
      },
    }
   };
   
   var chart = new ApexCharts(document.querySelector("#barPadel2"), options);
   chart.render();

   var options = {
    color: "#adb5bd",
    series: [{
      name: "histogram",
      data: [
        { x: "Padel", y: 80 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
      ],
    }],
    chart: {
      height: 300,
      width: '100%',
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    plotOptions: {
      bar: {
        columnWidth: "95%",
        borderRadius: 5,
        borderRadiusApplication: "end",
      }
    },
    fill: {
      colors: '#45702d',
      opacity: 0.3,
    },
    stroke: {
      width: 2,
      colors: ['#45702d']
    },
    dataLabels: {
      enabled: false,
    },
    grid: {
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      }
    },
    xaxis: {
      type: "category",
      categories: ["Padel", "Ténis", "Basquetebol", "Ténis", "Basquetebol"],
      title: {text: "Sports", offsetY: 70},
      axisBorder: {
        color: "#000000"
      }
    },
    yaxis: {
      title: {text: "Sales"},
      axisBorder: {
        show: true,
        color: "#000000"
      }
    },
    tooltip:{
      onDatasetHover: {
        highlightDataSeries: true,
      },
    }
   };
   
   var chart = new ApexCharts(document.querySelector("#barTenis"), options);
   chart.render();

   var options = {
    color: "#adb5bd",
    series: [{
      name: "histogram",
      data: [
        { x: "Padel", y: 80 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
      ],
    }],
    chart: {
      height: 300,
      width: '100%',
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    plotOptions: {
      bar: {
        columnWidth: "95%",
        borderRadius: 5,
        borderRadiusApplication: "end",
      }
    },
    fill: {
      colors: '#45702d',
      opacity: 0.3,
    },
    stroke: {
      width: 2,
      colors: ['#45702d']
    },
    dataLabels: {
      enabled: false,
    },
    grid: {
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      }
    },
    xaxis: {
      type: "category",
      categories: ["Padel", "Ténis", "Basquetebol", "Ténis", "Basquetebol"],
      title: {text: "Sports", offsetY: 70},
      axisBorder: {
        color: "#000000"
      }
    },
    yaxis: {
      title: {text: "Sales"},
      axisBorder: {
        show: true,
        color: "#000000"
      }
    },
    tooltip:{
      onDatasetHover: {
        highlightDataSeries: true,
      },
    }
   };
   
   var chart = new ApexCharts(document.querySelector("#barTenis2"), options);
   chart.render();

   var options = {
    color: "#adb5bd",
    series: [{
      name: "histogram",
      data: [
        { x: "Padel", y: 80 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
      ],
    }],
    chart: {
      height: 300,
      width: '100%',
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    plotOptions: {
      bar: {
        columnWidth: "95%",
        borderRadius: 5,
        borderRadiusApplication: "end",
      }
    },
    fill: {
      colors: '#FFAE1F',
      opacity: 0.3,
    },
    stroke: {
      width: 2,
      colors: ['#FFAE1F']
    },
    dataLabels: {
      enabled: false,
    },
    grid: {
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      }
    },
    xaxis: {
      type: "category",
      categories: ["Padel", "Ténis", "Basquetebol", "Ténis", "Basquetebol"],
      title: {text: "Sports", offsetY: 70},
      axisBorder: {
        color: "#000000"
      }
    },
    yaxis: {
      title: {text: "Sales"},
      axisBorder: {
        show: true,
        color: "#000000"
      }
    },
    tooltip:{
      onDatasetHover: {
        highlightDataSeries: true,
      },
    }
   };
   
   var chart = new ApexCharts(document.querySelector("#barBasket"), options);
   chart.render();

   var options = {
    color: "#adb5bd",
    series: [{
      name: "histogram",
      data: [
        { x: "Padel", y: 80 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
      ],
    }],
    chart: {
      height: 300,
      width: '100%',
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    plotOptions: {
      bar: {
        columnWidth: "95%",
        borderRadius: 5,
        borderRadiusApplication: "end",
      }
    },
    fill: {
      colors: '#FFAE1F',
      opacity: 0.3,
    },
    stroke: {
      width: 2,
      colors: ['#FFAE1F']
    },
    dataLabels: {
      enabled: false,
    },
    grid: {
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      }
    },
    xaxis: {
      type: "category",
      categories: ["Padel", "Ténis", "Basquetebol", "Ténis", "Basquetebol"],
      title: {text: "Sports", offsetY: 70},
      axisBorder: {
        color: "#000000"
      }
    },
    yaxis: {
      title: {text: "Sales"},
      axisBorder: {
        show: true,
        color: "#000000"
      }
    },
    tooltip:{
      onDatasetHover: {
        highlightDataSeries: true,
      },
    }
   };
   
   var chart = new ApexCharts(document.querySelector("#barBasket2"), options);
   chart.render();

   var options = {
    color: "#adb5bd",
    series: [{
      name: "histogram",
      data: [
        { x: "Padel", y: 80 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
      ],
    }],
    chart: {
      height: 300,
      width: '100%',
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    plotOptions: {
      bar: {
        columnWidth: "95%",
        borderRadius: 5,
        borderRadiusApplication: "end",
      }
    },
    fill: {
      colors: '#FA896B',
      opacity: 0.3,
    },
    stroke: {
      width: 2,
      colors: ['#FA896B']
    },
    dataLabels: {
      enabled: false,
    },
    grid: {
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      }
    },
    xaxis: {
      type: "category",
      categories: ["Padel", "Ténis", "Basquetebol", "Ténis", "Basquetebol"],
      title: {text: "Sports", offsetY: 70},
      axisBorder: {
        color: "#000000"
      }
    },
    yaxis: {
      title: {text: "Sales"},
      axisBorder: {
        show: true,
        color: "#000000"
      }
    },
    tooltip:{
      onDatasetHover: {
        highlightDataSeries: true,
      },
    }
   };
   
   var chart = new ApexCharts(document.querySelector("#barFutsal"), options);
   chart.render();

   var options = {
    color: "#adb5bd",
    series: [{
      name: "histogram",
      data: [
        { x: "Padel", y: 80 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
        { x: "Ténis", y: 74 },
        { x: "Basquetebol", y: 52 },
      ],
    }],
    chart: {
      height: 300,
      width: '100%',
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    plotOptions: {
      bar: {
        columnWidth: "95%",
        borderRadius: 5,
        borderRadiusApplication: "end",
      }
    },
    fill: {
      colors: '#FA896B',
      opacity: 0.3,
    },
    stroke: {
      width: 2,
      colors: ['#FA896B']
    },
    dataLabels: {
      enabled: false,
    },
    grid: {
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      }
    },
    xaxis: {
      type: "category",
      categories: ["Padel", "Ténis", "Basquetebol", "Ténis", "Basquetebol"],
      title: {text: "Sports", offsetY: 70},
      axisBorder: {
        color: "#000000"
      }
    },
    yaxis: {
      title: {text: "Sales"},
      axisBorder: {
        show: true,
        color: "#000000"
      }
    },
    tooltip:{
      onDatasetHover: {
        highlightDataSeries: true,
      },
    }
   };
   
   var chart = new ApexCharts(document.querySelector("#barFutsal2"), options);
   chart.render();

   var options = {
    color: "#adb5bd",
    series: [{
      name: "histogram",
      data: [
        { x: "Ago", y: 4820 },
        { x: "Set", y: 4890 },
        { x: "Out", y: 6640 },
        { x: "Nov", y: 8020 },
        { x: "Dez", y: 5880 },
      ],
    }],
    chart: {
      height: 300,
      width: '100%',
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    plotOptions: {
      bar: {
        columnWidth: "95%",
        borderRadius: 5,
        borderRadiusApplication: "end",
      }
    },
    fill: {
      colors: '#FA896B',
      opacity: 0.3,
    },
    stroke: {
      width: 2,
      colors: ['#FA896B']
    },
    dataLabels: {
      enabled: false,
    },
    grid: {
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      }
    },
    xaxis: {
      type: "category",
      categories: ["Ago", "Set", "Out", "Nov", "Dez"],
      title: {text: "Sports", offsetY: 70},
      axisBorder: {
        color: "#000000"
      }
    },
    yaxis: {
      title: {text: "Ganhos"},
      axisBorder: {
        show: true,
        color: "#000000"
      }
    },
    tooltip:{
      onDatasetHover: {
        highlightDataSeries: true,
      },
    }
   };
   
   var chart = new ApexCharts(document.querySelector("#barDash"), options);
   chart.render();


   var options = {
    color: "#044967",
    series: [{
      name: "histogram",
      data: [
        { x: "Ago", y: 5820 },
        { x: "Set", y: 6800 },
        { x: "Out", y: 7340 },
        { x: "Nov", y: 8220 },
        { x: "Dez", y: 7280 },
      ],
    }],
    chart: {
      height: 300,
      width: '100%',
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      toolbar: {
        tools: {
          download: false
        }
      }
    },
    plotOptions: {
      bar: {
        columnWidth: "95%",
        borderRadius: 5,
        borderRadiusApplication: "end",
      }
    },
    fill: {
      colors: '#044967',
      opacity: 0.3,
    },
    stroke: {
      width: 2,
      colors: ['#044967']
    },
    dataLabels: {
      enabled: false,
    },
    grid: {
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      }
    },
    xaxis: {
      type: "category",
      categories: ["Ago", "Set", "Out", "Nov", "Dez"],
      title: {text: "Sports", offsetY: 70},
      axisBorder: {
        color: "#000000"
      }
    },
    yaxis: {
      title: {text: "Ganhos"},
      axisBorder: {
        show: true,
        color: "#000000"
      }
    },
    tooltip:{
      onDatasetHover: {
        highlightDataSeries: true,
      },
    }
   };
   
   var chart = new ApexCharts(document.querySelector("#barDash2"), options);
   chart.render();

});