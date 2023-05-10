@extends('front.layouts.app')
@section('content')

       
    <!-- section -->

    <section class="inner_banner">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="full">
              <h3>About us</h3>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end section -->

     <!-- section -->
     <div class="section margin-top_50">
      <div class="container">
        <div class="row">
          <div class="col-md-6 layout_padding_2">
            <div class="full">
              <div class="heading_main text_align_left">
                <h2><span>Welcome To</span> KYSM</h2>
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
              <!-- <div class="full">
                <a class="hvr-radial-out button-theme" href="#">About more</a>
              </div> -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="full">
              <img src="{{asset('front/images/about-us-kysm-2.jpg')}}" alt="#" />
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

@endsection