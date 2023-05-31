@extends('layouts/master')
@section('content')
<main id="content" role="main" class="main">
  <!-- Content -->
  <div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-end">
        <div class="col-sm mb-2 mb-sm-0">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-no-gutter">
              <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Pages</a></li>
              <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Users</a></li>
              <li class="breadcrumb-item active" aria-current="page">Overview</li>
            </ol>
          </nav>

          <h1 class="page-header-title">Users</h1>
        </div>
        <!-- End Col -->

        <div class="col-sm-auto">
          <a class="btn btn-primary" href="{{url('users-add-user')}}">
            <i class="bi-person-plus-fill me-1"></i> Add user
          </a>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>
    <!-- End Page Header -->

    <!-- Stats -->
    <div class="row">
      <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
        <!-- Card -->
        <div class="card h-100">
          <div class="card-body">
            <h6 class="card-subtitle mb-2">Total users</h6>

            <div class="row align-items-center gx-2">
              <div class="col">
                <span class="js-counter display-4 text-dark">24</span>
                <span class="text-body fs-5 ms-1">from 22</span>
              </div>
              <!-- End Col -->

              <div class="col-auto">
                <span class="badge bg-soft-success text-success p-1">
                  <i class="bi-graph-up"></i> 5.0%
                </span>
              </div>
              <!-- End Col -->
            </div>
            <!-- End Row -->
          </div>
        </div>
        <!-- End Card -->
      </div>

      <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
        <!-- Card -->
        <div class="card h-100">
          <div class="card-body">
            <h6 class="card-subtitle mb-2">Active members</h6>

            <div class="row align-items-center gx-2">
              <div class="col">
                <span class="js-counter display-4 text-dark">12</span>
                <span class="text-body fs-5 ms-1">from 11</span>
              </div>

              <div class="col-auto">
                <span class="badge bg-soft-success text-success p-1">
                  <i class="bi-graph-up"></i> 1.2%
                </span>
              </div>
            </div>
            <!-- End Row -->
          </div>
        </div>
        <!-- End Card -->
      </div>

      <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
        <!-- Card -->
        <div class="card h-100">
          <div class="card-body">
            <h6 class="card-subtitle mb-2">New/returning</h6>

            <div class="row align-items-center gx-2">
              <div class="col">
                <span class="js-counter display-4 text-dark">56</span>
                <span class="display-4 text-dark">%</span>
                <span class="text-body fs-5 ms-1">from 48.7</span>
              </div>

              <div class="col-auto">
                <span class="badge bg-soft-danger text-danger p-1">
                  <i class="bi-graph-down"></i> 2.8%
                </span>
              </div>
            </div>
            <!-- End Row -->
          </div>
        </div>
        <!-- End Card -->
      </div>

      <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
        <!-- Card -->
        <div class="card h-100">
          <div class="card-body">
            <h6 class="card-subtitle mb-2">Active members</h6>

            <div class="row align-items-center gx-2">
              <div class="col">
                <span class="js-counter display-4 text-dark">28.6</span>
                <span class="display-4 text-dark">%</span>
                <span class="text-body fs-5 ms-1">from 28.6%</span>
              </div>

              <div class="col-auto">
                <span class="badge bg-soft-secondary text-secondary p-1">0.0%</span>
              </div>
            </div>
            <!-- End Row -->
          </div>
        </div>
        <!-- End Card -->
      </div>
    </div>
    <!-- End Stats -->

    <!-- Card -->
    <div class="card">
      <!-- Header -->
      <div class="card-header card-header-content-md-between">
        <div class="mb-2 mb-md-0">
          <form>
            <!-- Search -->
            <div class="input-group input-group-merge input-group-flush">
              <div class="input-group-prepend input-group-text">
                <i class="bi-search"></i>
              </div>
              <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
            </div>
            <!-- End Search -->
          </form>
        </div>

        <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
          <!-- Datatable Info -->
          <div id="datatableCounterInfo" style="display: none;">
            <div class="d-flex align-items-center">
              <span class="fs-5 me-3">
                <span id="datatableCounter">0</span>
                Selected
              </span>
              <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                <i class="bi-trash"></i> Delete
              </a>
            </div>
          </div>
          <!-- End Datatable Info -->

        </div>
      </div>
      <!-- End Header -->

      <!-- Table -->
      <div class="table-responsive datatable-custom position-relative">
        <table id="datatable" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0, 7],
                      "orderable": false
                    }],
                   "order": [],
                   "info": {
                     "totalQty": "#datatableWithPaginationInfoTotalQty"
                   },
                   "search": "#datatableSearch",
                   "entries": "#datatableEntries",
                   "pageLength": 15,
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatablePagination"
                 }'>
          <thead class="thead-light">
            <tr>
              <th class="table-column-pe-0">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">
                  <label class="form-check-label" for="datatableCheckAll"></label>
                </div>
              </th>
              <th class="table-column-ps-0">Name</th>
              <th>Phone</th>
              <th>Status</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            @if(count($users) > 0)
            @foreach($users as $user)
            <tr>
              <td class="table-column-pe-0">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="userids[]" value="{{$user->id}}" id="datatableCheckAll1">
                  <label class="form-check-label" for="datatableCheckAll1"></label>
                </div>
              </td>
              <td class="table-column-ps-0">
                <a class="d-flex align-items-center" href="#">
                  <div class="avatar avatar-circle">
                    <img class="avatar-img" src="./assets/img/160x160/img10.jpg" alt="Image Description">
                  </div>
                  <div class="ms-3">
                    <span class="d-block h5 text-inherit mb-0">{{$user->name}} <i class="bi-patch-check-fill text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Top endorsed"></i></span>
                    <span class="d-block fs-5 text-body">{{$user->email}}</span>
                  </div>
                </a>
              </td>
              <td>
                @if(!empty($user->phone)) {{$user->phone}} @else N.A @endif
              </td>
              <td>
                <span class="legend-indicator bg-success"></span>Active
              </td>
              <td>{{$user->role}}</td>
              <td>
                <a href="#" class="edit-users" data-id="{{$user->id}}"><i class="bi-pencil-fill me-1"></i></a>
                <a href="#" class="delete-users" data-id="{{$user->id}}"><i class="bi-trash dropdown-item-icon"></i></a>
                <!-- <div class="btn-group" role="group">
                    <a class="btn btn-white btn-sm" href="./ecommerce-product-details.html">
                      <i class="bi-pencil-fill me-1"></i> Edit
                    </a>

                   
                    <div class="btn-group">
                      <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDropdown1" data-bs-toggle="dropdown" aria-expanded="false"></button>

                      <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="productsEditDropdown1">
                        <a class="dropdown-item" href="#">
                          <i class="bi-trash dropdown-item-icon"></i> Delete
                        </a>
                        <a class="dropdown-item" href="#">
                          <i class="bi-archive dropdown-item-icon"></i> Archive
                        </a>
                        <a class="dropdown-item" href="#">
                          <i class="bi-upload dropdown-item-icon"></i> Publish
                        </a>
                        <a class="dropdown-item" href="#">
                          <i class="bi-x-lg dropdown-item-icon"></i> Unpublish
                        </a>
                      </div>
                    </div>
                  </div> -->
              </td>
            </tr>
            @endforeach
            @else
            <tr class="odd">
              <td valign="top" colspan="8" class="dataTables_empty">
                <div class="text-center p-4">
                  <img class="mb-3" src="{{url('assets/svg/illustrations/oc-error.svg')}}" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">
                  <img class="mb-3" src="{{('assets/svg/illustrations-light/oc-error.svg')}}" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="dark">
                  <p class="mb-0">No data to show</p>
                </div>
              </td>
            </tr>
            @endif

          </tbody>
        </table>
      </div>
      <!-- End Table -->
    </div>
    <!-- End Card -->
  </div>
  <!-- End Content -->
  <script>
    $(document).ready(function() {
      $(".delete-users").on('click', function(event) {
        let deleteConf = confirm("Are you sure you want to delete?");
        if (deleteConf) {
          let data_id = $(this).attr('data-id');
          var savemember = $.ajax({
            type: 'POST',
            url: "{{url('delete-user')}}",
            data: {
              data_id: data_id,
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(resultData) {
              location.reload();
            }
          });
        }
      });
    });
  </script>
  @endsection

  