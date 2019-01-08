@extends('layouts.app')

@section('title','قائمة طلبات العملاء')
@section('description','قائمة طلبات العملاء')

@section('content')
<div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
            <h2>طلبات العملاء</h2>
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
                                <li class="list-group-item d-flex justify-content-between align-items-center darker">تاريخ الطلب<span class="badge badge-warning">{{ \Carbon\Carbon::parse($order->messages->first()->created_at)->diffForHumans() }}</span></li> 

                            <div class="card mb-4 box-shadow card-gray ">
                                <img src="{{ $order->product->currency->logo }} " alt="{{ $order->product->currency->name }}" class="card-img-top-sm">
                                <div class="card-body padding-top-zero ">
                                        @if ( $order->product->type == 'buy')
                                        <h5 class="card-title sell-green">طلب {{$order->product->currency->name}} بسعر</h5>
                                        <h1 class="card-title pricing-card-title title-center">{{ $order->product->price }} {{ $order->product->price_currency->name }}</h1>
                                        @elseif ( $order->product->type == 'sell')
                                        <h5 class="card-title sell-red">{{$order->product->currency->name}} للبيع بسعر</h5>
                                        <h1 class="card-title pricing-card-title title-center">{{ $order->product->price }} {{ $order->product->price_currency->name }}</h1>
                                        @endif
                                    </div> 
                                        <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">إسم المشتري<span class="badge badge-secondary">{{ $order->buyer->name }}</span></li> 
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">الكمية المطلوبة<span class="badge badge-secondary">{{ $order->ordered_amount }} {{ $order->product->currency->code }}</span></li> 
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">تنبيهات
                                                        @if ($order->owner_notifications === 0)
                                                        <span class="badge badge-secondary">لايوجد</span>
                                                        @else
                                                        <span class="badge badge-danger">{{$order->owner_notifications}}</span>
                                                        @endif
                                                    </li> 
                                                
                                               
                                           
                                        </li> 
                                        </ul> 
                                        <div class="card-body buttons-center">
                                                <a href="{{ route('user.mycustomers.edit', $order->id) }}" class="btn btn-warning btn-sm ">متابعة الطلب</a> 
                                                {{-- <button type="button" class="btn btn-danger btn-sm">حذف الطلب</button> --}}
                                            </div>
                                    </div>
                                </div>
                    @endforeach
                            </div>
                            @else
                            <div class="jumbotron jumbotron-fluid text-center text-muted">
                                    <div class="container">
                                      <h1 class="display-6">لا يوجد طلبات للعملاء</h1>
                                      {{-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> --}}
                                    </div>
                                  </div>
                              @endif
                    @endsection