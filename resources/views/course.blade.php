@extends('front.layouts.app')
@section('content')

      

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

          @if(count($all_data['modules'])!=0)
          @foreach ($all_data['modules'] as $keym => $valm)

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
  
    <!-- Class Start popular class-->
    <div class="container-fluid pt-5 pb-3" style="background-color: aliceblue">
    <div class="container">
        <div class="text-center pb-2">
        <p class="section-title px-5">
            <span class="px-2">EXPLORE COURSES BY CATEGORIES</span>
        </p>
        @if($all_data['select_modules'])

            <h1 class="mb-4">{{$all_data['select_modules']->name}} Courses</h1>
        @else
            <h1 class="mb-4">All Courses</h1>

        @endif   
        </div>
        
        <div class="row">


        @if(count($all_data['courses'])!=0)
          @foreach ($all_data['courses'] as $key => $val)
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
              <a href="{{url('course-details/'.$module_id.'/'.$val->id)}}" class="btn btn-info btn-sm px-4 mx-auto mb-4"
                >Get Details</a
              >
            </div>
          </div>
          @endforeach
          @endif



        </div>
    </div>
    </div>
    <!-- Class End -->
    

@endsection