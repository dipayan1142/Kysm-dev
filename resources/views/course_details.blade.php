@extends('front.layouts.app')
@section('content')

      

     <!-- section -->

     <section class="inner_banner">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="full">
              <h3>Our Course Details</h3>
              <h4>Course Name</h4>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end section -->

    <!-- About Course Start -->
    <div class="container-fluid py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="text-center pb-2">
              <p class="section-title px-5">
                <span class="px-2">EXPLORE COURSES BY CATEGORIES</span>
              </p>
            </div>
          </div>
          <div class="col-lg-5">
            <img
              class="card-img-top mb-2 mr-2 mb-lg-0"
              src="images/course-1-1.jpg"
              alt=""
              style="aspect-ratio: 3/2; object-fit: contain"
            />
          </div>
          <div class="col-lg-7">
            <p class="section-title pr-5">
              <span class="pr-2">About Courses</span>
            </p>

            <p>
              Invidunt lorem justo sanctus clita. Erat lorem labore ea, justo
              dolor lorem ipsum ut sed eos, ipsum et dolor kasd sit ea justo.
              Erat justo sed sed diam. Ea et erat ut sed diam sea ipsum est
              dolor
            </p>
            <div class="row pt-1 pb-1">
              <div class="col-12 col-md-12">
                <h3 class="mb-1">Key Features</h3>
                <ul class="list-inline m-0">
                  <li class="py-2 border-top border-bottom">
                    <i class="fa fa-check text-primary mr-3"></i>Labore eos amet
                    dolor amet diam
                  </li>
                  <li class="py-2 border-bottom">
                    <i class="fa fa-check text-primary mr-3"></i>Etsea et sit
                    dolor amet ipsum
                  </li>
                  <li class="py-2 border-bottom">
                    <i class="fa fa-check text-primary mr-3"></i>Diam dolor diam
                    elitripsum vero.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- About Course End -->

    <!-- Semister section start -->
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button
                  class="accordion-button"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseOne"
                  aria-expanded="true"
                  aria-controls="collapseOne"
                >
                  Semister #1
                </button>
              </h2>
              <div
                id="collapseOne"
                class="accordion-collapse collapse show"
                data-bs-parent="#accordionExample"
              >
                <div class="accordion-body">
                  <strong>This is the first item's accordion body.</strong> It
                  is shown by default, until the collapse plugin adds the
                  appropriate classes that we use to style each element.
                  <code>.accordion-body</code>, though the transition does limit
                  overflow.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo"
                  aria-expanded="false"
                  aria-controls="collapseTwo"
                >
                  Semister #2
                </button>
              </h2>
              <div
                id="collapseTwo"
                class="accordion-collapse collapse"
                data-bs-parent="#accordionExample"
              >
                <div class="accordion-body">
                  <strong>This is the second item's accordion body.</strong> It
                  is hidden by default, until the collapse plugin adds the
                  appropriate classes that we use to style each element.
                  <code>.accordion-body</code>, though the transition does limit
                  overflow.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseThree"
                  aria-expanded="false"
                  aria-controls="collapseThree"
                >
                  Semister #3
                </button>
              </h2>
              <div
                id="collapseThree"
                class="accordion-collapse collapse"
                data-bs-parent="#accordionExample"
              >
                <div class="accordion-body">
                  <strong>This is the third item's accordion body.</strong> It
                  is hidden by default, until the collapse plugin adds the
                  appropriate classes that we use to style each element.
                  <code>.accordion-body</code>, though the transition does limit
                  overflow.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Semister Section End -->
    <!-- Course Module Start -->
    <div class="container-fluid pt-5">
      <div class="container pb-3">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">EXPLORE COURSES BY CATEGORIES</span>
          </p>
          <h1 class="mb-4">Explore our course catalog</h1>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-4 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 10px"
            >
              <i
                class="flaticon-050-fence flaticon-h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="flaticon-pl-4">
                <h4>Module 1</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 10px"
            >
              <i
                class="flaticon-022-drum flaticon-h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="flaticon-pl-4">
                <h4>Module 2</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 10px"
            >
              <i
                class="flaticon-030-crayons flaticon-h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="flaticon-pl-4">
                <h4>Module 3</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 10px"
            >
              <i
                class="flaticon-017-toy-car flaticon-h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="flaticon-pl-4">
                <h4>Module 4</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 10px"
            >
              <i
                class="flaticon-025-sandwich flaticon-h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="flaticon-pl-4">
                <h4>Module 5</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 10px"
            >
              <i
                class="flaticon-047-backpack flaticon-h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="flaticon-pl-4">
                <h4>Module 6</h4>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 10px"
            >
              <i
                class="flaticon-047-backpack flaticon-h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="flaticon-pl-4">
                <h4>Module 7</h4>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 10px"
            >
              <i
                class="flaticon-047-backpack flaticon-h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="flaticon-pl-4">
                <h4>Module 8</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Course module end -->
    

@endsection