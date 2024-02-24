var counter = 0;
var originalDiv = $("#result_1").get(0);

document.addEventListener("DOMContentLoaded", function () {
  originalDiv.remove();
});

function add_more(service) {
  console.log(service.name);
  if (service.name.toLowerCase().includes("sgpt")) {
    $("#sgpt_service_id").val(service.id);
    return;
  }
  counter++;
  var newDiv = originalDiv.cloneNode(true); // true indicates deep cloning with children
  var normalValueInput = newDiv.querySelector(
    'input[data-type="normal_value"]'
  );
  normalValueInput.value = service.normal_value;
  newDiv.id = "result_" + counter;

  var num = service.normal_value.split("-").map(function (item) {
    return parseInt(item);
  });

  var serviceName = newDiv.querySelector('input[data-type="service_name"]');

  serviceName.value = service.name;

  var idInput = document.createElement("input");

  idInput.value = service.id;
  idInput.name = "service_id";
  idInput.type = "hidden";
  newDiv.appendChild(idInput);
  // Update the button's onclick attribute to call a different function

  var form = document.getElementById("input-form");

  form.appendChild(newDiv);
}

// Updated delete_row function to accept a parameter
function delete_row_dynamic(rowId) {
  var row = document.getElementById("result_" + rowId);
  row.parentNode.removeChild(row);
}

function submit_form() {
  const inputRows = document.getElementsByClassName("input-row");
  const results = [];

  for (const row of inputRows) {
    const idInput = row.querySelector("[name=service_id]");
    console.log(idInput.value);
    const resultInput = row.querySelector('[name="result"]');

    const requestSelect = document.getElementById("patient-select");
    // Access the values of the selected elements
    const service_id = idInput.value;
    const resultInputValue = resultInput.value;

    const requestId = requestSelect.value;

    const data = {
      service_id: service_id,
      result: resultInputValue,
      test: "result",
      request_id: requestId,
    };

    results.push(data);
  }
  const sgptRow = document.getElementById("sgpt-row");

  if (sgptRow) {
    const idInput = sgptRow.querySelector("[name='sgpt_service_id']");

    const resultInput = sgptRow.querySelector('[name="result"]');

    const requestSelect = document.getElementById("patient-select");
    // Access the values of the selected elements
    const service_id = idInput.value;
    const resultInputValue = resultInput.value;

    const requestId = requestSelect.value;

    const data = {
      service_id: service_id,
      result: resultInputValue,
      test: "result",
      request_id: requestId,
    };

    results.push(data);
  }
  fetch("utils/add_result.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(results),
  }).then(() => {
    Swal.fire({
      title: "Result Saved",
      icon: "success",
    }).then(() => {
      location.href = "patient-table.php";
    });
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const patientSelect = document.getElementById("patient-select");
  patientSelect.addEventListener("change", changeData);

  const inputRow = document.getElementsByClassName("input-row");

  function changeData() {
    console.log(this.value);
    const serviceSelect = document.getElementsByClassName("service-select");
    const tableData = document.getElementsByClassName("table-data");

    var chosenRequest = null;
    for (const request of requests) {
      if (request.id == this.value) {
        chosenRequest = request;
        for (const row of $(".input-row").get()) {
          $(row).remove();
        }
        for (const service of request.services) {
          try {
            add_more(service);
          } catch (e) {}
        }
      }

      console.log($(".input-row").get());
    }

    if (chosenRequest != null) {
      for (const select of serviceSelect) {
        // Clear existing options
        select.innerHTML = "";

        for (const service of chosenRequest.services) {
          //add_more(service)
        }
      }
      for (const data of tableData) {
        const dataType = data.getAttribute("data-type");
        switch (dataType) {
          case "first_name":
            data.textContent = chosenRequest.patient.first_name;
            break;
          case "last_name":
            data.textContent = chosenRequest.patient.last_name;
            break;
          case "address":
            data.textContent = `${chosenRequest.patient.purok}, ${chosenRequest.patient.barangay}, ${chosenRequest.patient.city}, ${chosenRequest.patient.province}`;

            break;
          case "age_gender":
            data.textContent = `${chosenRequest.patient.age} / ${chosenRequest.patient.gender}`;
            break;
          case "request_date":
            data.textContent = chosenRequest.request_date;
            break;
          case "services":
            data.innerHTML = `<b>${chosenRequest.services.map(
              (service) => `${service.name} `
            )}</b>`;

            break;
        }
      }
    } else {
      for (const select of serviceSelect) {
        // Clear existing options
        select.innerHTML = "";
      }
      for (const data of tableData) {
        const dataType = data.getAttribute("data-type");
        data.textContent = "";
      }
    }
  }
});
