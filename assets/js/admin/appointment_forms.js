for (const appointment of appointments) {
  appointment.patient.fullName = `${appointment.patient.first_name} ${appointment.patient.last_name}`;
}
function filterAppointments() {
  var searchValue = $("#search-bar").val().toLowerCase();
  console.log(appointments);
  // Loop through appointments and hide/show based on search input
  appointments.forEach(function (appointment) {
    var patientName = appointment.patient.fullName.toLowerCase();
    var row = $("#appointment-row-" + appointment.id);

    if (patientName.includes(searchValue)) {
      row.show();
    } else {
      row.hide();
    }
  });
}
$("#search-bar").on("input", filterAppointments);

function deleteAppointment(id) {
  postData = {
    id: id,
    object: "appointment",
  };
  swalAnimate = Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      fetch("utils/delete_object.php", {
        method: "POST",
        body: JSON.stringify(postData),
      }).then((response) => {
        if (response.ok) {
          Swal.fire({
            title: "Deleted!",
            text: "The appointment has been deleted.",
            icon: "success",
          }).then(() => {
            location.reload();
          });
        }
      });
    }
  });
}
