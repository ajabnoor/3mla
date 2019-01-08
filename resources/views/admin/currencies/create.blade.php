@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>إضافة عملة جديدة</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>
 

            {!! Form::open(['action' => 'Admin\CurrencyController@store', 'enctype'=>'multipart/form-data']) !!}
            {!! Form::bsText('name', 'إسم العملة') !!}
            {!! Form::bsText('english', 'english') !!}
            {!! Form::bsText('code', 'رمز العملة') !!}
            {!! Form::bsText('wallet', 'رقم المحفظة') !!}
            {!! Form::bsFile('logo', 'لوجو العملة') !!}
                {!! Form::bsSubmit('إضافة') !!}
            {!! Form::close() !!}
    
        
@endsection