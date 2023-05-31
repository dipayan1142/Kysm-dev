@extends('layouts/master')
@section('content')
<main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Step Form -->
        <form class="js-step-form py-md-5" action="{{url('gallery/edit')}}" method="post"  enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$gallery->id}}" />
        <div class="row justify-content-lg-center">
            @if(Session::has('flash_message'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                {{ csrf_field() }}

                <div class="col-lg-8">

                    <!-- Content Step Form -->
                    <div id="addUserStepFormContent">
                        <!-- Card -->
                        <div id="addUserStepProfile" class="card card-lg active">
                            <!-- Body -->
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="mb-5">
                                        <h1 class="display-5">Edit Banner</h1>
                                    </div>
                                </div>
                                <!-- Form -->
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label form-label">Image</label>

                                    <div class="col-sm-9">
                                        <div class="d-flex align-items-center">
                                            <label class="avatar avatar-xl avatar-uploader me-5" for="avatarUploader">
                                                <img id="avatarImg" class="avatar-img" src="{{url('assets/img/160x160/img1.jpg')}}" alt="Image Description">

                                                <input type="file" name="attachment" class="js-file-attach avatar-uploader-input" id="avatarUploader" data-hs-file-attach-options='{
                                    "textTarget": "#avatarImg",
                                    "mode": "image",
                                    "targetAttr": "src",
                                    "resetTarget": ".js-file-attach-reset-img",
                                    "resetImg": "{{url("assets/img/160x160/img1.jpg")}}",
                                    "allowTypes": [".png", ".jpeg", ".jpg"]
                                 }'>

                                                <span class="avatar-uploader-trigger">
                                                    <i class="bi-pencil avatar-uploader-icon shadow-sm"></i>
                                                </span>
                                            </label>

                                            <button type="button" class="js-file-attach-reset-img btn btn-white me-5">Delete</button>
                                            @if ($gallery->thumbal && $gallery->thumbal != '')
                                            <label class="avatar avatar-xl avatar-uploader">
                                            <img id="avatarImg" class="avatar-img" src="{{url('uploads/gallerys')}}/{{ $gallery->thumbal }}" alt="Image Description">
                                            </label>    
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="firstNameLabel" class="col-sm-3 col-form-label form-label">Title</label>

                                    <div class="col-sm-9">
                                        <div class="input-group input-group-sm-vertical">
                                            <input type="text" class="form-control" name="name" id="firstNameLabel" value="{{$gallery->name}}" placeholder="Enter Title" aria-label="Enter Title" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form -->

                            </div>
                            <!-- End Body -->

                            <!-- Footer -->
                            <div class="card-footer d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <!-- End Footer -->
                        </div>
                        <!-- End Card -->

                    </div>
                    <!-- End Content Step Form -->
                </div>
        </div>
        <!-- End Row -->
        </form>
        <!-- End Step Form -->
    </div>
    <!-- End Content -->
    @endsection