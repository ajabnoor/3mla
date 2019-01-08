@component('mail::message')
# مرحبا بك {{$product->user->name}}
لقد قام العضو {{$user->name}} بإنشاء طلب جديد على منتجك الخاص بعملة ال{{$product->currency->name}} <br>
لمتابعة الطلب قم بزيارة هذا الرابط<br>
{{$url}}


شكرا لك<br>
موقع {{ config('app.name') }}
@endcomponent
