<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Create New T&C</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <form id="save-form">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="largeSelect" class="form-label">T&C For<span class="text-danger">*</span></label>
                <select id="name" class="form-select form-select-lg">
                  <option value="" disabled selected>Select T&C for</option>
                  <option value="Food Upload">Food Upload</option>
                  <option value="Request Approve">Request Approve</option>
                  <option value="Food Deliver">Food Deliver</option>
                </select>
                <span class="error-message text-danger" id="name-error"></span> 
              </div>
            </div>

            <div class="col-md-12 my-4">
              <div class="card">
                <h6 class="card-header">T&C Description<span class="text-danger">*</span></h6>
                <div class="card-body">
                  @include('backend.components.editor')
                  <div id="snow-editor">

                  </div>
                  <span class="error-message text-danger" id="description-error"></span>
                </div>
              </div>
            </div>
          </div>
        </form>
        <button onclick="Save()" class="btn btn-primary btn-lg">
          <i class="mdi mdi-check me-2"></i>Confirm
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  var quill;
  document.addEventListener("DOMContentLoaded", function() {
      quill = new Quill('#snow-editor', {
          theme: 'snow',
          modules: {
              toolbar: '#toolbar'
          }
      });

      const form = document.getElementById('save-form');
      form.addEventListener('onclick', async function(event) {
          event.preventDefault();
          await Save();
      });
  });


function resetCreateForm() {
  document.getElementById('save-form').reset();
  document.getElementById('name-error').innerText = ''; 
  document.getElementById('description-error').innerText = ''; 
  quill.setContents([]);
}



async function Save() {
    let name = document.getElementById('name').value;
    let descriptionText = quill.getText().trim();  

    let nameError = document.getElementById('name-error');
    let descriptionError = document.getElementById('description-error');

    if (nameError) {
        nameError.innerText = '';
    }
    if (descriptionError) {
        descriptionError.innerText = '';
    }

    if (name === '' || name === 'Select T&C for') {  
        if (nameError) {
            nameError.innerText = 'Please select a valid T&C option!';
        }
        return; 
    } 
    if (descriptionText.length < 10) {  
        if (descriptionError) {
            descriptionError.innerText = 'T&C description must be at least 10 characters long!';
        }
        return; 
    }

    let formData = new FormData();
    formData.append('name', name);
    formData.append('description', quill.root.innerHTML);

    const config = {
        headers: {
            'content-type': 'multipart/form-data',
        },
    };

    try {
        showLoader();
        let res = await axios.post("/admin/store/terms-conditions", formData, config);
        if (res.status === 201) {
            successToast(res.data.message || 'Request success');
            window.location.href = '/admin/terms-conditions/list';
            resetCreateForm();
        } else {
            errorToast(res.data.message || "Request failed");
        }
    } catch (error) {
        if (error.response && error.response.status === 422) {
            let errorMessages = error.response.data.errors;
            for (let field in errorMessages) {
                let fieldErrorElement = document.getElementById(`${field}-error`);
                if (fieldErrorElement) {
                    fieldErrorElement.innerText = errorMessages[field][0]; 
                }
            }
        } else if (error.response && error.response.status === 500) {
            errorToast(error.response.data.error);
        } else {
            errorToast("Request failed!");
        }
    } finally {
        hideLoader();
    }
}


</script>

