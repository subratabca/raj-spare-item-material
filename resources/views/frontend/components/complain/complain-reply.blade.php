@extends('frontend.components.dashboard.dashboard-master')

@section('dashboard-content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <h5 class="card-header pb-3 border-bottom mb-3">Complain Reply</h5>
      <div class="card-body">
        <form id="complain-form">
          <div id="snow-toolbar">
            <span class="ql-formats">
              <select class="ql-font"></select>
              <select class="ql-size"></select>
            </span>
            <span class="ql-formats">
              <button class="ql-bold"></button>
              <button class="ql-italic"></button>
              <button class="ql-underline"></button>
              <button class="ql-strike"></button>
            </span>
            <span class="ql-formats">
              <select class="ql-color"></select>
              <select class="ql-background"></select>
            </span>
            <span class="ql-formats">
              <button class="ql-script" value="sub"></button>
              <button class="ql-script" value="super"></button>
            </span>
            <span class="ql-formats">
              <button class="ql-header" value="1"></button>
              <button class="ql-header" value="2"></button>
              <button class="ql-blockquote"></button>
              <button class="ql-code-block"></button>
            </span>
          </div>

          <div id="snow-editor"></div>
          <div id="message-error" class="text-danger mt-2"></div>
          <div class="mt-3">
            <button type="submit" class="btn btn-primary">Send Reply</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/libs/quill/editor.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset('frontend/assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/forms-editors.js') }}"></script>

<script>
  var quill;
  document.addEventListener("DOMContentLoaded", function() {
      quill = new Quill('#snow-editor', {
          theme: 'snow',
          modules: {
              toolbar: '#snow-toolbar'
          }
      });

      const form = document.getElementById('complain-form');
      form.addEventListener('submit', async function(event) {
          event.preventDefault();
          await Save();
      });
  });

async function Save() {
    let url = window.location.pathname;
    let segments = url.split('/');
    let complain_id = segments[segments.length - 1];

    let message = quill.root.innerHTML;
    document.getElementById('message-error').textContent = '';

    let isValid = true;

    // Strip out HTML tags to validate the actual text content
    let textMessage = quill.getText().trim();

    if (textMessage === '') {
        document.getElementById('message-error').textContent = 'Message is required';
        isValid = false;
    } else if (textMessage.length < 10) {
        document.getElementById('message-error').textContent = 'Message must be at least 10 characters long';
        isValid = false;
    }

    if (isValid) {
        let formData = new FormData();
        formData.append('complain_id', complain_id);
        formData.append('reply_message', message);

        const config = {
            headers: {
                'content-type': 'multipart/form-data',
            },
        };

        try {
            let res = await axios.post("/user/store-complain-reply-info", formData, config);

            if (res.status === 201 && res.data.status === "success") {
                successToast(res.data.message || 'Request success');
                quill.root.innerHTML = ''; 
                window.location.href = '/user/complain-list'
            } else {
                errorToast("Request failed with status: " + res.status);
            }

        } catch (error) {
            if (error.response) {
                const status = error.response.status;
                const message = error.response.data.message || 'An unexpected error occurred';

                if (status === 403) {
                    errorToast(message);  
                } else if (status === 422) {
                    const errors = error.response.data.errors;
                    if (errors) {
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorToast(errors[key][0]);
                            }
                        }
                    } else {
                        errorToast(message);
                    }
                } else if (status === 404) {
                    errorToast(message || 'Not Found');
                } else if (status === 500) {
                    errorToast('Server error: ' + message);  
                } else {
                    errorToast(message);  
                }
            } else {
                errorToast('Error: ' + error.message);  
            }
        }



    }
}

</script>
@endpush
