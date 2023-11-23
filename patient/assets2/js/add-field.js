var counter = 1;
function add_more_field() {
  counter+=1;
   html = `<div class="row" id="row'+counter+'"> 
   <select class="form-select" id="test'+counter+'" name="request_test" aria-label="Default select example">  
       <option id="opt-test" value=""></option>
   </select>
   </div>`
    var form = document.getElementById('service_form')
    form.innerHTML+= html
}

