<section id="landingFeatures" class="section-py landing-features">
  <div class="container">               
    <div class="app-academy">
        <div class="card p-0 mb-4">
          <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0 pt-4">
            <div class="app-academy-md-25 card-body py-0">
              <img
                src="{{ asset('frontend/assets/img/illustrations/bulb-light.png') }}"
                class="img-fluid app-academy-img-height scaleX-n1-rtl"
                alt="Bulb in hand"
                data-app-light-img="illustrations/bulb-light.png"
                data-app-dark-img="illustrations/bulb-dark.png"
                height="90" />
            </div>
            <div
              class="app-academy-md-50 card-body d-flex align-items-md-center flex-column text-md-center mb-4">
              <span class="card-title mb-3 lh-lg px-md-5 display-6 text-heading">
                Education, talents, and career opportunities.
                <span class="text-primary text-nowrap">All in one place</span>.
              </span>
              <p class="mb-3 px-2">
                Grow your skill with the most reliable online courses and certifications in marketing,
                information technology, programming, and data science.
              </p>
              <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                <input type="search" placeholder="Find your course" class="form-control me-2" />
                <button type="submit" class="btn btn-primary btn-icon"><i class="mdi mdi-magnify"></i></button>
              </div>
            </div>
            <div class="app-academy-md-25 d-flex align-items-end justify-content-end">
              <img
                src="{{ asset('frontend/assets/img/illustrations/pencil-rocket.png') }}"
                alt="pencil rocket"
                height="188"
                class="scaleX-n1-rtl" />
            </div>
          </div>
        </div>   
        <div class="card mb-4">
          <div class="card-header d-flex flex-wrap justify-content-between gap-3">
            <div class="card-title mb-0 me-1">
              <h5 class="mb-1">My Courses</h5>
              <p class="mb-0">Total 6 course you have purchased</p>
            </div>
          </div>
          <div class="card-body">
            <div class="row gy-4 mb-4">
              <div class="col-sm-6 col-lg-4">
                <div class="card p-2 h-100 shadow-none border">
                  <div class="rounded-2 text-center mb-3">
                    <a href="app-academy-course-details.html"
                      ><img
                        class="img-fluid"
                        src="{{ asset('frontend/assets/img/pages/app-academy-tutor-1.png') }}"
                        alt="tutor image 1"
                    /></a>
                  </div>
                  <div class="card-body p-3 pt-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <span class="badge rounded-pill bg-label-primary">Web</span>
                      <p class="d-flex align-items-center justify-content-center gap-1 mb-0">
                        4.4 <span class="text-warning"><i class="mdi mdi-star me-1"></i></span
                        ><span class="fw-normal">(1.23k)</span>
                      </p>
                    </div>
                    <a href="app-academy-course-details.html" class="h5">Basics of Angular</a>
                    <p class="mt-2">Introductory course for Angular and framework basics in web development.</p>
                    <p class="d-flex align-items-center">
                      <i class="mdi mdi-timer-outline me-2"></i>30 minutes
                    </p>
                    <div class="progress rounded-pill mb-4" style="height: 8px">
                      <div
                        class="progress-bar w-75"
                        role="progressbar"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                    <div
                      class="d-flex flex-column flex-md-row gap-3 text-nowrap flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                      <a
                        class="w-100 btn btn-outline-secondary d-flex align-items-center"
                        href="app-academy-course-details.html">
                        <i class="mdi mdi-sync align-middle me-1"></i><span>Start Over</span>
                      </a>
                      <a
                        class="w-100 btn btn-outline-primary d-flex align-items-center"
                        href="app-academy-course-details.html">
                        <span class="me-1">Continue</span><i class="mdi mdi-arrow-right lh-1 scaleX-n1-rtl"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card shadow-none border p-2 h-100">
                  <div class="rounded-2 text-center mb-3">
                    <a href="app-academy-course-details.html"
                      ><img
                        class="img-fluid"
                        src="{{ asset('frontend/assets/img/pages/app-academy-tutor-2.png') }}"
                        alt="tutor image 2"
                    /></a>
                  </div>
                  <div class="card-body p-3 pt-2">
                    <div class="d-flex justify-content-between align-items-center mb-3 pe-xl-3 pe-xxl-0">
                      <span class="badge rounded-pill bg-label-danger">UI/UX</span>
                      <p class="d-flex align-items-center justify-content-center gap-1 mb-0">
                        4.2 <span class="text-warning"><i class="mdi mdi-star me-1"></i></span
                        ><span class="fw-noraml"> (424)</span>
                      </p>
                    </div>
                    <a class="h5" href="app-academy-course-details.html">Figma & More</a>
                    <p class="mt-2">Introductory course for design and framework basics in web development.</p>
                    <p class="d-flex align-items-center"><i class="mdi mdi-timer-outline me-2"></i>16 hours</p>
                    <div class="progress rounded-pill mb-4" style="height: 8px">
                      <div
                        class="progress-bar w-25"
                        role="progressbar"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                    <div
                      class="d-flex flex-column flex-md-row gap-3 text-nowrap flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                      <a
                        class="w-100 btn btn-outline-secondary d-flex align-items-center"
                        href="app-academy-course-details.html">
                        <i class="mdi mdi-sync align-middle me-1"></i><span>Start Over</span>
                      </a>
                      <a
                        class="w-100 btn btn-outline-primary d-flex align-items-center"
                        href="app-academy-course-details.html">
                        <span class="me-1">Continue</span><i class="mdi mdi-arrow-right lh-1 scaleX-n1-rtl"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card shadow-none border p-2 h-100">
                  <div class="rounded-2 text-center mb-3">
                    <a href="app-academy-course-details.html"
                      ><img
                        class="img-fluid"
                        src="{{ asset('frontend/assets/img/pages/app-academy-tutor-3.png') }}"
                        alt="tutor image 3"
                    /></a>
                  </div>
                  <div class="card-body p-3 pt-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <span class="badge rounded-pill bg-label-success">SEO</span>
                      <p class="d-flex align-items-center justify-content-center gap-1 mb-0">
                        5 <span class="text-warning"><i class="mdi mdi-star me-1"></i></span
                        ><span class="fw-noraml"> (12)</span>
                      </p>
                    </div>
                    <a class="h5" href="app-academy-course-details.html">Keyword Research</a>
                    <p class="mt-2">
                      Keyword suggestion tool provides comprehensive details & keyword suggestions.
                    </p>
                    <p class="d-flex align-items-center"><i class="mdi mdi-timer-outline me-2"></i>7 hours</p>
                    <div class="progress rounded-pill mb-4" style="height: 8px">
                      <div
                        class="progress-bar w-50"
                        role="progressbar"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                    <div
                      class="d-flex flex-column flex-md-row gap-3 text-nowrap flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                      <a
                        class="w-100 btn btn-outline-secondary d-flex align-items-center"
                        href="app-academy-course-details.html">
                        <i class="mdi mdi-sync align-middle me-1"></i><span>Start Over</span>
                      </a>
                      <a
                        class="w-100 btn btn-outline-primary d-flex align-items-center"
                        href="app-academy-course-details.html">
                        <span class="me-1">Continue</span><i class="mdi mdi-arrow-right lh-1 scaleX-n1-rtl"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card shadow-none border p-2 h-100">
                  <div class="rounded-2 text-center mb-3">
                    <a href="app-academy-course-details.html"
                      ><img
                        class="img-fluid"
                        src="{{ asset('frontend/assets/img/pages/app-academy-tutor-4.png') }}"
                        alt="tutor image 4"
                    /></a>
                  </div>
                  <div class="card-body p-3 pt-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <span class="badge rounded-pill bg-label-info">Music</span>
                      <p class="d-flex align-items-center justify-content-center gap-1 mb-0">
                        3.8 <span class="text-warning"><i class="mdi mdi-star me-1"></i></span
                        ><span class="fw-noraml"> (634)</span>
                      </p>
                    </div>
                    <a class="h5" href="app-academy-course-details.html">Basics to Advanced</a>
                    <p class="mt-2">
                      20 more lessons like this about music production, writing, mixing, mastering
                    </p>
                    <p class="d-flex align-items-center">
                      <i class="mdi mdi-timer-outline me-2"></i>30 minutes
                    </p>
                    <div class="progress rounded-pill mb-4" style="height: 8px">
                      <div
                        class="progress-bar w-75"
                        role="progressbar"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                    <div
                      class="d-flex flex-column flex-md-row gap-3 text-nowrap flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                      <a
                        class="w-100 btn btn-outline-secondary d-flex align-items-center"
                        href="app-academy-course-details.html">
                        <i class="mdi mdi-sync align-middle me-1"></i><span>Start Over</span>
                      </a>
                      <a
                        class="w-100 btn btn-outline-primary d-flex align-items-center"
                        href="app-academy-course-details.html">
                        <span class="me-1">Continue</span><i class="mdi mdi-arrow-right lh-1 scaleX-n1-rtl"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card shadow-none border p-2 h-100">
                  <div class="rounded-2 text-center mb-3">
                    <a href="app-academy-course-details.html"
                      ><img
                        class="img-fluid"
                        src="{{ asset('frontend/assets/img/pages/app-academy-tutor-5.png') }}"
                        alt="tutor image 5"
                    /></a>
                  </div>
                  <div class="card-body p-3 pt-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <span class="badge rounded-pill bg-label-warning">Painting</span>
                      <p class="d-flex align-items-center justify-content-center gap-1 mb-0">
                        4.7 <span class="text-warning"><i class="mdi mdi-star me-1"></i></span
                        ><span class="fw-noraml"> (34)</span>
                      </p>
                    </div>
                    <a class="h5" href="app-academy-course-details.html">Art & Drawing</a>
                    <p class="mt-2">
                      Easy-to-follow video & guides show you how to draw animals, people & more.
                    </p>
                    <p class="d-flex align-items-center text-success">
                      <i class="mdi mdi-check me-2"></i>Completed
                    </p>
                    <div class="progress rounded-pill mb-4" style="height: 8px">
                      <div
                        class="progress-bar w-100"
                        role="progressbar"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                    <a class="w-100 btn btn-outline-primary" href="app-academy-course-details.html"
                      ><i class="mdi mdi-sync me-2"></i>Start Over</a
                    >
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card shadow-none border p-2 h-100">
                  <div class="rounded-2 text-center mb-3">
                    <a href="app-academy-course-details.html"
                      ><img
                        class="img-fluid"
                        src="{{ asset('frontend/assets/img/pages/app-academy-tutor-6.png') }}"
                        alt="tutor image 6"
                    /></a>
                  </div>
                  <div class="card-body p-3 pt-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <span class="badge rounded-pill bg-label-danger">UI/UX</span>
                      <p class="d-flex align-items-center justify-content-center gap-1 mb-0">
                        3.6 <span class="text-warning"><i class="mdi mdi-star me-1"></i></span
                        ><span class="fw-noraml"> (2.5k)</span>
                      </p>
                    </div>
                    <a class="h5" href="app-academy-course-details.html">Basics Fundamentals</a>
                    <p class="mt-2">This guide will help you develop a systematic approach user interface.</p>
                    <p class="d-flex align-items-center"><i class="mdi mdi-timer-outline me-2"></i>16 hours</p>
                    <div class="progress rounded-pill mb-4" style="height: 8px">
                      <div
                        class="progress-bar w-25"
                        role="progressbar"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                    <div
                      class="d-flex flex-column flex-md-row gap-3 text-nowrap flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                      <a
                        class="w-100 btn btn-outline-secondary d-flex align-items-center"
                        href="app-academy-course-details.html">
                        <i class="mdi mdi-sync align-middle me-1"></i><span>Start Over</span>
                      </a>
                      <a
                        class="w-100 btn btn-outline-primary d-flex align-items-center"
                        href="app-academy-course-details.html">
                        <span class="me-1">Continue</span><i class="mdi mdi-arrow-right lh-1 scaleX-n1-rtl"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">
              <ul class="pagination">
                <li class="page-item prev">
                  <a class="page-link" href="javascript:void(0);"
                  ><i class="tf-icon mdi mdi-chevron-left"></i
                  ></a>
                </li>
                <li class="page-item active">
                  <a class="page-link" href="javascript:void(0);">1</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0);">2</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0);">3</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0);">4</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0);">5</a>
                </li>
                <li class="page-item next">
                  <a class="page-link" href="javascript:void(0);"
                  ><i class="tf-icon mdi mdi-chevron-right"></i
                  ></a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
    </div>
  </div>
</section>