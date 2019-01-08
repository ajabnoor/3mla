@component('mail::message')
# مرحبا بك {{$user->name}}
لقد تم تحديث حالة الطلب الخاص بعملة ال{{$order->product->currency->name}} إلى حالة "{{$order->status->name}}"<br>
لمتابعة الطلب قم بزيارة هذا الرابط<br>
{{$url}}


شكرا لك<br>
موقع {{ config('app.name') }}
@endcomponent
