@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>إضافة عملة جديدة</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>
 
<div class="row col-md-8">
  
            {!! Form::open(['action' => 'Admin\PriceCurrencyController@store', 'enctype'=>'multipart/form-data']) !!}
            {!! Form::bsText('name', 'إسم العملة') !!}
            {!! Form::bsText('code', 'رمز العملة') !!}
            {!! Form::bsText('rate', 'التحويل للدولار') !!}
                {!! Form::bsSubmit('إضافة') !!}
            {!! Form::close() !!}
    
          </div>
   
@endsection