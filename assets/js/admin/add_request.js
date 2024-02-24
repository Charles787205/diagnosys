//FUNCTIONS

function FindAge() {
  var day = document.getElementById("dob").value;
  var DOB = new Date(day);
  var today = new Date();
  var Age = today.getTime() - DOB.getTime();
  Age = Math.floor(Age / (1000 * 60 * 60 * 24 * 365.25));
  document.getElementById("age").value = Age;
}

function updateTotalPrice() {
  $("#package-select");
  console.log($("#package-select").val("Select Package"));
  var total = 0;
  for (var i = 1; i <= 8; i++) {
    var select = document.getElementById("test" + i);
    var selectedOption = select.options[select.selectedIndex];
    var selectedPrice = parseFloat(selectedOption.getAttribute("data-price"));
    if (!isNaN(selectedPrice)) {
      total += selectedPrice;
    }
  }
  var totalInput = document.getElementById("total");
  totalInput.value = total.toFixed(2);
}

const form = document.getElementById("request_form");

form.addEventListener("submit", async function (event) {
  event.preventDefault();
  console.log("hello");
  const formData = new FormData(form);

  const res = await fetch("utils/add_request.php", {
    method: "POST",
    body: formData,
  }).then((res) => {
    console.log(res.json());
    Swal.fire({
      title: "New Request Added",
      icon: "success",
    }).then(() => {
      window.location.href = "pending_requests.php";
    });
  });
  console.log(res);
});

document.addEventListener("DOMContentLoaded", () => {
  const appointmentSelect = document.getElementById("appointment-select");
  appointmentSelect.addEventListener("change", changeData);

  function changeData(e) {
    for (appointment of appointments) {
      if (appointment.id == e.target.value) {
        $("#request_date").val(appointment.appointment_date);
        $("#last_name").val(appointment.patient.last_name);
        $("#first_name").val(appointment.patient.first_name);
        $("#middle_name").val(appointment.patient.middle_name);
        $("#gender").val(appointment.patient.gender);
        $("#dob").val(appointment.patient.birthdate);
        $("#age").val(appointment.patient.age);
        $("#mobile_number").val(appointment.patient.mobile_number);
        $("#province").html(
          `<option value="${appointment.patient.province}">${appointment.patient.province}</option>`
        );

        $("#city").html(
          `<option value="${appointment.patient.city}">${appointment.patient.city}</option>`
        );
        $("#barangay").html(
          `<option value="${appointment.patient.barangay}">${appointment.patient.barangay}</option>`
        );
        $("#purok").val(appointment.patient.purok);
        $("#subdivision").val(appointment.patient.subdivision);
        $("#house_no").val(appointment.patient.house_no);
        $("#total").val(appointment.total);
        $("#user_id").val(appointment.user_id);
        for (var i = 0; i < appointment.services.length; i++) {
          $(`#test${i + 1}`)
            .val(appointment.services[i].id)
            .change();
          console.log(appointment.services[i]);
        }
        break;
      } else {
        $("#user_id").val(user_id);
      }
    }
  }
});

function validateNumber(event) {
  const input = event.target;
  const regex = /^[0-9]*$/; // Regular expression to match only numbers

  if (!regex.test(input.value)) {
    input.value = input.value.replace(/[^0-9]/g, ""); // Remove non-numeric characters
  }

  // Limit input to 11 digits
  if (input.value.length > 11) {
    input.value = input.value.slice(0, 11);
  }
}

function fillPackageServices() {
  const packageSelect = $("#package-select");

  console.log(packages);
  const packageId = packageSelect.get(0).value;
  const selectedPackage = packages.find((package) => package.id == packageId);

  const servicesSelect = $("[name='request_test[]']");
  servicesSelect.map((index, select) => {
    select.checked = false;
  });

  servicesSelect.map((index, select) => {
    for (const serviceId of selectedPackage.service_ids) {
      if (select.value == serviceId) {
        select.checked = true;
        console.log(select.checked);
      }
    }
  });

  var totalInput = document.getElementById("total");

  totalInput.value = parseInt(selectedPackage.price).toFixed(2);
  console.log(typeof selectedPackage.price);
}
