<!-- ========== HEADER ========== -->

<header id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
  <div class="navbar-nav-wrap">
    <!-- Logo -->
    <a class="navbar-brand" href="{{url('/')}}" aria-label="Front">
      <img class="navbar-brand-logo" src="{{ url('assets/svg/logos/logo.svg')}}" alt="Logo" data-hs-theme-appearance="default">
      <img class="navbar-brand-logo" src="{{url('assets/svg/logos-light/logo.svg')}}" alt="Logo" data-hs-theme-appearance="dark">
      <img class="navbar-brand-logo-mini" src="{{url('assets/svg/logos/logo-short.svg')}}" alt="Logo" data-hs-theme-appearance="default">
      <img class="navbar-brand-logo-mini" src="{{url('assets/svg/logos-light/logo-short.svg')}}" alt="Logo" data-hs-theme-appearance="dark">
    </a>
    <!-- End Logo -->

    <div class="navbar-nav-wrap-content-start">
      <!-- Navbar Vertical Toggle -->
      <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
        <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
        <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
      </button>

      <!-- End Navbar Vertical Toggle -->

      <!-- Search Form -->
      <div class="dropdown ms-2">
        <!-- Input Group -->
        <div class="d-none d-lg-block">
          <div class="input-group input-group-merge input-group-borderless input-group-hover-light navbar-input-group">
            <div class="input-group-prepend input-group-text">
              <i class="bi-search"></i>
            </div>

            <input type="search" class="js-form-search form-control" placeholder="Search in front" aria-label="Search in front" data-hs-form-search-options='{
                       "clearIcon": "#clearSearchResultsIcon",
                       "dropMenuElement": "#searchDropdownMenu",
                       "dropMenuOffset": 20,
                       "toggleIconOnFocus": true,
                       "activeClass": "focus"
                     }'>
            <a class="input-group-append input-group-text" href="javascript:;">
              <i id="clearSearchResultsIcon" class="bi-x-lg" style="display: none;"></i>
            </a>
          </div>
        </div>

        <button class="js-form-search js-form-search-mobile-toggle btn btn-ghost-secondary btn-icon rounded-circle d-lg-none" type="button" data-hs-form-search-options='{
                       "clearIcon": "#clearSearchResultsIcon",
                       "dropMenuElement": "#searchDropdownMenu",
                       "dropMenuOffset": 20,
                       "toggleIconOnFocus": true,
                       "activeClass": "focus"
                     }'>
          <i class="bi-search"></i>
        </button>
        <!-- End Input Group -->


      </div>

      <!-- End Search Form -->
    </div>
    @php
    $user = Illuminate\Support\Facades\Auth::user();
    @endphp
    <div class="navbar-nav-wrap-content-end">
      <!-- Navbar -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <!-- Account -->
          <div class="dropdown">
            <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
              <div class="avatar avatar-sm avatar-circle">
                @if ($user->image && $user->image != '')
                <img class="avatar-img" src="/uploads/users/{{ $user->image }}" alt="Image Description">
                @else
                <img class="avatar-img" src="{{url('assets/img/160x160/img6.jpg')}}" alt="Image Description">
                @endif
                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
              </div>
            </a>

            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account" aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
              <div class="dropdown-item-text">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                    <h5 class="mb-0">{{ $user->name }}</h5>
                    <p class="card-text text-body">{{ $user->email  }}</p>
                  </div>
                </div>
              </div>

              <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="#">Profile &amp; account</a>
              <a class="dropdown-item" href="#">Settings</a>

              <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="{{url('logout')}}">Sign out</a>
            </div>
          </div>
          <!-- End Account -->
        </li>
      </ul>
      <!-- End Navbar -->
    </div>
  </div>
</header>

<!-- ========== END HEADER ========== -->

<!-- ========== MAIN CONTENT ========== -->
<!-- Navbar Vertical -->

<aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
  <div class="navbar-vertical-container">
    <div class="navbar-vertical-footer-offset">
      <!-- Logo -->

      <a class="navbar-brand" href="{{ url('/')}}" aria-label="Front">
        <img class="navbar-brand-logo" src="{{url('assets/svg/logos/logo.svg')}}" alt="Logo" data-hs-theme-appearance="default">
        <img class="navbar-brand-logo" src="{{url('assets/svg/logos-light/logo.svg')}}" alt="Logo" data-hs-theme-appearance="dark">
        <img class="navbar-brand-logo-mini" src="{{url('assets/svg/logos/logo-short.svg')}}" alt="Logo" data-hs-theme-appearance="default">
        <img class="navbar-brand-logo-mini" src="{{url('assets/svg/logos-light/logo-short.svg')}}" alt="Logo" data-hs-theme-appearance="dark">
      </a>

      <!-- End Logo -->

      <!-- Navbar Vertical Toggle -->
      <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
        <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
        <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
      </button>

      <!-- End Navbar Vertical Toggle -->

      <!-- Content -->
      <div class="navbar-vertical-content">
        <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
          <!-- Collapse -->
          <div class="nav-item">
            <a class="nav-link @if(Request::segment(1)=='dashboard') active @endif" href="{{url('dashboard')}}" data-placement="left">
              <i class="bi-house-door nav-icon"></i>
              <span class="nav-link-title">Dashboards</span>
            </a>
          </div>
          <!-- End Collapse -->

          <span class="dropdown-header mt-4">Pages</span>
          <small class="bi-three-dots nav-subtitle-replacer"></small>

          <!-- Collapse -->
          <div class="navbar-nav nav-compact">

          </div>
          <div id="navbarVerticalMenuPagesMenu">
            <!-- Collapse -->
            <!-- <div class="nav-item">
              <a class="nav-link dropdown-toggle @if(Request::segment(1)=='users') active @endif" href="#navbarVerticalMenuPagesUsersMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesUsersMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesUsersMenu">
                <i class="bi-people nav-icon"></i>
                <span class="nav-link-title">Users</span>
              </a>

              <div id="navbarVerticalMenuPagesUsersMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                <a class="nav-link " href="{{url('users')}}">Users List</a>
                <a class="nav-link " href="{{url('users-add-user')}}">Add User</a>
              </div>
            </div> -->
            <!-- End Collapse -->
             <!-- Collapse -->
             <!-- <div class="nav-item">
                <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesProjectsMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesProjectsMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesProjectsMenu">
                  <i class="bi-stickies nav-icon"></i>
                  <span class="nav-link-title">Banners</span>
                </a>

                <div id="navbarVerticalMenuPagesProjectsMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                  <a class="nav-link " href="#">List</a>
                  <a class="nav-link " href="#">Add</a>
                </div>
              </div> -->
              <!-- End Collapse -->
              <div class="nav-item">
                <a class="nav-link dropdown-toggle @if(Request::segment(1)=='product') active @endif" href="#navbarVerticalMenuPagesProductsMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesProductsMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesProductsMenu">
                  <i class="bi-box-seam nav-icon"></i>
                  <span class="nav-link-title">Products</span>
                </a>
                <div id="navbarVerticalMenuPagesProductsMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                  <a class="nav-link " href="{{url('product')}}">List</a>
                  <a class="nav-link " href="{{url('product/add')}}">Add</a>
                </div>
              </div>
              <div class="nav-item">
                <a class="nav-link @if(Request::segment(1)=='gallery') active @endif" href="{{url('gallery')}}" data-placement="left">
                  <i class="bi-box-seam nav-icon"></i>
                  <span class="nav-link-title">Gallery</span>
                </a>
              </div>
              <!-- <div class="nav-item">
                <a class="nav-link " href="#" data-placement="left">
                  <i class="bi-box-seam nav-icon"></i>
                  <span class="nav-link-title">Careers</span>
                </a>
              </div> 
              <div class="nav-item">
                <a class="nav-link " href="#" data-placement="left">
                  <i class="bi-box-seam nav-icon"></i>
                  <span class="nav-link-title">Contact</span>
                </a>
              </div> -->
          </div>

        </div>
        <!-- End Content -->

        <!-- Footer -->
        <div class="navbar-vertical-footer">
          <ul class="navbar-vertical-footer-list">
            <li class="navbar-vertical-footer-list-item">
              <!-- Style Switcher -->
              <div class="dropdown dropup">
                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>

                </button>

                <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
                  <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                    <i class="bi-moon-stars me-2"></i>
                    <span class="text-truncate" title="Auto (system default)">Auto (system default)</span>
                  </a>
                  <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                    <i class="bi-brightness-high me-2"></i>
                    <span class="text-truncate" title="Default (light mode)">Default (light mode)</span>
                  </a>
                  <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                    <i class="bi-moon me-2"></i>
                    <span class="text-truncate" title="Dark">Dark</span>
                  </a>
                </div>
              </div>

              <!-- End Style Switcher -->
            </li>
          </ul>
        </div>
        <!-- End Footer -->
      </div>
    </div>
</aside>

<!-- End Navbar Vertical -->