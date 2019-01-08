@extends('layouts.app')

@section('title','متابعة طلب')
@section('description','متابعة طلب لعميل')

@section('content')

<div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
               
            <h2>متابعة طلب لعميل...</h2>

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
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">اسم المشتري<span class="badge badge-info">{{ $order->buyer->name }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">الكمية المطلوبة<span class="badge badge-warning">{{ $order->ordered_amount }} {{  $order->product->currency->code }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">المبلغ لإجمالي<span class="badge badge-danger">{{ $order->ordered_amount * $order->product->price }} {{  $order->product->price_currency->name }}</span></li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">1% عمولة موقع عملة<span class="badge badge-danger">{{ $order->ordered_amount * 0.01 }} {{  $order->product->currency->code }}</span></li> 
                            
                        </ul> 
                        {{--amount section--}}
                        <div class="card-body buttons-center" >
                            <div class="alert alert-danger" style="padding:5px">
                                <strong>
                                تحويل عمولة موقع عملة (1%) يتم خلال 24 بعد استلام الدفع من المشتري على محفظة ال{{ $order->product->currency->name }} بالأسفل. عدم دفع العمولة سيعرض حسابك للحظر.
                                </strong>
                            </div>
                            <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter">محفظة {{ $order->product->currency->name }}</a>
                            
                        </div>
                        {{--end amount section--}}
                    </div>
                </div>

        <div  class="col-sm-8">
            <div  class="card mb-4 box-shadow card-gray" >
                <div class="card-body border-bottom2" style="max-height:65px">
                    <h4 class="card-title">تواصل مع {{$order->buyer->name}} </h4>
                </div>
                <chat-log :messages="messages"></chat-log>

                <div class="card-body buttons-center " style="max-height:75px">
                    <chat-composer v-on:messagesent="addMessage" :orderid="orderid" :owner="owner"></chat-composer>
                </div>
    </div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">عنوان محفظة ال{{ $order->product->currency->name }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="wallet_input">{{ $order->product->currency->wallet }}</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
          </div>
        </div>
      </div>
<script>
        window.saleorderid = JSON.parse("{{ json_encode($order->id) }}");
        window.productid = JSON.parse("{{ json_encode($order->product->id) }}");
        window.newOrder = JSON.parse("{{ json_encode(false) }}");
        </script>

<style>
    .loading-parent {
      position: relative;
    }
    </style>
@endsection