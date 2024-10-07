      <a href="{{ url('/') }}" class="auth-cover-brand d-flex align-items-center gap-2">
        <span class="app-brand-logo demo">
          <span style="color: var(--bs-primary)">
            <svg width="268" height="150" viewBox="0 0 38 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z"
                fill="currentColor" />
              <path
                d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z"
                fill="url(#paint0_linear_2989_100980)"
                fill-opacity="0.4" />
              <path
                d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z"
                fill="currentColor" />
              <path
                d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                fill="currentColor" />
              <path
                d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                fill="url(#paint1_linear_2989_100980)"
                fill-opacity="0.4" />
              <path
                d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z"
                fill="currentColor" />
              <defs>
                <linearGradient
                  id="paint0_linear_2989_100980"
                  x1="5.36642"
                  y1="0.849138"
                  x2="10.532"
                  y2="24.104"
                  gradientUnits="userSpaceOnUse">
                  <stop offset="0" stop-opacity="1" />
                  <stop offset="1" stop-opacity="0" />
                </linearGradient>
                <linearGradient
                  id="paint1_linear_2989_100980"
                  x1="5.19475"
                  y1="0.849139"
                  x2="10.3357"
                  y2="24.1155"
                  gradientUnits="userSpaceOnUse">
                  <stop offset="0" stop-opacity="1" />
                  <stop offset="1" stop-opacity="0" />
                </linearGradient>
              </defs>
            </svg>
          </span>
        </span>
        <span class="app-brand-text demo text-heading fw-bold">Materialize</span>
      </a>
      <!-- /Logo -->
      <div class="authentication-inner row m-0">
        <!-- /Left Section -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
          <img
            src="{{ asset('backend/assets/img/illustrations/auth-forgot-password-illustration-light.png') }}"
            class="auth-cover-illustration w-100"
            alt="auth-illustration"
            data-app-light-img="{{ asset('backend/assets/img/illustrations/auth-forgot-password-illustration-light.png') }}"
            data-app-dark-img="{{ asset('backend/assets/img/illustrations/auth-forgot-password-illustration-dark.png') }}" />

          <img
            src="{{ asset('backend/assets/img/illustrations/auth-cover-forgot-password-mask-light.png') }}"
            class="authentication-image"
            alt="mask"
            data-app-light-img="{{ asset('backend/assets/img/illustrations/auth-cover-forgot-password-mask-light.png') }}"
            data-app-dark-img="{{ asset('backend/assets/img/illustrations/auth-cover-forgot-password-mask-dark.png') }}" />
        </div>
        <!-- /Left Section -->

        <!-- Forgot Password -->
        <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
          <div class="w-px-400 mx-auto">
            <h4 class="mb-2">Forgot Password? 🔒</h4>
            <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
            <form id="formAuthentication" class="mb-3">
              <div class="form-floating form-floating-outline mb-3">
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  placeholder="Enter your email"
                  autofocus />
                <label for="email">Email</label>
                <span class="error-message text-danger" id="email-error"></span>
              </div>
              <button type="button" onclick="VerifyEmail()" class="btn btn-primary d-grid w-100">Send Reset Link</button>
            </form>
            <div class="text-center">
              <a href="{{ route('admin.login.page') }}" class="d-flex align-items-center justify-content-center">
                <i class="mdi mdi-chevron-left scaleX-n1-rtl mdi-24px"></i>
                Back to login
              </a>
            </div>
          </div>
        </div>
        <!-- /Forgot Password -->
      </div>

<script>
    async function VerifyEmail() {
        let email = document.getElementById('email').value;
        document.getElementById('email-error').innerText = '';

        if (email.length === 0) {
            errorToast('Please enter your email address');
        } else {
            try {
                let res = await axios.post('/admin/send-otp', { email: email });

                if (res.status === 200 && res.data['status'] === 'success') {
                    successToast(res.data['message']);
                    sessionStorage.setItem('email', email);
                    setTimeout(function () {
                        window.location.href = '/admin/verifyOtp';
                    }, 1000);
                } else {
                    errorToast(res.data['message']);
                }
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 422) {
                        const errors = error.response.data.errors; 
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                const errorMessage = errors[key][0];
                                document.getElementById(`${key}-error`).innerText = errorMessage;
                            }
                        }
                    } else if (error.response.status === 401) {
                        errorToast(error.response.data.message || 'User not found');
                    } else {
                        errorToast(error.response.data.message || 'An unexpected error occurred.');
                    }
                } else {
                    errorToast('An unexpected error occurred.');
                }
            }
        }
    }
</script>

