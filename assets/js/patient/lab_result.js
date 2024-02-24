const resultTable = $("#result_table");
$("#result_table_container").hide();

function seeResult(requestId) {
  const tbody = $(resultTable).find("tbody").get(0);

  $(tbody)
    .find("tr")
    .each(function () {
      $(this).remove();
    }); //remove all the row first

  for (const request of requests) {
    if (request.id === requestId) {
      request.services.map((service) => {
        const tableRow = document.createElement("tr");
        tableRow.innerHTML = `<td>${service.name}</td>
                             <td>${service.result}</td>
                             <td>${service.normal_value}</td>`;
        tbody.appendChild(tableRow);
      });
    }
  }
  $("#result_table_container").show();
}
