@extends('front.layouts.app')
@section('content')



            <!-- Start Banner -->
    <div class="ulockd-home-slider">
      <div class="container-fluid">
        <div class="row">
          <div class="pogoSlider" id="js-main-slider">
            <div
              class="pogoSlider-slide"
              style="background-image: url({{asset('front/images/learning-Slider-1.jpg')}})"
            >
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="slide_text">
                      <h2>
                        A National Programme of Technical Education and
                        Development
                      </h2>
                      <h3>
                        <span span class="theme_color"
                          >KENDRIA YOUTH SAKSHARTA MISSION</span
                        >
                      </h3>

                      <p>Govt.Registration.No -IV 05377</p>
                      <p>
                        An Autonomous Institution Registered Under Public Trust
                        1882 Act. Govt. of INDIA
                      </p>
                      <br />
                      <h4>কেন্দ্রীয় যুব স্বাক্ষরতা মিশন</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="pogoSlider-slide"
              style="background-image: url({{asset('front/images/slider-1-1.jpg')}})"
            >
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="slide_text">
                      <h2>
                        A National Programme of Technical Education and
                        Development
                      </h2>
                      <h3>
                        <span span class="theme_color"
                          >KENDRIA YOUTH SAKSHARTA MISSION</span
                        >
                      </h3>

                      <p>Govt.Registration.No -IV 05377</p>
                      <p>
                        An Autonomous Institution Registered Under Public Trust
                        1882 Act. Govt. of INDIA
                      </p>
                      <br />
                      <h4>কেন্দ্রীয় যুব স্বাক্ষরতা মিশন</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Banner -->
    <!-- section -->
    <div class="section tabbar_menu">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="tab_menu">
              <ul>
                <li>
                  <a href="#"
                    ><span class="icon"
                      ><img src="{{asset('front/images/i1.png')}}" alt="#" /></span
                    ><span>Student Login</span></a
                  >
                </li>
                <li>
                  <a href="{{url('admin')}}"
                    ><span class="icon"
                      ><img src="{{asset('front/images/i2.png')}}" alt="#" /></span
                    ><span>Center Login</span></a
                  >
                </li>

                <li>
                  <a href="{{url('admin')}}"
                    ><span class="icon"
                      ><img src="{{asset('front/images/i5.png')}}" alt="#" /></span
                    ><span>Admin Login</span></a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end section -->
    <!-- section for welcome to kysm -->
    <div class="section margin-top_50" style="background-color: azure">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="full">
              <div class="heading_main text_align_left">
                <h2><span>Welcome To</span> KYSM</h2>
              </div>
              <div class="full">
                <p>
                  Computer is playing vital role in modern life. Computer
                  education has great importance because use of computer has
                  reached almost all spheres of life. India has answered the
                  call of modern Information Technology. Our Govt. also wants to
                  make a digital India. India has achieved tremendous growth in
                  this area and is now being considered as a potential I.T.
                  super power in the world. Information Technology education
                  requires high quality Competence & good Infrastructure in
                  order to make a competitive I.T. professional.
                </p>
              </div>
              <div class="full">
                <a class="hvr-radial-out button-theme" href="#">About more</a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="full">
              <img src="{{asset('front/images/kysm-img-1.jpg')}}" alt="#" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end section -->

    <!-- Class Start popular class-->
    <div class="container-fluid pt-5" style="background-color: aliceblue">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Popular Courses</span>
          </p>
        </div>
        <div class="row">

        @if(count($all_data['propular_course'])!=0)
          @foreach ($all_data['propular_course'] as $key => $val)
          <div class="col-lg-4 mb-1">
            <div class="card border-0 bg-light shadow-sm pb-2">
              <img
                class="card-img-top mb-2"
                src="{{asset('front/images/course-1-1.jpg')}}"
                alt=""
                style="aspect-ratio: 3/2; object-fit: cover"
              />
              <div class="card-body text-center">
                <h4 class="card-title mt-1">{{$val->course_name}}</h4>
                <p class="card-text">{{$val->short_description}}</p>
              </div>
              <div class="card-footer bg-transparent py-4 px-5">
                <div class="row border-bottom">
                  <div class="col-6 py-1 text-right border-right">
                    <strong>Eligibility </strong>
                  </div>
                  <div class="col-6 py-1">{{$val->eligibility}}</div>
                </div>
                <div class="row border-bottom">
                  <div class="col-6 py-1 text-right border-right">
                    <strong>Duration </strong>
                  </div>
                  <div class="col-6 py-1">{{$val->duration}}</div>
                </div>
                <div class="row border-bottom">
                  <div class="col-6 py-1 text-right border-right">
                    <strong>Enroll </strong>
                  </div>
                  <div class="col-6 py-1">{{$val->enroll}}</div>
                </div>
              </div>
              <a href="" class="btn btn-info btn-sm px-4 mx-auto mb-4"
                >Get Details</a
              >
            </div>
          </div>
          @endforeach
          @endif
        
        </div>
        <div class="row">
          <div class="col-12">
            <div class="d-flex justify-content-center mb-4 mt-4">
              <button
                type="button"
                name=""
                id=""
                class="btn btn-success px-4 mx-auto"
              >
                Get All Courses
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Class End -->

    <!-- section about us-->
    <div
      class="section layout_padding padding_bottom-0"
      style="background-color: antiquewhite"
    >
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="full">
              <div class="heading_main text_align_left">
                <h2><span>About Us</span></h2>
              </div>
              <div class="full">
                <p>
                  The main function of the society is to provide higher
                  technical education in minimum charges for every body of
                  society of Urban & Rural areas all over India and get success
                  in IT revolution which is the main dream of Indian Govt. In
                  present time, some big Institution run their IT programme in
                  higher charges. Due to which the middle class families of our
                  societies cannot afford the load of their charges. Our mission
                  studied them properly and decided to provide better higher
                  technical education, making a foundation of "KENDRIA YOUTH
                  SAKSHARTA MISSION" all over India.
                </p>
              </div>
              <div class="full">
                <a class="hvr-radial-out button-theme" href="#">See More</a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="full">
              <img
                class="img-responsive"
                src="{{asset('front/images/about-us-kysm-2.jpg')}}"
                alt="#"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end section -->

    <!-- section for branch-->
    <div
      class="section layout_padding padding_bottom-0"
      style="background-color: beige"
    >
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="full">
              <div class="heading_main text_align_center">
                <h2><span>Meet Our Branch</span></h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div id="demo" class="owl-carousel branch-carousel">
              <!-- The slideshow -->
              @if(count($all_data['center'])!=0)
              @foreach ($all_data['center'] as $key => $valc)
              <div class="row testimonial-item px-3">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="full blog_img_popular testimonial-item">
                    <img class="img-responsive" src="{{asset('front/images/img9.png')}}" alt="#" />
                    <h4>{{$valc->center_name}}</h4>
                    <p>
                      Akshya Nagar 1st Block 1st Cross, Rammurthy nagar,
                      Bangalore-560016
                    </p>
                  </div>
                </div>
              </div>

              @endforeach
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end section branch-->

    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
      <div class="container p-0">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Testimonial</span>
          </p>
          <h1 class="mb-4">What Parents Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-4 p-4">
              <h3 class="fas fa-quote-left text-primary mr-3"></h3>
              Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr
              eirmod clita lorem. Dolor tempor ipsum clita
            </div>
            <div class="d-flex align-items-center">
              <img
                class="rounded-circle"
                src="images/testimonial-1.jpg"
                style="width: 70px; height: 70px"
                alt="Image"
              />
              <div class="pl-3">
                <h5>Parent Name</h5>
                <i>Profession</i>
              </div>
            </div>
          </div>
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-4 p-4">
              <h3 class="fas fa-quote-left text-primary mr-3"></h3>
              Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr
              eirmod clita lorem. Dolor tempor ipsum clita
            </div>
            <div class="d-flex align-items-center">
              <img
                class="rounded-circle"
                src="images/testimonial-2.jpg"
                style="width: 70px; height: 70px"
                alt="Image"
              />
              <div class="pl-3">
                <h5>Parent Name</h5>
                <i>Profession</i>
              </div>
            </div>
          </div>
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-4 p-4">
              <h3 class="fas fa-quote-left text-primary mr-3"></h3>
              Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr
              eirmod clita lorem. Dolor tempor ipsum clita
            </div>
            <div class="d-flex align-items-center">
              <img
                class="rounded-circle"
                src="images/testimonial-3.jpg"
                style="width: 70px; height: 70px"
                alt="Image"
              />
              <div class="pl-3">
                <h5>Parent Name</h5>
                <i>Profession</i>
              </div>
            </div>
          </div>
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-4 p-4">
              <h3 class="fas fa-quote-left text-primary mr-3"></h3>
              Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr
              eirmod clita lorem. Dolor tempor ipsum clita
            </div>
            <div class="d-flex align-items-center">
              <img
                class="rounded-circle"
                src="images/testimonial-4.jpg"
                style="width: 70px; height: 70px"
                alt="Image"
              />
              <div class="pl-3">
                <h5>Parent Name</h5>
                <i>Profession</i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Testimonial End -->

@endsection