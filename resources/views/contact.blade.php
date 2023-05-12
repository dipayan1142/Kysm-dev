@extends('front.layouts.app')
@section('content')

      

         <!-- section -->

    <section class="inner_banner">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="full">
              <h3>Contact us</h3>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end section -->
 <!-- Contact Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Get In Touch</span>
          </p>
          <h1 class="mb-4">Contact Us For Any Query</h1>
        </div>
        <div class="row">
          <div class="col-lg-7 mb-5">
            <div class="contact-form">
              <div id="success"> 
                 @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                 @endif
                </div>
              
              <form method="post" action="{{url('save-contact')}}"  enctype="multipart/form-data">
              @csrf
                <div class="control-group">
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    placeholder="Your Name"
                    required="required"
                    data-validation-required-message="Please enter your name"
                    name="contact_name"
                  />
                  <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    placeholder="Your Email"
                    required="required"
                    data-validation-required-message="Please enter your email"
                    name="contact_email"
                  />
                  <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                  <input
                    type="text"
                    class="form-control"
                    id="subject"
                    placeholder="Subject"
                    required="required"
                    data-validation-required-message="Please enter a subject"
                    name="subject"
                  />
                  <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                  <textarea
                    class="form-control"
                    rows="6"
                    id="message"
                    placeholder="Message"
                    required="required"
                    data-validation-required-message="Please enter your message"
                    name="message"
                  ></textarea>
                  <p class="help-block text-danger"></p>
                </div>
                <div>
                  <button
                    class="btn btn-primary py-2 px-4"
                    type="submit"
                    id="sendMessageButton"
                  >
                    Send Message
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-5 mb-5">
            <p
              class="font-weight-bold"
              style="font-weight: 500; font-size: 1rem"
            >
              Need to get in touch? We'd love to hear from you! Please fill out
              the form below and we'll contact you as soon as possible.
            </p>
            <div class="d-flex">
              <i
                class="fa fa-map-marker-alt d-inline-flex align-items-center justify-content-center bg-info text-secondary rounded-circle"
                style="width: 45px; height: 45px"
              ></i>
              <div class="pl-3" style="padding-left: 15px">
                <h5 class="p-0">Address</h5>
                <p>123 Street, New York, USA</p>
              </div>
            </div>
            <div class="d-flex">
              <i
                class="fa fa-envelope d-inline-flex align-items-center justify-content-center bg-info text-secondary rounded-circle"
                style="width: 45px; height: 45px"
              ></i>
              <div class="pl-3" style="padding-left: 15px">
                <h5 class="p-0">Email</h5>
                <p>info@example.com</p>
              </div>
            </div>
            <div class="d-flex">
              <i
                class="fa fa-phone-alt d-inline-flex align-items-center justify-content-center bg-info text-secondary rounded-circle"
                style="width: 45px; height: 45px"
              ></i>
              <div class="pl-3" style="padding-left: 15px">
                <h5 class="p-0">Phone</h5>
                <p>+012 345 67890</p>
              </div>
            </div>
            <div class="d-flex">
              <i
                class="far fa-clock d-inline-flex align-items-center justify-content-center bg-info text-secondary rounded-circle"
                style="width: 45px; height: 45px"
              ></i>
              <div class="pl-3" style="padding-left: 15px">
                <h5 class="p-0">Opening Hours</h5>
                <strong>Sunday - Friday:</strong>
                <p class="m-0">08:00 AM - 05:00 PM</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Contact End -->

@endsection