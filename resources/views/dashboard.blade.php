@extends('layouts/master')
@section('content')
<main id="content" role="main" class="main">
  <!-- Content -->
  <div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h1 class="page-header-title">Dashboard</h1>
        </div>
        <!-- End Col -->

        <div class="col-auto">
          <a class="btn btn-primary" href="{{url('banner/add')}}">
            <i class="bi-person-plus-fill me-1"></i> Add Banner
          </a>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>
    <!-- End Page Header -->

    <!-- Card -->
    <div class="card mb-3 mb-lg-5">
      <!-- Header -->
      <div class="card-header">
        <div class="row justify-content-between align-items-center flex-grow-1">
          <div class="col-md">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="card-header-title">Banners</h4>
            </div>
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <!-- Filter -->
            <div class="row align-items-sm-center">
              <div class="col-md">
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
              <!-- End Col -->
            </div>
            <!-- End Filter -->
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Header -->

      <!-- Table -->
      <div class="table-responsive datatable-custom">
        <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0, 1, 4],
                      "orderable": false
                    }],
                   "order": [],
                   "info": {
                     "totalQty": "#datatableWithPaginationInfoTotalQty"
                   },
                   "search": "#datatableSearch",
                   "entries": "#datatableEntries",
                   "pageLength": 8,
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatablePagination"
                 }'>
          <thead class="thead-light">
            <tr>
              <th scope="col" class="table-column-pe-0">
                #
              </th>
              <th>Image</th>
              <th>Name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach($banners as $key => $banner)
            <tr>
              <td class="table-column-pe-0">
                {{$key+1}}
              </td>
              <td class="table-column-ps-0">
                @if ($banner->thumbal && $banner->thumbal != '')
                  <a class="d-flex align-items-center" href="#">
                    <div class="flex-shrink-0">
                      <img class="avatar avatar-lg" src="{{url('uploads/banners')}}/{{ $banner->thumbal }}" width="75" alt="Image Description">
                    </div>
                  </a>
                @else
                  <img class="avatar-img" src="{{url('assets/img/documentation/img1.jpg')}}" width="75" alt="Image Description">
                @endif
              </td>
              <td>{{$banner->name}}</td>
              <td>
                @if($banner->status==0)
                <span class="legend-indicator bg-success"></span>Active
                @else
                <span class="legend-indicator bg-danger"></span>In Active
                @endif
              </td>
              <td>
                <a href="{{url('/banner/view').'/'.$banner->id}}"  data-id="{{$banner->id}}"><i class="bi-pencil-fill me-1"></i></a>
                <a href="#" class="delete-banner" data-id="{{$banner->id}}"><i class="bi-trash dropdown-item-icon"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- End Table -->

      <!-- Footer -->
      <div class="card-footer">
        <!-- Pagination -->
        <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
          <div class="col-sm mb-2 mb-sm-0">
            <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
              <span class="me-2">Showing:</span>

              <!-- Select -->
              <div class="tom-select-custom">
                <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "hideSearch": true
                          }'>
                  <option value="4">4</option>
                  <option value="6">6</option>
                  <option value="8" selected>8</option>
                  <option value="12">12</option>
                </select>
              </div>
              <!-- End Select -->

              <span class="text-secondary me-2">of</span>

              <!-- Pagination Quantity -->
              <span id="datatableWithPaginationInfoTotalQty"></span>
            </div>
          </div>
          <!-- End Col -->

          <div class="col-sm-auto">
            <div class="d-flex justify-content-center justify-content-sm-end">
              <!-- Pagination -->
              <nav id="datatablePagination" aria-label="Activity pagination"></nav>
            </div>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Pagination -->
      </div>
      <!-- End Footer -->
    </div>
    <!-- End Card -->
  </div>
  <!-- End Content -->
  <script>
    $(document).ready(function() {
      $(".delete-banner").on('click', function(event) {
        let deleteConf = confirm("Are you sure you want to delete?");
        if (deleteConf) {
          let data_id = $(this).attr('data-id');
          var savemember = $.ajax({
            type: 'POST',
            url: "{{url('delete-banner')}}",
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