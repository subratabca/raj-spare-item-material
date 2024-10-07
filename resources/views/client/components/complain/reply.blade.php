<div class="modal fade" id="reply-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel3">Reply your complain</h4>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="save-form">
          <div class="row">
            <input type="text" class="d-none" id="complainID">
            <div class="col-md-12 my-4">
              <div class="card">
                <div class="card-body">
                   @include('client.components.editor')
                  <div id="snow-editor"></div>
                  <span class="error-message text-danger" id="reply_message-error"></span>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <!-- Update button with an id to attach the click handler -->
        <button type="button" class="btn btn-primary" id="send-reply-btn">Send Reply</button>
      </div>
    </div>
  </div>
</div>

<script>
  var quill;
  document.addEventListener("DOMContentLoaded", function() {
      // Initialize Quill editor
      quill = new Quill('#snow-editor', {
          theme: 'snow',
          modules: {
              toolbar: '#toolbar'
          }
      });

      // Attach click event to the Send Reply button
      document.getElementById('send-reply-btn').addEventListener('click', function(event) {
          event.preventDefault();
          sendReply();
      });
  });

  async function sendReply() {
      let message = quill.getText().trim();
      let complainID = document.getElementById('complainID').value;

      document.getElementById('reply_message-error').innerText = '';

      if (message === '') {
          document.getElementById('reply_message-error').innerText = 'Message is required';
      } else {
          let formData = new FormData();
          formData.append('reply_message', message);
          formData.append('complain_id', complainID);

          const config = {
              headers: {
                  'content-type': 'multipart/form-data'
              }
          };

          showLoader();

          try {
              let res = await axios.post("/client/store-complain-feedback", formData, config);
              if (res.status === 201) {
                  successToast(res.data.message || 'Complain feedback given successfully');
                  window.location.href = '/client/complain-list';
                  document.getElementById('save-form').reset();
                  $('#reply-modal').modal('hide');
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
              } else if (error.response && error.response.status === 403) {
                  errorToast(error.response.data.message);
              } else if (error.response && error.response.status === 500) {
                  errorToast(error.response.data.error);
              } else if (error.response && error.response.status === 404) {
                  errorToast(error.response.data.message || "Complain not found!");  
              } else {
                  errorToast("Request failed!");
              }
          } finally {
              hideLoader();
          }
      }
  }
</script>
