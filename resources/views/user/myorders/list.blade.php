@extends('layouts.app')
@section('title','قائمة طلباتي')
@section('description','قائمة طلباتي')
@section('content')
<div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
            <h2>قائمة طلباتي</h2>

                <div class="mx-auto" style="width: 100%;height:30px;">
                </div>
                
                    <div class="panel-body">
                        
                    
                    </div>
                </div>
            </div>
        </div>
        @if(count($orders))
        <div class="row">
                    @foreach ($orders as $order)
                        <div class="col-sm-4">
                                <li class="list-group-item d-flex justify-content-between align-items-center darker">تاريخ الطلب<span class="badge badge-success">{{ \Carbon\Carbon::parse($order->messages->first()->created_at)->diffForHumans() }}</span></li> 
                            <div class="card mb-4 box-shadow card-gray">
                                <img src="{{ $order->product->currency->logo }} " alt="{{ $order->product->currency->name }}" class="card-img-top-sm">
                                <div class="card-body padding-top-zero">
                                    @if ( $order->product->type == 'buy')
                                    <h5 class="card-title sell-green">طلب {{$order->product->currency->name}} بسعر</h5>
                                    <h1 class="card-title pricing-card-title title-center">{{ $order->product->price }} {{ $order->product->price_currency->name }}</h1>
                                    @elseif ( $order->product->type == 'sell')
                                    <h5 class="card-title sell-red">{{$order->product->currency->name}} للبيع بسعر</h5>
                                    <h1 class="card-title pricing-card-title title-center">{{ $order->product->price }} {{ $order->product->price_currency->name }}</h1>
                                    @endif
                                    </div> 
                                        <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">الكمية المطلوبة<span class="badge badge-secondary">
                                                    @if ($order->ordered_amount == 0)
                                                    لم تحدد
                                                    @else
                                                    {{$order->ordered_amount}} {{ $order->product->currency->code }}
                                                    @endif
                                                </span></li> 
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">
                                                    حالة الطلب
                                                        @if($order->status_id == 0)
                                                        <span class="badge badge-secondary">جديد</span>
                                                        @else
                                                        <span class="badge badge-secondary">{{$order->status->name}}</span>
                                                        @endif
                                                    </li> 
                                            <li class="list-group-item d-flex justify-content-between align-items-center list-coin">تنبيهات
                                                @if ($order->buyer_notifications === 0)
                                                <span class="badge badge-secondary">لا يوجد</span>
                                                @else
                                                <span class="badge badge-danger">{{$order->buyer_notifications}}</span>
                                                @endif
                                            </li> 
                                        </ul> 
                                        <div class="card-body buttons-center">
                                            <a href="{{ route('user.myorders.edit', $order->id) }}" class="btn btn-success btn-sm ">متابعة الطلب</a> 
                                        </div>
                                    </div>
                                </div>
                    @endforeach
                            </div>
                            @else
                            <div class="jumbotron jumbotron-fluid text-center text-muted">
                                    <div class="container">
                                      <h1 class="display-6">لا يوجد لديك طلبات</h1>
                                    </div>
                                  </div>
                              @endif
                    @endsection