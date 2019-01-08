@extends('layouts.app')
@section('title','قائمة مبيعاتي')
@section('description','قائمة مبيعاتي')
@section('content')
<div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                    <div class="row justify-content-md-right">
                            <div class="col-md-auto col-sm-auto">
                              <h2>قائمة مبيعاتي</h2>
                            </div>
                            <div class="col-md-auto col-sm-auto">
                              <a href="{{ route('user.mysales.create') }}" class="btn btn-secondary btn-sm" role="button">إضافة منتج جديدة</a>
                            </div>
                            
                          </div>
                <div class="mx-auto" style="width: 100%;height:30px;">
                </div>
                
                    <div class="panel-body">


                    </div>
                </div>
            </div>
        </div>


        @if(count($sales))

        <div class="row">
                    @foreach ($sales as $sale)
                    @if($sale->type == 'sell')
                        <div class="col-md-4 col-sm-6">
                            @if ($sale->status == 'pending')
                            <li class="list-group-item  text-center text-light bg-danger">المنتج في انتظار النشر</li>
                            @endif
                                <div class="card mb-4 box-shadow card-red">
                                <img src="{{ $sale->currency->logo }} " alt="{{ $sale->currency->name }}" class="card-img-top">
                                <div class="card-body padding-top-zero ">
                                    <h5 class="card-title sell-red">{{$sale->currency->name}} للبيع بسعر</h5> 
                                    <h1 class="card-title pricing-card-title title-center">{{ $sale->price }} {{ $sale->price_currency->name }}
                                        <large class="text-muted">/ {{ $sale->currency->code }}</small></h1>
                                    </div> 
                                        <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">تاريخ العرض<span class="badge badge-info">{{ \Carbon\Carbon::parse($sale->created_at)->diffForHumans() }}</span></li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">الكمية المتوفرة للبيع<span class="badge badge-secondary">{{ $sale->available }} {{ $sale->currency->code }}</span></li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">المكان<span class="badge badge-secondary">{{$sale->country->name}} - {{$sale->city->name}}</span></li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">سرعة التحويل<span class="badge badge-secondary">{{$sale->speed}}</span></li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">طرق التحويل<span class="badge badge-secondary">{{$sale->transfer_methods}}</span></li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">الكمية المتوفرة<span class="badge badge-secondary">{{$sale->available}} {{$sale->currency->code}}</span></li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">أقل كمية للبيع<span class="badge badge-secondary">{{$sale->min_amount}}</span></li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-coin">التقييم<span class="badge badge-gold">بائع معتمد</span></li>
                                            </ul> 
                                            <div class="card-body buttons-center">
                        
                  
                                                    <a href="{{ route('user.mysales.edit', $sale->id) }}"  class="btn btn-primary btn-sm">تعديل</a>
                                                    <div style="width:50px;display: inline-block;">
                                                    {!! BootForm::open(['action' => ['User\MySaleController@destroy', $sale->id]]) !!}
                                                    {!! BootForm::hidden('_method', 'DELETE') !!}
                                                    {!! Form::submit('حذف', ['class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("هل أنت متأكد من حذف المنتج؟")']) !!}
                                                    {!! BootForm::close() !!}
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                @elseif($sale->type == 'buy')
                                <div class="col-md-4 col-sm-6">
                                    @if ($sale->status == 'pending')
                                        <li class="list-group-item  text-center text-light bg-success">المنتج في انتظار النشر</li>
                                    @endif
                                    <div class="card mb-4 box-shadow card-green">
                                        <img src="{{ $sale->currency->logo }} " alt="{{ $sale->currency->name }}" class="card-img-top">
                                        <div class="card-body padding-top-zero ">
                                            <h5 class="card-title sell-green">طلب {{$sale->currency->name}} بسعر</h5> 
                                            <h1 class="card-title pricing-card-title title-center">{{ $sale->price }} {{ $sale->price_currency->name }}
                                                <large class="text-muted">/ {{ $sale->currency->code }}</small></h1>
                                            </div> 
                                                <ul class="list-group list-group-flush">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">تاريخ العرض<span class="badge badge-info">{{ \Carbon\Carbon::parse($sale->created_at)->diffForHumans() }}</span></li> 
                                                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">الكمية المطلوبة للبيع<span class="badge badge-secondary">{{ $sale->available }} {{ $sale->currency->code }}</span></li> 
                                                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">المكان<span class="badge badge-secondary">{{$sale->country->name}} - {{$sale->city->name}}</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">سرعة التحويل<span class="badge badge-secondary">{{$sale->speed}}</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">طرق التحويل<span class="badge badge-secondary">{{$sale->transfer_methods}}</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">الكمية المتوفرة<span class="badge badge-secondary">{{$sale->available}} {{$sale->currency->code}}</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">أقل كمية للبيع<span class="badge badge-secondary">{{$sale->min_amount}}</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center list-coin">التقييم<span class="badge badge-gold">بائع معتمد</span></li>
                                                    </ul> 
                                                    <div class="card-body buttons-center">
                                
                          
                                                            <a href="{{ route('user.mysales.edit', $sale->id) }}"  class="btn btn-primary btn-sm">تعديل</a>
                                                            <div style="width:50px;display: inline-block;">
                                                                    {!! BootForm::open(['action' => ['User\MySaleController@destroy', $sale->id]]) !!}
                                                                    {!! BootForm::hidden('_method', 'DELETE') !!}
                                                                    {!! Form::submit('حذف', ['class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("هل أنت متأكد من حذف المنتج؟")']) !!}
                                                                    {!! BootForm::close() !!}
                                                                </div>
                                                </div>
                                            </div>
                                        </div>
                    @endif
                    @endforeach
                            </div>
                    @else
                    <div class="jumbotron jumbotron-fluid text-center text-muted">
                            <div class="container">
                              <h1 class="display-6">لا يوجد لديك منتجات</h1>
                            </div>
                          </div>
                    @endif
                    @endsection