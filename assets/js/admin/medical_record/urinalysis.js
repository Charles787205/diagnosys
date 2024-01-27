function saveUrinalysis() {
  const resultInputs = $("input[data-type='result']");
  const requestSelect = document.getElementById("patient-select");
  const requestId = requestSelect.value;
  const results = [];
  for (const resultInput of resultInputs) {
    const resultValue = $(resultInput).val();
    const name = $(resultInput).attr("name");

    const result = {
      request_id: requestId,
      service_id: serviceId,
      result: resultValue,
      test: name,
    };
    results.push(result);
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
