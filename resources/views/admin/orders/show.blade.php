@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
               
            <h2>متابعة طلب...</h2>

                <div class="mx-auto" style="width: 100%;height:30px;">
                </div>
                <div class="panel-body">
                    
                
                </div>
            </div>
        </div>
    </div>


<div  id="chat" class="container" style="padding:0">
    <div  class="loading-parent" ref="statusContainer">
    <status :owner="owner" :orderid="orderid" :key="statuskey" v-on:statuskey="addKey"></status>
    </div>
    <div class="row">    
        <div class="col-sm-4">
            <div class="card mb-4 box-shadow card-gray">
                <img src="{{ $order->product->currency->logo }} " alt="{{ $order->product->currency->name }}" class="card-img-top-sm">
                <div class="card-body padding-top-zero">
                        @if ( $order->product->type == 'buy')
                        <h5 class="card-title sell-green">طلب {{$order->product->currency->name}} بسعر</h5>
                        <h1 class="card-title pricing-card-title title-center">{{ $order->product->price }} {{ $order->product->price_currency->name }}<small class="text-muted">/{{ $order->product->currency->code }}</small></h1>
                        @elseif ( $order->product->type == 'sell')
                        <h5 class="card-title sell-red">{{$order->product->currency->name}} للبيع بسعر</h5>
                        <h1 class="card-title pricing-card-title title-center">{{ $order->product->price }} {{ $order->product->price_currency->name }}<small class="text-muted">/{{ $order->product->currency->code }}</small></h1>
                        @endif
                    </div> 
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">اسم العضو<span class="badge badge-info">{{ $order->product->user->name }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">المكان<span class="badge badge-secondary">{{ $order->product->country->name }} - {{ $order->product->city->name }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">عمليات سابقة<span class="badge badge-secondary">{{sizeof($order->product->user->finishedorders)}}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">سرعة التحويل<span class="badge badge-secondary">{{ $order->product->speed }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">طرق التحويل<span class="badge badge-secondary">{{ $order->product->transfer_methods }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">الكمية المتوفرة<span class="badge badge-secondary">{{ $order->product->available }} {{ $order->product->currency->code }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">أقل كمية للبيع<span class="badge badge-secondary">{{ $order->product->min_amount }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">التقييم<span class="badge badge-gold">بائع معتمد</span></li>
                        </ul> 
                        {{--amount section--}}
                        <div class="card-body buttons-center" style="max-height: 75px;">
                            <div  class="input-group mb-3 chat-composer justify-content-between">
                                <input v-model="amount" v-if="show" type="text" placeholder="أدخل الكمية المطلوبة" class="form-control"> 
                                    <strong v-if="textshow" style="margin-top:5px">مطلوب @{{amount}} {{$order->product->currency->code}}</strong>
                                <div class="input-group-append">
                                    <button  @click="show ? addAmount() : editAmount()" type="button" class="btn btn-outline-secondary">@{{button}}</button>
                                </div>
                            </div>
                        </div>
                    <li v-if="textshow" class="list-group-item d-flex justify-content-between align-items-center darker">اجمالي المبلغ<span class="badge badge-danger">@{{total}} {{$order->product->price_currency->name}}</span></li>

                        {{--end amount section--}}


                    </div>
                </div>

        <div  class="col-sm-8">
            <div  class="card mb-4 box-shadow card-gray" >
                <div class="card-body border-bottom2" style="max-height:65px">
                    <h4 class="card-title">تواصل مع البائع </h4>
                </div>
                <chat-log :messages="messages"></chat-log>

                <div class="card-body buttons-center " style="max-height:75px">
                    <chat-composer v-on:messagesent="addMessage" :orderid="orderid" :owner="owner"></chat-composer>
                </div>
    </div>
</div>
</div>
</div>
<script>
        window.saleorderid = JSON.parse("{{ json_encode($order->id) }}");
        window.productid = JSON.parse("{{ json_encode($order->product->id) }}");
        window.newOrder = JSON.parse("{{ json_encode(false) }}");
        </script>
@endsection