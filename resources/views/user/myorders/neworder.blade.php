@extends('layouts.app')
@section('title','عرض بيع '.$product->currency->name)
@section('description','عرض بيع '.$product->currency->name)
@section('content')

<div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                @if ($product->type === 'sell')
            <h2>عرض بيع {{$product->currency->name}}</h2>
                @elseif ($product->type === 'buy')
                <h2>عرض طلب {{$product->currency->name}}</h2>
                @endif
                <div class="mx-auto" style="width: 100%;height:30px;">
                </div>
                <div class="panel-body">
                    
                
                </div>
            </div>
        </div>
    </div>
    <div id="chat" class="row">
        <div class="col-sm-4">
            <div class="card mb-4 box-shadow card-gray">
                <img src="{{ $product->currency->logo }}" alt="{{ $product->currency->name }}" class="card-img-top">
                <div class="card-body padding-top-zero">
                    <h1 class="card-title pricing-card-title title-center">{{ $product->price }} {{ $product->price_currency->name }} 
                        <small class="text-muted">/ {{ $product->currency->code }}</small></h1></div> 
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">اسم العضو<span class="badge badge-info">{{ $product->user->name }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">المكان<span class="badge badge-secondary">{{ $product->country->name }} - {{ $product->city->name }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">عمليات سابقة<span class="badge badge-secondary">{{sizeof($product->user->finishedorders)}}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">سرعة التحويل<span class="badge badge-secondary">{{ $product->speed }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">طرق التحويل<span class="badge badge-secondary">{{ $product->transfer_methods }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">الكمية المتوفرة<span class="badge badge-secondary">{{ $product->available }} {{ $product->currency->code }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">أقل كمية للبيع<span class="badge badge-secondary">{{ $product->min_amount }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">التقييم<span class="badge badge-gold">بائع معتمد</span></li>
                        </ul> 

                        {{--amount section--}}
                        <div class="card-body buttons-center" style="height: 75px;">
                        {{--if--}}
                        <div  class="input-group mb-3 chat-composer justify-content-between" v-if="owner">
                            <input  type="text" placeholder="أدخل الكمية المطلوبة" class="form-control" disabled> 
                            <div class="input-group-append">
                                <button   type="button" class="btn btn-outline-secondary" disabled>أدخل</button>
                            </div>
                        </div>
                        {{--else--}}
                        <div  class="input-group mb-3 chat-composer justify-content-between" v-else>
                            <input v-model="amount" v-if="show" type="text" placeholder="أدخل الكمية المطلوبة" class="form-control"> 
                                <strong v-if="textshow" style="margin-top:5px">مطلوب @{{amount}} {{$product->currency->code}}</strong>
                            <div class="input-group-append">
                                <button  @click="show ? addAmount() : editAmount()" type="button" class="btn btn-outline-secondary">@{{button}}</button>
                            </div>
                        </div>
                        {{--enf if--}}
                        </div>
                        <li v-if="textshow" class="list-group-item d-flex justify-content-between align-items-center darker">اجمالي المبلغ<span class="badge badge-danger">@{{total}} {{ $product->price_currency->name }}</span></li>

                        {{--end amount section--}}


                    </div>
                </div>

        <div  class="col-sm-8">
            <div  class="card mb-4 box-shadow card-gray">
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
    window.saleorderid = JSON.parse("{{ json_encode(null) }}");
    window.productid = JSON.parse("{{ json_encode($product->id) }}");
    window.newOrder = JSON.parse("{{ json_encode(true) }}");
    </script>
@endsection