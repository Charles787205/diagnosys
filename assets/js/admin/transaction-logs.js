var now = new Date();
var months = [
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
var month = months[now.getMonth()];
var day = now.getDate();
var year = now.getFullYear();
var formattedDate = month + " " + day + ", " + year;
console.log(formattedDate);

const tableBody = $("tbody").get(0);
const tableRows = $(tableBody).children();
console.log(tableRows);
tableRows.each(function () {
  console.log($(this).find(".started_date").text());
});

function handleDateFilter(time) {
  switch (time) {
    case "today":
      break;
    case "month":
      break;
    case "year":
      break;
  }
}
