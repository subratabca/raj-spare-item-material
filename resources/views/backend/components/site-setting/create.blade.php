<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Create site setting</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <form id="save-form">
          <div class="row">
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="name"
                placeholder="Enter company name" />
                <label for="exampleFormControlInput1">Company Name:<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="name-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="email"
                class="form-control"
                id="email"
                placeholder="Enter email address" />
                <label for="exampleFormControlInput1">Email:<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="email-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="phone1"
                placeholder="Enter phone number" />
                <label for="exampleFormControlInput1">Phone1:<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="phone1-error"></span>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="phone2"
                placeholder="Enter phone number" />
                <label for="exampleFormControlInput1">Phone2:<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="phone2-error"></span>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="address"
                placeholder="Enter address" />
                <label for="exampleFormControlInput1">Address:<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="address-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="country"
                placeholder="Enter country" />
                <label for="exampleFormControlInput1">Country:<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="country-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="city"
                placeholder="Enter city" />
                <label for="exampleFormControlInput1">City:<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="city-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="zip_code"
                placeholder="Enter zip code" />
                <label for="exampleFormControlInput1">Zip Code<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="zip_code-error"></span>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="facebook"
                placeholder="Enter facebook link" />
                <label for="exampleFormControlInput1">Facebook Link:<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="facebook-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="linkedin"
                placeholder="Enter linkedin link" />
                <label for="exampleFormControlInput1">Linkedin Link:<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="linkedin-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="youtube"
                placeholder="Enter food collection address" />
                <label for="exampleFormControlInput1">Youtube Link:<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="youtube-error"></span>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Food Image<span class="text-danger">*</span></label>
                    <input class="form-control" type="file" id="image" onChange="mainImageUrl(this)"/>
                    <img src="{{asset('/upload/no_image.jpg')}}" id="mainImage" class="mt-1" style="width: 150px; height: 100px;">
                  </div>
                  <span class="error-message text-danger" id="image-error"></span>
                </div>
              </div>
            </div>

            <div class="col-md-6 my-4">
              <div class="card">
                <h5 class="card-header">Company Description:<span class="text-danger">*</span></h5>
                <div class="card-body">
                   @include('backend.components.editor')
                  <div id="snow-editor">

                  </div>
                  <span class="error-message text-danger" id="description-error"></span>
                </div>
              </div>
            </div>

            <div class="col-md-6 my-4">
              <div class="card">
                <h5 class="card-header">Refund Policy Description:<span class="text-danger">*</span></h5>
                <div class="card-body">
                   @include('backend.components.editor1')
                  <div id="snow-editor1">

                  </div>
                  <span class="error-message text-danger" id="refund-error"></span>
                </div>
              </div>
            </div>

            <div class="col-md-6 my-4">
              <div class="card">
                <h5 class="card-header">Terms & Condition Description:<span class="text-danger">*</span></h5>
                <div class="card-body">
                   @include('backend.components.editor2')
                  <div id="snow-editor2">

                  </div>
                  <span class="error-message text-danger" id="terms-error"></span>
                </div>
              </div>
            </div>

            <div class="col-md-6 my-4">
              <div class="card">
                <h5 class="card-header">Privacy Policy Description:<span class="text-danger">*</span></h5>
                <div class="card-body">
                   @include('backend.components.editor3')
                  <div id="snow-editor3">

                  </div>
                  <span class="error-message text-danger" id="privacy-error"></span>
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
  var quill, quill1, quill2, quill3;
  document.addEventListener("DOMContentLoaded", function() {
      quill = new Quill('#snow-editor', {
          theme: 'snow',
          modules: {
              toolbar: '#toolbar'
          }
      });

      quill1 = new Quill('#snow-editor1', {
          theme: 'snow',
          modules: {
              toolbar: '#toolbar1'
          }
      });
      
      quill2 = new Quill('#snow-editor2', {
          theme: 'snow',
          modules: {
              toolbar: '#toolbar2'
          }
      });

      quill3 = new Quill('#snow-editor3', {
          theme: 'snow',
          modules: {
              toolbar: '#toolbar3'
          }
      });

      const form = document.getElementById('save-form');
      form.addEventListener('submit', async function(event) {
          event.preventDefault();
          await Save();
      });
  });

  function mainImageUrl(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#mainImage').attr('src', e.target.result).width(150).height(100);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

function resetCreateForm() {
  document.getElementById('save-form').reset(); // Resets all input fields
  document.getElementById('mainImage').src = "{{asset('/upload/no_image.jpg')}}"; 

  quill.setText('');
  quill1.setText('');
  quill2.setText('');
  quill3.setText('');
  
  document.getElementById('name-error').innerText = '';
  document.getElementById('email-error').innerText = '';
  document.getElementById('phone1-error').innerText = '';
  document.getElementById('phone2-error').innerText = '';
  document.getElementById('address-error').innerText = '';
  document.getElementById('country-error').innerText = '';
  document.getElementById('city-error').innerText = '';
  document.getElementById('zip_code-error').innerText = '';
  document.getElementById('facebook-error').innerText = '';
  document.getElementById('linkedin-error').innerText = '';
  document.getElementById('youtube-error').innerText = '';
  document.getElementById('description-error').innerText = '';
  document.getElementById('refund-error').innerText = '';
  document.getElementById('terms-error').innerText = '';
  document.getElementById('privacy-error').innerText = '';
  document.getElementById('image-error').innerText = '';
}


  async function Save() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone1 = document.getElementById('phone1').value;
    const phone2 = document.getElementById('phone2').value;
    const address = document.getElementById('address').value;
    const country = document.getElementById('country').value;
    const city = document.getElementById('city').value;
    const zip_code = document.getElementById('zip_code').value;
    const facebook = document.getElementById('facebook').value;
    const linkedin = document.getElementById('linkedin').value;
    const youtube = document.getElementById('youtube').value;
    const description = quill.getText().trim();  
    const refund = quill1.getText().trim();
    const terms = quill2.getText().trim();
    const privacy = quill3.getText().trim();
    const image = document.getElementById('image').files[0];

    document.getElementById('name-error').innerText = '';
    document.getElementById('email-error').innerText = '';
    document.getElementById('phone1-error').innerText = '';
    document.getElementById('phone2-error').innerText = '';
    document.getElementById('address-error').innerText = '';
    document.getElementById('country-error').innerText = '';
    document.getElementById('city-error').innerText = '';
    document.getElementById('zip_code-error').innerText = '';
    document.getElementById('facebook-error').innerText = '';
    document.getElementById('linkedin-error').innerText = '';
    document.getElementById('youtube-error').innerText = '';
    document.getElementById('description-error').innerText = '';
    document.getElementById('refund-error').innerText = '';
    document.getElementById('terms-error').innerText = '';
    document.getElementById('privacy-error').innerText = '';
    document.getElementById('image-error').innerText = '';


    if (name.length === 0) {
      errorToast("Company name required !");
    } 
    else if (email.length === 0) {
      errorToast("Email required !");
    } 
    else if (phone1.length === 0) {
      errorToast("Phone number required !");
    }
    else if (phone2.length === 0) {
      errorToast("Phone number2 required !");
    }
    else if (address.length === 0) {
      errorToast("Address required !");
    }
    else if (country.length === 0) {
      errorToast("Country required !");
    }
    else if (city.length === 0) {
      errorToast("City required !");
    }
    else if (zip_code.length === 0) {  
      errorToast("Zip code required !");
    }
    else if (facebook.length === 0) {
      errorToast("Facebook url required !");
    }
    else if (linkedin.length === 0) {
      errorToast("Linkedin url required !");
    }
    else if (youtube.length === 0) {
      errorToast("Youtube url required !");
    }
    else if (description.length === 0) {
      errorToast("Company description required !");
    }
    else if (refund.length === 0) {
      errorToast("Refund description required !");
    }
    else if (terms.length === 0) {  
      errorToast("T&C description required !");
    }
    else if (privacy.length === 0) {  
      errorToast("Privacy description required !");
    }
    else if (!image) {
      errorToast("Logo required !");
    }   
    else {
      let formData = new FormData();
          formData.append('name', name);
          formData.append('email', email);
          formData.append('phone1', phone1);
          formData.append('phone2', phone2);
          formData.append('address', address);
          formData.append('country', country);
          formData.append('city', city);
          formData.append('zip_code', zip_code);
          formData.append('facebook', facebook);
          formData.append('linkedin', linkedin);
          formData.append('youtube', youtube);
          formData.append('description', description);
          formData.append('refund', refund);
          formData.append('terms', terms);
          formData.append('privacy', privacy);
          formData.append('logo', image);

          const config = {
              headers: {
                  'content-type': 'multipart/form-data'
              }
          };

      try {
        const res = await axios.post('/admin/store/site-setting', formData, config);
        if (res.status === 201) {
          successToast(res.data.message || 'Request success');
          window.location.href = '/admin/setting-page';
          resetCreateForm();
        } else {
          errorToast(res.data.message || "Request failed");
        }
      } catch (error) {
          if (error.response && error.response.status === 422) {
            let errorMessages = error.response.data.errors;
            for (let field in errorMessages) {
              if (errorMessages.hasOwnProperty(field)) {
                document.getElementById(`${field}-error`).innerText = errorMessages[field][0];
              }
            }
          } else if (error.response && error.response.status === 500) {
            errorToast(error.response.data.error);
          } else {
            errorToast("Request failed!");
          }
      }
    }
  }

</script>

