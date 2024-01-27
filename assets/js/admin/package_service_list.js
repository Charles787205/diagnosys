function handleEditButtonClick(packageService) {
  Swal.fire("hello");

  Swal.fire({
    title: "Edit Service",
    html: `<form action="" method="post">
            <label for="">Service Name</label>
            <input type="text" name="service_name" value="${packageService.name}" id="package_service_name" class="form-control">
            <label for="">Price</label>
            <input type="number" name="service_price" value="${packageService.price}" id="package_service_price" class="form-control">
            
          </form>`,
    showCancelButton: true,
    confirmButtonText: "Edit",
    customClass: {
      confirmButton: "btn btn-success",
    },
    showLoaderOnConfirm: true,
    preConfirm: () => {
      serviceName = $("#package_service_name")[0].value;
      price = $("#package_service_price")[0].value;
      return fetch("utils/services/edit_package_services.php", {
        method: "POST",
        body: JSON.stringify({
          id: packageService.id,
          name: serviceName,
          price: price,
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

function handleDeleteButtonClick(id) {
  Swal.fire({
    title: "Are you sure you want to delete?",
    icon: "warning",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      fetch("utils/services/delete_package_services.php", {
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
