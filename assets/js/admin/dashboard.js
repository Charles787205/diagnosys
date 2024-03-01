document.addEventListener("DOMContentLoaded", async () => {
  filterRequestForm("today");
  filterProfits("today");
  const salesRequest = await fetchSalesRequest();
  renderApexChart(getSalesData(salesRequest));
  initServicesAvailedChart(services);
});
let chart;
let servicesChart;
async function filterRequestForm(time) {
  const response = await fetch(
    `utils/dashboard/get_request_count.php?time=${time}`
  );
  const { count } = await response.json();
  const requestFormIndicator = $("#request_form_indicator").get(0);
  const requestFormCount = $("#request_form_count").get(0);
  $(requestFormCount).text(count || 0);

  switch (time) {
    case "today":
      $(requestFormIndicator).text("Today");
      break;
    case "month":
      $(requestFormIndicator).text("This Month");
      break;
    case "year":
      $(requestFormIndicator).text("This Year");
      break;
  }
}
async function filterAppointmentForm(time) {
  const response = await fetch(
    `utils/dashboard/get_appointment_count.php?time=${time}`
  );
  const { count } = await response.json();
  const appointmentFormIndicator = $("#appointment_form_indicator").get(0);
  const appointmentFormCount = $("#appointment_form_count").get(0);
  $(appointmentFormCount).text(count || 0);

  switch (time) {
    case "today":
      $(appointmentFormIndicator).text("Today");
      break;
    case "month":
      $(appointmentFormIndicator).text("This Month");
      break;
    case "year":
      $(appointmentFormIndicator).text("This Year");
      break;
  }
}

// filter the sales report graph

async function filterProfits(time) {
  const response = await fetch(
    `utils/dashboard/get_sales_total.php?time=${time}`
  );
  let data = await response.json();
  console.log({ data });
  chart.updateOptions({
    xaxis: {
      type: "date",
      categories: data.map((data) => data.day),
    },
  });

  switch (time) {
    case "today":
      updateSeriesByToday(data);
      break;

    case "week":
      updateSeriesByWeek(data);
      break;
    case "month":
      updateSeriesByMonth(data);
      break;
    case "year":
      const salesData = getSalesData(data);
      chart.updateOptions({
        xaxis: {
          categories: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
          ],
        },
      });
      chart.updateSeries([
        {
          data: salesData,
        },
      ]);
  }
}

//filter reports by today
function updateSeriesByToday(data) {
  //data has date and total attribute from the sql query
  chart.updateOptions({
    xaxis: {
      categories: data.map((val) => val.date),
    },
  });
  chart.updateSeries([
    {
      data: data.map((data) => {
        return {
          x: data.date,
          y: data.total,
        };
      }),
    },
  ]);
}
function updateSeriesByWeek(queryData) {
  const dateToday = new Date();
  const yAxis = [];
  const newSeries = [];
  for (let i = 0; i < 7; i++) {
    const pastDate = new Date(dateToday.setDate(dateToday.getDate() - 1));
    const month = (pastDate.getMonth() + 1).toString().padStart(2, "0"); // Add 1 because months are zero-based
    const day = pastDate.getDate().toString().padStart(2, "0");
    const year = dateToday.getFullYear();
    const formattedDate = `${month}/${day}/${year}`;

    let isDateInData = false;
    for (data of queryData) {
      if (data.day == formattedDate) {
        newSeries.push({
          x: formattedDate,
          y: data.total,
        });
        isDateInData = true;
        break;
      }
    }
    if (!isDateInData) {
      newSeries.push({
        x: formattedDate,
        y: 0,
      });
    }
  }
  console.log(newSeries);
  chart.updateOptions({
    xaxis: {
      categories: newSeries.reverse().map((series) => series.x),
    },
  });
  chart.updateSeries([
    {
      data: newSeries,
    },
  ]);
}

function updateSeriesByMonth(monthData) {
  if (monthData.length == 0) {
    chart.updateOptions({
      xaxis: {
        categories: ["week 1", "week 2", "week 3", "week 4"],
      },
    });
    chart.updateSeries([
      {
        data: [],
      },
    ]);
    return;
  }
  const newSeries = [];
  for (let i = monthData[0].cur_week - 3; i <= monthData[0].cur_week; i++) {
    let isInMonthData = false;
    for (let data of monthData) {
      if (data.week == i) {
        newSeries.push({
          x: `week ${i}`,
          y: +data.total,
        });
        isInMonthData = true;
      }
    }
    if (!isInMonthData) {
      newSeries.push({
        x: `week ${i}`,
        y: 0,
      });
    }
  }
  console.log({ newSeries });
  chart.updateOptions({
    xaxis: {
      categories: newSeries.map((series) => series.x),
    },
  });
  chart.updateSeries([
    {
      data: newSeries,
    },
  ]);
}

//end filtering reports

async function fetchSalesRequest() {
  const response = await fetch("utils/dashboard/get_sales_request.php");
  const { salesRequests } = await response.json();
  console.log({ salesRequests }, "fetchSalesRequest");
  console.log("Hoooott");
  //[
  //    {
  //      "month": 2,
  //      "total": "2000.00"
  //  }
  //]
  return salesRequests;
}

async function filterPatientCount(time) {
  const response = await fetch(
    `utils/dashboard/get_patient_count.php?time=${time}`
  );
  const { count } = await response.json();
  const patientCountIndicator = $("#patient_count_indicator").get(0);
  const patientCount = $("#patient_count").get(0);

  $(patientCount).text(count || 0);
  switch (time) {
    case "today":
      $(patientCountIndicator).text("Today");
      break;
    case "month":
      $(patientCountIndicator).text("This Month");
      break;
    case "year":
      $(patientCountIndicator).text("This Year");
      break;
  }
}
console.log(
  salesRequests.map((salesRequest) =>
    new Date(salesRequest.request_date).toLocaleDateString()
  )
);

function getSalesData(salesRequests) {
  const salesData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  const s = "2024-01-13 14:50:46";

  salesRequests.map((salesRequest) => {
    salesData[salesRequest.month - 1] += salesRequest.total;
  });

  return salesData;
}
function renderApexChart(data) {
  chart = new ApexCharts(document.querySelector("#BarChart"), {
    series: [
      {
        name: "Sales",
        data: data,
      },
    ],
    chart: {
      height: 350,
      type: "bar",
      toolbar: {
        show: false,
      },
    },
    markers: {
      size: 4,
    },
    colors: ["#4154f1", "#2eca6a", "#ff771d"],
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.3,
        opacityTo: 0.4,
        stops: [0, 90, 100],
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: "smooth",
      width: 2,
    },

    xaxis: {
      type: "date",
      categories: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ],
    },
    tooltip: {
      x: {
        format: "yy-dd-mm",
      },
    },
  });
  chart.render();
}

function filterBarchart(id) {
  console.log(salesRequests);
  const salesData = {};
  const s = "2024-01-13 14:50:46";
  console.log({ salesRequests });
  for (const salesRequest of salesRequests) {
    for (const service of salesRequest.services) {
      console.log({ service: service.id, id });
      if (service.id == id) {
        const dateString = new Date(
          salesRequest.request_date
        ).toLocaleDateString("en-US", {
          month: "numeric",
          day: "numeric",
          year: "numeric",
        });

        if (salesData[dateString]) {
          salesData[dateString] += salesRequest.total;
        } else {
          salesData[dateString] = salesRequest.total;
        }
        continue;
      }
    }
  }

  const salesDataArray = Object.keys(salesData).map((key) => {
    console.log({ x: key, y: salesData[key] });
    return { x: key, y: salesData[key] };
  });
  const series = [
    {
      name: "Sales Report",
      data: salesDataArray,
    },
  ];
  console.log(salesDataArray);
  chart.updateSeries(series);
}

function initEchart(data) {
  chart = echarts.init(document.querySelector("#BarChart"));
  chart.setOption({
    xAxis: {
      type: "category",
      data: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ],
    },
    yAxis: {
      type: "value",
    },
    series: [
      {
        data: data,
        type: "bar",
      },
    ],
  });
}

async function filterBarchartDate() {
  const startTime = $("#start_date").val();
  const endTime = $("#end_date").val();

  if (!startTime || !endTime) return;
  const response = await fetch(
    `utils/dashboard/get_sales_request.php?start_time=${startTime}&end_time=${endTime}`
  );
  const { salesRequests } = await response.json();
  console.log({ salesRequests }, "filterBarchartDate");
  const salesData = getSalesData(salesRequests);
  console.log({ salesData, startTime, endTime }, "FILTERBARCHARTDATE");

  chart.updateSeries([
    {
      data: salesData,
    },
  ]);
}

function initServicesAvailedChart(services) {
  servicesChart = new ApexCharts(
    document.querySelector("#servicesAvailedChart"),
    {
      series: [
        {
          data: services.map((service) => service.price),
        },
      ],
      chart: {
        type: "bar",
        height: 350,
      },
      plotOptions: {
        bar: {
          borderRadius: 4,
          horizontal: true,
        },
      },
      dataLabels: {
        enabled: false,
      },
      xaxis: {
        categories: services.map((service) => service.name),
      },
    }
  );
  servicesChart.render();
}

async function filterServicesAvailedChart() {
  console.log("servicesAvailed");
  const startTime = $("#services_start_date").val();
  const endTime = $("#services_end_date").val();
  console.log({ startTime, endTime });
  if (!startTime || !endTime) return;
  const response = await fetch(
    `utils/dashboard/get_services_availed.php?start_date=${startTime}&end_date=${endTime}`
  );
  const { services } = await response.json();
  console.log(services, "hello");
  servicesChart.updateSeries([
    {
      data: services.map((service) => service.price),
    },
  ]);
}
