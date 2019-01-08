@component('mail::message')
# مرحبا بك {{$user->name}}
لديك تنبيه جديد على الطلب الخاص بعملة ال{{$product->currency->name}} <br>
لمتابعة الطلب قم بزيارة هذا الرابط<br>
{{$url}}


شكرا لك<br>
موقع {{ config('app.name') }}
@endcomponent
