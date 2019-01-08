<footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
        <div class="col-6 col-md">
            <img class="mb-2" src="{{ asset('img/logo_black.png') }}" alt="" height="35">
            <small class="d-block mb-3 text-muted">© 2017-2018</small>
        </div>
        <div class="col-12 col-md">
            <h5>روابط سريعة</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="{{ route('user.myorders.index') }}">طلباتي</a></li>
                <li><a class="text-muted" href="{{$owner_notifications}}">طلبات العملاء</a></li>
                <li><a class="text-muted" href="{{ route('user.mysales.index') }}">مبيعاتي</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>روابط مهمة</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="https://coinmarketcap.com/">كوين ماركت كاب</a></li>
                <li><a class="text-muted" href="https://www.binance.com">بينانس</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>تواصل معنا</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="https://twitter.com/3mla_net">تويتر</a></li>
                <li><a class="text-muted" href="https://t.me/www_3mla_net">تيليجرام</a></li>
            </ul>
        </div>
    </div>