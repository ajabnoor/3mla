
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="../../../../favicon.ico">

    <title>لوحة الأدمين</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/admin_custom.css') }}" rel="stylesheet">
  </head>


  <body>
    
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('home') }}">عملة</a>
      {{--<input class="form-control form-control-dark w-100" type="text" placeholder="بحث" aria-label="Search">--}}
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">{{ Auth::user()->name }} تسجيل الخروج</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid" >
      <div class="row">
          <nav class="col-2 d-sm-block bg-light sidebar">
              {{--<nav class="col-md-2 d-none d-md-block bg-light sidebar">--}}
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.order.index') }}">
                      الطلبات
                    </a>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.product.index') }}">
                      المنتجات
                    </a>
                  </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                  الأعضاء
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.currency.index') }}">
                  العملات الرقمية
                </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.pricecurrency.index') }}">
                    العملات النقدية
                  </a>
                </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.country.index') }}">
                    الدول
                  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.city.index') }}">
                      المدن
                    </a>
                  </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.status.index') }}">
                    حالات الطلب
                  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.badge.index') }}">
الأوسمة
                    </a>
                </li>
            </ul>

          </div>
        </nav>
          <main role="main" class="col-10 ml-sm-auto col-lg-10 pt-3 px-4">
              {{--<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">--}}
          @include('inc.message')
        @yield('content')
        </main>
      </div>
    </div>
    <script src="{{ url('/') }}/js/app.js"></script>
  </body>
</html>
