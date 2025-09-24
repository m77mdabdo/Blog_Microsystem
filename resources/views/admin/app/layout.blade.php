
  <!--begin::Head-->
 @include('admin.app.head')
 
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->

      @include('admin.app.nav')
      <!--end::Header-->
      <!--begin::Sidebar-->

      @include('admin.app.sidebar')
      <!--end::Sidebar-->
      <!--begin::App Main-->


      @yield('body')




      <!--end::App Main-->
      <!--begin::Footer-->

      <!--end::Footer-->
    </div>
     @include('admin.app.footer')
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->


    @include('admin.app.scripte')
