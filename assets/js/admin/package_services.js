let services = [];
function addService(service) {
  const selectedTable = $("#selected_table");
  if (!$("#" + service.id).get(0)) {
    const row = $(`<tr id="${service.id}">`);
    $(row).append($("<td>").text(service.name));
    $(row).append($("<td>").text(service.price));
    $(row).append(
      $("<td>")
        .html(`<button class="btn btn-danger" onclick="deleteRow(${service.id})" >
    <i class="bi bi-trash3-fill" ></i>
  </button>`)
    );
    console.log($(selectedTable));
    $(selectedTable).append(row);
  }
}

function deleteRow(id) {
  $("#" + id).remove();
}

async function handleAddButtonClick(e) {
  e.preventDefault();
  const package_name = $("#add_service_name").get(0).value;
  const selectedTable = $("#selected_table");
  const services = [];
  selectedTable.children().map((index, row) => {
    services[index] = row.id;
  });

  console.log(services);

  const response = await fetch("utils/services/add_package_services.php", {
    method: "POST",
    body: JSON.stringify({
      services: services,
      package_name: package_name,
    }),
  });
  console.log(await response.json());
}
