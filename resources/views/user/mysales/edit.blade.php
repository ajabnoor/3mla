@extends('layouts.app')
@section('title','تعديل منتج')
@section('description','تعديل منتج')
@section('content')

<div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
               
            <h2>تعديل المنتج</h2>

                <div class="mx-auto" style="width: 100%;height:30px;">
                </div>
                <div class="panel-body">
                    
                
                </div>
            </div>
        </div>
    </div>
   
    <div class="jumbotron  text-left " style="">
            <div id="app" class="row">
                    <div class=" col-md-8">
                    {!!  Form::model($product, [
                        'route' => ['user.mysales.update', $product->id],
                      ])
                      !!}
                       {!! Form::bsSelect('type','نوع الطلب', ['buy'=>'شراء', 'sell'=>'بيع'] ) !!}
                       {!! Form::bsSelect('currency_id','العملة الرقمية', $currencies ,null, ['ref'=>'currency']) !!}
                       <div class="form-row">

                            <div class="form-group col-md-6" v-if="profit">
                            {{ Form::label('التسعير', null) }}
                            {{ Form::select('price_type', ['fixed'=>'ثابت', 'marketwise'=>'حسب سعر السوق'], $product->price_type, array_merge(['class' => 'form-control','ref'=>'profit', 'v-on:change'=>'showProfit'])) }}
                            </div>
                            <div class="form-group col-md-12" v-else>
                             {{ Form::label('التسعير', null) }}
                             {{ Form::select('price_type', ['fixed'=>'ثابت', 'marketwise'=>'حسب سعر السوق'], $product->price_type, array_merge(['class' => 'form-control','ref'=>'profit', 'v-on:change'=>'showProfit'])) }}
                             </div>
                            <div class="form-group col-md-6" v-show="profit">
                                {{ Form::label('نسبة (%) اضافية على سعر السوق', null) }}
                                {{ Form::text('profit',null, array_merge(['class' => 'form-control','placeholder'=>'أدخل رقم فقط','v-model'=>'percent','ref'=>'percent','v-on:input'=>'showProfit'])) }}
                              </div>
                            </div>
                            
                              <div class="form-row">
               
                              <div class="form-group col-md-6" v-if="profit">
                                  {{ Form::label('سيتم تحديث السعر كل 10 دقائق', null) }}
                                  {{ Form::text('price',null, array_merge(['class' => 'form-control','placeholder'=>'أدخل السعر', 'v-model'=>'price' ,'disabled'])) }}
                                </div>
                                <div class="form-group col-md-6" v-else>
                                  {{ Form::label('السعر', null) }}
                                  {{ Form::text('price',null, array_merge(['class' => 'form-control','placeholder'=>'أدخل السعر'])) }}
                                </div>
                              <div class="form-group col-md-6">
                                  {{ Form::label('العملة النقدية', null) }}
                                  {{ Form::select('price_currency_id',$pricecurrencies ,null, array_merge(['class' => 'form-control', 'ref'=>'price_currency', 'v-on:change'=>'showProfit'])) }}
                                  </div>
                        </div>
                           {!! Form::bsSelect('country_id','الدولة', $countries ,null, ['ref'=>'country', 'v-on:change'=>'showCities', 'id'=>'country']) !!}
                          
                           <div class="form-group">
                           <label for="اختر المدينة" class="control-label">المدينة</label>
                           <select class="form-control" name="city_id"> 
                           <option v-for="city in cities" v-bind:value="city.id">@{{city.name}}</option>
                           </select>
                           </div>
           
           
                     {!! Form::bsText('transfer_methods', 'طرق التحويل') !!}
                     {!! Form::bsText('speed', 'سرعة العملية') !!}
                     {!! Form::bsText('available', 'الكمية المتاحة للبيع') !!}
                     {!! Form::bsText('min_amount', 'الحد الأدنى للتحويل') !!}
                     {!! Form::hidden('_method', 'PUT') !!}
                     {!! Form::bsSubmit('تعديل') !!}
                       {!! Form::close() !!}
                    </div>
                </div>
            </div>
          <style>
                .jumbotron {
                    margin-bottom: 1rem;
                    padding: 2rem 2rem;
                }</style>
                <script>
                        window.globalpercent = JSON.parse("{{ json_encode($product->profit) }}");
                        </script>
@endsection
