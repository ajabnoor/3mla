<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
    <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="" style="height:50px;margin-left:10px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ActiveRoute::isActiveRoute('home')}}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fa fa-home"></i>
                    الرئيسية
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item {{ActiveRoute::isActiveRoute('user/myorders')}}">
                <a class="nav-link " href="{{ route('user.myorders.index') }}">
                    <i class="fa fa-tasks">
                        @if ($buyer_notifications>0)
                            <span class="badge badge-danger" >{{$buyer_notifications}}</span>
                        @endif
                    </i>
                    طلباتي
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ActiveRoute::isActiveRoute('user/mycustomers')}}" href="{{ route('user.mycustomers.index') }}">
                    <i class="fa fa-users">
                        @if ($owner_notifications>0)
                            <span class="badge badge-danger" >{{$owner_notifications}}</span>
                        @endif
                    </i>
                    طلبات العملاء
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ActiveRoute::isActiveRoute('user/mysales')}}" href="{{ route('user.mysales.index') }}">
                    <i class="fa fa-box-open">
                    </i>
                    مبيعاتي
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://twitter.com/3mla_net">
                    <i class="fa"><img src="{{ asset('img/twitter.ico') }}" alt="" style="height:25px;-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
    filter: grayscale(100%);">
                    </i>
                    التويتر
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://t.me/www_3mla_net">
                    <i class="fa"><img src="{{ asset('img/telegram.png') }}" alt="" style="height:23px;-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
    filter: grayscale(100%);">
                    </i>
                    التيليجرام
                </a>
            </li>
            @role('admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.home') }}">
                    <i class="fa fa-lock">
                    </i>
                    لوحة الأدمين
                </a>
            </li>
            @endrole
        </ul>
        @if (Route::has('login'))
            @auth
            <a class="btn btn-secondary text-light disabled" style="margin:5px 0 0 5px" role="button" aria-disabled="true">مرحباً بك... {{ Auth::user()->name }}</a>

            <a class="btn btn-outline-secondary" href="{{ route('logout') }}">تسجيل الخروج</a>
        @else
            <a class="btn btn-outline-secondary" href="{{ route('register') }}">تسجيل جديد</a>
            <a class="btn btn-outline-secondary btn-extra-margin" href="{{ route('login') }}">تسجيل دخول</a>
            @endauth
        @endif
    </div>
</nav>

{{--<nav class="navbar navbar-expand-lg navbar-light bg-light">--}}
          {{--<a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="" style="height:50px;margin-left:10px"></a>--}}


          {{--<div class="collapse navbar-collapse" id="navbarNav">--}}
            {{--<ul class="navbar-nav mr-auto">--}}
              {{--<li class="nav-item active">--}}
                {{--<a class="nav-link" href="{{ route('home') }}">الرئيسية <span class="sr-only">(current)</span></a>--}}
              {{--</li>--}}
              {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="{{ route('user.myorders.index') }}">طلباتي--}}
                    {{--@if ($buyer_notifications>0)--}}
                    {{--<span class="badge badge-danger" >{{$buyer_notifications}}</span>--}}
                {{--@endif--}}
                {{--</a>--}}

              {{--</li>--}}
              {{--<li class="nav-item">--}}
                  {{--<a class="nav-link" href="{{ route('user.mycustomers.index') }}">طلبات العملاء--}}
                      {{--@if ($owner_notifications>0)--}}
                      {{--<span class="badge badge-danger">{{$owner_notifications}}</span>--}}
                  {{--@endif--}}
                {{--</a>--}}
                {{--</li>--}}
              {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="{{ route('user.mysales.index') }}">مبيعاتي--}}
              {{--</a>--}}
              {{--</li>--}}

              {{--@role('admin')--}}
              {{--<li class="nav-item">--}}
                  {{--<a class="nav-link" href="{{ route('admin.home') }}">لوحة الأدمين</a>--}}
                {{--</li>--}}
                {{--@endrole--}}

                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="https://twitter.com/3mla_net"> تويتر <img src="{{ asset('img/twitter.ico') }}" alt="" style="height:15px"></a>--}}
                  {{--</li>--}}
                  {{--<li class="nav-item">--}}
                      {{--<a class="nav-link" href="https://t.me/www_3mla_net"> تيليجرام <img src="{{ asset('img/telegram.png') }}" alt="" style="height:12px"></a>--}}
                    {{--</li>--}}


              {{-- <li class="nav-item dropdown">--}}
                  {{--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                    {{--Dropdown link--}}
                  {{--</a>--}}
                  {{--<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">--}}
                    {{--<a class="dropdown-item" href="#">Action</a>--}}
                    {{--<a class="dropdown-item" href="#">Another action</a>--}}
                    {{--<a class="dropdown-item" href="#">Something else here</a>--}}
                  {{--</div>--}}
                {{--</li> --}}
            {{--</ul>--}}
          {{--</div>--}}

          {{--@if (Route::has('login'))--}}
               {{--@auth--}}
               {{--<span class="badge badge-secondary" style="margin:0 0 0 5px">مرحباً بك... {{ Auth::user()->name }}</span>--}}

               {{--<a class="badge badge-secondary" href="{{ route('logout') }}">تسجيل الخروج</a>--}}
          {{--@else--}}
          {{--<a class="btn btn-outline-secondary droid" href="{{ route('register') }}">تسجيل جديد</a>--}}
          {{--<a class="btn btn-outline-secondary droid btn-extra-margin" href="{{ route('login') }}">تسجيل دخول</a>--}}
          {{--@endauth--}}

    {{--@endif--}}
           {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">--}}
               {{--<span class="navbar-toggler-icon"></span>--}}
           {{--</button>--}}
        {{--</nav>--}}
        