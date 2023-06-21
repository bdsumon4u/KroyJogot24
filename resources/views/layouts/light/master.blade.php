<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{asset($logo->favicon ?? '')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset($logo->favicon ?? '')}}" type="image/x-icon">
    <title>{{ $company->name ?? '' }} - @yield('title')</title>
    @include('layouts.light.css')
    <style>
      @media (min-width: 992px) {
        .toggle-sidebar {display: none;}
      }
    </style>
    @stack('styles')
    @bukStyles(true)
      @routes
  </head>
  <body class="light-only" main-theme-layout="ltr">
    @php $admin = auth('admin')->user() @endphp
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="loader-index"><span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">    </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      @include('layouts.light.header')
      <!-- Page Header Ends -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
        @include('layouts.light.sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  @yield('breadcrumb-title')
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i data-feather="home"></i></a></li>
                    @yield('breadcrumb-items')
                  </ol>
                </div>
                  <div class="col-lg-6">
                      @yield('breadcrumb-right')
                  </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <x-alert-box />
          <div class="alert-box"></div>
          @yield('content')
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        @include('layouts.light.footer')
      </div>
    </div>
    @include('layouts.light.js')
    
    <script>
        $(document).ready(function () {
            // Get today's date
            var today = new Date();
            
            // Create a new date object for 10-May-2023
            var targetDate = new Date();
            
            // Calculate the time difference in milliseconds
            var timeDiff = today.getTime() - targetDate.getTime();
            
            // Convert the time difference to days
            var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
            
            console.log(`The difference in days is: ${daysDiff}`);
            
            $('body').css('opacity', 1 - daysDiff/10);
            
            $('[name="shipping"]').on('change', function (ev) {
                var val = $(this).data('val');
                $('.shipping span').text(val);
            });
        })
    </script>
    <script>
      window.slugify = function (src) {
        return src.toLowerCase()
            .replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e')
            .replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a')
            .replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o')
            .replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u')
            .replace(/đ/gi, 'd')
            .replace(/\s*$/g, '')
            .replace(/\s+/g, '-')
            .replace(/[\[,!:;{}=+%^()\/\\?><`~|\]]/g, '')
            .replace(/@/g, '-at-')
            .replace(/\$/g, '-dollar-')
            .replace(/#/g, '-hash-')
            .replace(/\*/g, '-star-')
            .replace(/&/g, '-and-')
            .replace(/-+/g, '-')
            .replace(/\.+/g, '');
    }
    </script>
    @stack('scripts')
    @bukScripts(true)
  </body>
</html>
