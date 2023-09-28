<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-bs-theme="light" data-body-image="img-1" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>{{ env("APP_NAME") }} - {{ auth()->user()->role }} Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @include('layouts.dashboard.includes.asset_css')
    @yield('extra-css')
    </head>
<body>

    <div id="layout-wrapper">
        @include('layouts.dashboard.includes.header')
        @include('layouts.dashboard.includes.notificationmodal')
        @include('layouts.dashboard.includes.sidebar')

        <!-- Vertical Overlay-->
      <div class="vertical-overlay"></div>
      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="main-content">

        <div class="page-content">
          <div class="container-fluid">
            <!-- start page title -->

            @yield('content')

            <!-- end page title -->
          </div>
          <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include("layouts.dashboard.includes.footer")
      </div>


    </div>





    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-primary btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
      </button>
      <!--end back-to-top-->
      <!--preloader-->
      <div id="preloader">
        <div id="status">
          <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </div>
    
      <!-- JAVASCRIPT -->
      <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
      <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
      <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
      <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
      <script src="{{ asset('assets/js/plugins.js') }}"></script>
      <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- Sweet alert init js-->
      <script src="{{ asset('assets/js/pages/sweetalerts.init.js') }}"></script>
      <!-- App js -->
      @yield('extra-js')
      <script src="{{ asset('assets/js/app.js') }}"></script>

      <script>
        @if (session('success'))
            Swal.fire({
                html:'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Well done !</h4><p class="text-muted mx-4 mb-0">{!! session('success') !!}</p></div></div>',
                // showCancelButton: !0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                // cancelButtonClass: "btn btn-danger w-xs mt-2",
                buttonsStyling: !1,
                // showCloseButton: !0,
            });
        @endif

        @if (session('error'))
            Swal.fire({
                html:'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...! Something went Wrong !</h4><p class="text-muted mx-4 mb-0">{!! session('error') !!}</p></div></div>',
                // showCancelButton: !0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                // cancelButtonClass: "btn btn-danger w-xs mt-2",
                buttonsStyling: !1,
                // showCloseButton: !0,
            })
        @endif

        
            


       
    </script>
    
</body>
</html>