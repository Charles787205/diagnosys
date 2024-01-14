document.addEventListener("DOMContentLoaded", () => {
  filterRequestForm("today");
  filterProfits("today");
  renderApexChart();
});

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

async function filterProfits(time) {
  const response = await fetch(
    `utils/dashboard/get_sales_total.php?time=${time}`
  );
  let { total, prev_total: prevTotal } = await response.json();
  total = total || 0;
  prevTotal = prevTotal || 0;
  const profitsIndicator = $("#profits_indicator").get(0);
  const profitsTotal = $("#profits_total").get(0);
  console.log(prevTotal);
  $(profitsTotal).text(total || 0);
  switch (time) {
    case "today":
      $(profitsIndicator).text("Today");
      break;
    case "month":
      $(profitsIndicator).text("This Month");
      break;
    case "year":
      $(profitsIndicator).text("This Year");
      break;
  }
  console.log(prevTotal);
  const perDiff = ((total - prevTotal) / prevTotal) * 100;
  const percentageSpan = $("#percentage_difference span:nth-child(1)");
  const trendSpan = $("#percentage_difference span:nth-child(2)");
  $(percentageSpan).text(`${perDiff}%`);

  if (perDiff >= 0) {
    $(percentageSpan).removeClass("text-danger").addClass("text-success");
    $(trendSpan).text("increase");
  } else {
    $(percentageSpan).removeClass("text-success").addClass("text-danger");
    $(trendSpan).text("decrease");
  }
}

function getPercentageDifferenct(total, prevTotal) {}

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

function getSalesData() {
  const salesData = {};
  const s = "2024-01-13 14:50:46";
  console.log(
    "hhhh",
    new Date(s).toLocaleDateString("en-US", {
      month: "numeric",
      day: "numeric",
      year: "numeric",
    })
  );
  salesRequests.map((salesRequest) => {
    const dateString = new Date(salesRequest.request_date).toLocaleDateString(
      "en-US",
      { month: "numeric", day: "numeric", year: "numeric" }
    );

    if (salesData[dateString]) {
      salesData[dateString] += salesRequest.total;
    } else {
      salesData[dateString] = salesRequest.total;
    }
  });
  console.log({ salesData });
  const salesDataArray = Object.keys(salesData).map((key) => {
    console.log({ x: key, y: salesData[key] });
    return { x: key, y: salesData[key] };
  });
  console.log(salesDataArray);
  return salesDataArray;
}
function renderApexChart() {
  new ApexCharts(document.querySelector("#reportsChart"), {
    series: [
      {
        name: "Sales",
        data: getSalesData(),
      },
    ],
    chart: {
      height: 350,
      type: "area",
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
      categories: [,],
    },
    tooltip: {
      x: {
        format: "yy-dd-mm",
      },
    },
  }).render();
}
