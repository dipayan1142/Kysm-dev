@extends('layouts/master')
@section('content')
<main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Step Form -->
        <form class="js-step-form py-md-5" action="{{url('create-user')}}" method="post">
        {{ csrf_field() }}
            <div class="row justify-content-lg-center">
                <div class="col-lg-8">

                    <!-- Content Step Form -->
                    <div id="addUserStepFormContent">
                        <!-- Card -->
                        <div id="addUserStepProfile" class="card card-lg active">
                            <!-- Body -->
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="mb-5">
                                        <h1 class="display-5">Create new user</h1>
                                    </div>
                                </div>
                                <!-- Form -->
                                <!-- <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label form-label">Avatar</label>

                                    <div class="col-sm-9">
                                        <div class="d-flex align-items-center">
                                            <label class="avatar avatar-xl avatar-circle avatar-uploader me-5" for="avatarUploader">
                                                <img id="avatarImg" class="avatar-img" src="./assets/img/160x160/img1.jpg" alt="Image Description">

                                                <input type="file" class="js-file-attach avatar-uploader-input" id="avatarUploader" data-hs-file-attach-options='{
                                    "textTarget": "#avatarImg",
                                    "mode": "image",
                                    "targetAttr": "src",
                                    "resetTarget": ".js-file-attach-reset-img",
                                    "resetImg": "./assets/img/160x160/img1.jpg",
                                    "allowTypes": [".png", ".jpeg", ".jpg"]
                                 }'>

                                                <span class="avatar-uploader-trigger">
                                                    <i class="bi-pencil avatar-uploader-icon shadow-sm"></i>
                                                </span>
                                            </label>

                                            <button type="button" class="js-file-attach-reset-img btn btn-white">Delete</button>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="firstNameLabel" class="col-sm-3 col-form-label form-label">Full name <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Displayed on public forums, such as Front."></i></label>

                                    <div class="col-sm-9">
                                        <div class="input-group input-group-sm-vertical">
                                            <input type="text" class="form-control" name="name" id="firstNameLabel" placeholder="Full Name" aria-label="Full Name" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="emailLabel" class="col-sm-3 col-form-label form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email" id="emailLabel" placeholder="example@example.com" aria-label="example@example.com" required>
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="js-add-field row mb-4">
                                    <label for="phoneLabel" class="col-sm-3 col-form-label form-label">Phone</label>

                                    <div class="col-sm-9">
                                        <div class="input-group input-group-sm-vertical">
                                        <input type="tel" class="form-control form-control-lg" name="phone" id="phoneLabel" placeholder="xxxxxxxxxx" aria-label="xxxxxxxxxx"  pattern="[0-9]*"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" autocomplete="tel" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form -->
                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="roleLabel" class="col-sm-3 col-form-label form-label">Organization</label>
                                    <div class="col-sm-9">
                                    <select class="form-control" name="role" id="roleLabel" autocomplete="off" required>
                                            <option value="Admin">Master admin</option>
                                            <option value="Editor">Editor</option>
                                            <option value="User">User</option>
                                    </select>
                                    </div>
                                </div>
                                <!-- End Form -->

                              

                                
                            </div>
                            <!-- End Body -->

                            <!-- Footer -->
                            <div class="card-footer d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-primary">Add user</button>
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