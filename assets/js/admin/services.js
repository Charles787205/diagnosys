function handleEditButtonClick(service) {
  Swal.fire("hello");
  serviceName = service.name;
  price = service.price;
  normalValue = service.normal_value;
  Swal.fire({
    title: "Edit Service",
    html: `<form action="" method="post">
            <label for="">Service Name</label>
            <input type="text" name="service_name" value="${serviceName}" id="service_name" class="form-control">
            <label for="">Price</label>
            <input type="number" name="service_price" value="${price}" id="service_price" class="form-control">
            <label for="">Normal Value</label>
            <input type="text" name="service_normal_value" value="${normalValue}" id="service_normal_value" class="form-control">
          </form>`,
    showCancelButton: true,
    confirmButtonText: "Edit",
    customClass: {
      confirmButton: "btn btn-success",
    },
    showLoaderOnConfirm: true,
    preConfirm: () => {
      serviceName = $("#service_name")[0].value;
      price = $("#service_price")[0].value;
      normalValue = $("#service_normal_value")[0].value;
      return fetch("utils/services/edit_services.php", {
        method: "POST",
        body: JSON.stringify({
          id: service.id,
          name: serviceName,
          price: price,
          normal_value: normalValue,
        }),
      }).then((response) => {
        if (response.ok) {
          Swal.fire({
            title: "Success",
            icon: "success",
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            title: "Error",
            icon: "error",
          });
        }
      });
    },
  });
}

function handleAddButtonClick(event) {
  event.preventDefault();
  service = {
    name: $("#add_service_name").get(0).value,
    price: $("#add_service_price").get(0).value,
    normal_value: $("#add_service_normal_value").get(0).value,
  };

  fetch("utils/services/add_services.php", {
    method: "POST",
    body: JSON.stringify(service),
  }).then((response) => {
    if (response.ok) {
      console.log(response);
      Swal.fire({
        title: "Success",
        icon: "success",
      }).then(() => {
        location.reload();
      });
    } else {
      Swal.fire({
        title: "Error",
        icon: "error",
      });
    }
  });
}

function handleDeleteButtonClick(id) {
  Swal.fire({
    title: "Are you sure you want to delete?",
    icon: "warning",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      fetch("utils/services/delete_services.php", {
        method: "POST",
        body: JSON.stringify({ id: id }),
      }).then((response) => {
        if (response.ok) {
          console.log(response);
          Swal.fire({
            title: "Success",
            icon: "success",
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            title: "Error",
            icon: "error",
          });
        }
      });
    }
  });
}
