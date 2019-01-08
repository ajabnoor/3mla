@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                @if ($product->type === 'sell')
            <h2>عرض بيع {{ $product->currency->name }}</h2>
                {{-- @elseif () --}}

                @endif
                <div class="mx-auto" style="width: 100%;height:30px;">
                </div>
                <div class="panel-body">
                    
                
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="card mb-4 box-shadow card-gray">
                <img src="{{ $product->currency->logo }} " alt="{{ $product->currency->name }}" class="card-img-top">
                <div class="card-body padding-top-zero">
                    {{-- <h5 class="card-title sell-red">إيثيريوم للبيع بسعر</h5>  --}}
                    <h1 class="card-title pricing-card-title title-center">{{ $product->price }} 
                        <small class="text-muted">/ {{ $product->currency->code }}</small></h1></div> 
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">اسم العضو<span class="badge badge-info">{{ $product->user->name }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">المكان<span class="badge badge-secondary">{{ $product->country->name }} - {{ $product->city->name }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">عمليات سابقة<span class="badge badge-secondary">14</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">سرعة التحويل<span class="badge badge-secondary">{{ $product->speed }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">طرق التحويل<span class="badge badge-secondary">{{ $product->transfer_methods }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">الكمية المتوفرة<span class="badge badge-secondary">{{ $product->available }} {{ $product->currency->code }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">أقل كمية للبيع<span class="badge badge-secondary">{{ $product->min_amount }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">التقييم<span class="badge badge-gold">بائع معتمد</span></li>
                        </ul> 
                        
                    </div>
                </div>

        <div  class="col-sm-8">
            <div id="chat" class="card mb-4 box-shadow card-gray">
                <div class="card-body border-bottom2" style="max-height:65px">
                    <h4 class="card-title" ref="{{ $product->id }}">تواصل مع البائع </h4>
                </div>
                <chat-log :messages="messages"></chat-log>

                <div class="card-body buttons-center " style="max-height:75px">
                    <chat-composer v-on:messagesent="addMessage" :orderid="orderid" :owner="owner"></chat-composer>
                </div>
    </div>
</div>
</div>
    <script>
    window.productid = JSON.parse("{{ json_encode($product->id) }}");
    window.newOrder = JSON.parse("{{ json_encode(true) }}");
    </script>
@endsection