(() => {
    'use strict'
  
    document.querySelector('#navbarSideCollapse').addEventListener('click', () => {
      document.querySelector('.offcanvas-collapse').classList.toggle('open')
    })
  })()

  
var confirm_edit_employee = document.getElementById('confirm_edit_employee');
if(!!confirm_edit_employee){
  confirm_edit_employee.addEventListener('click', function(e){

        var html = '';
        var nulo = true;
        html    += '<ul class="list-group mb-3">';

        var inputs = document.querySelectorAll('form.edit-employee .edit');
        inputs.forEach((userItem) => {
          if(userItem.getAttribute('data-old') != userItem.value){
            nulo = false;
            html += `<li class="list-group-item d-flex justify-content-between lh-sm">
                          <label class="form-label">`+userItem.getAttribute('data-label')+` </label>
                          <div>
                            <h6 class="my-0 text-success">`+userItem.value+`</h6>
                            <small class="text-secondary">`+userItem.getAttribute('data-old')+`</small>
                          </div>
                        </li>`;
          }
        });
        const btn_confirm_employee = document.querySelector("#btn_confirm_employee");

        if(nulo){
          html += `<li class="list-group-item text-center justify-content-between lh-sm ">
                          <label for="job_desc" class="form-label text-secondary"> Not change on the data.</label>
                    </li>`;
          btn_confirm_employee.disabled = true;
        }else{
          btn_confirm_employee.disabled = false;

        }
        html += '</ul>';
        const data = document.querySelector("#body_edit_modal_employee");
        data.innerHTML = html;


        var modal_employee = new bootstrap.Modal(document.getElementById('modal_employee'))
        modal_employee.show();
  });
}


var btn_confirm_employee = document.getElementById('btn_confirm_employee');
if(!!btn_confirm_employee){
  btn_confirm_employee.addEventListener('click', function(e){ 
    var save_employee = document.querySelector('#save_employee');
    save_employee.click();
    // location.href = "./employee.php";
  });

}

