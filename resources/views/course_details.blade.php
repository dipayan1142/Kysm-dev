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
              {{$all_data['courseDetails']->about_course}}
            </p>
            <div class="row pt-1 pb-1">
              <div class="col-12 col-md-12">
                <h3 class="mb-1">Key Features</h3>
                <ul class="list-inline m-0">
                  <li class="py-2 border-top border-bottom">
                    <i class="fa fa-check text-primary mr-3"></i>{{$all_data['courseDetails']->key_features}}
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

          @if(count($all_data['semister'])!=0)
          @foreach ($all_data['semister'] as $key => $val)

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button
                  class="accordion-button"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapse{{$val->id}}"
                  aria-expanded="true"
                  aria-controls="collapse{{$val->id}}"
                >
                  {{$val->name}}
                </button>
              </h2>
              <div
                id="collapse{{$val->id}}"
                class="accordion-collapse collapse"
                data-bs-parent="#accordionExample"
              >
                <div class="accordion-body">
                  {{$val->description}}
                </div>
              </div>
            </div>

          @endforeach
          @endif
         
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

        @if(count($all_data['module'])!=0)
        @foreach ($all_data['module'] as $key => $valm)

          <div class="col-lg-3 col-md-4 pb-1">
            <a href="{{url('course/'.$valm->id)}}">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"
              style="padding: 10px"
            >
              <i
                class="flaticon-050-fence flaticon-h1 font-weight-normal text-primary mb-3"
              ></i>
              <div class="flaticon-pl-4">
                <h4>{{$valm->name}}</h4>
              </div>
            </div>
            </a>
          </div>
     
      @endforeach
      @endif

        </div>
      </div>
    </div>
    <!-- Course module end -->
    

@endsection