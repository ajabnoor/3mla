@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>تعديل العملة</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>
 
     <div class="row col-md-8">
        {!!  Form::model($pricecurrency, [
          'route' => ['admin.pricecurrency.update', $pricecurrency->id],
          'enctype'=>'multipart/form-data'
        ])
        !!}
        {!! Form::bsText('name', 'إسم العملة') !!}
        {!! Form::bsText('code', 'رمز العملة') !!}
        {!! Form::bsText('rate', 'التحويل للدولار') !!}
        {!! Form::hidden('_method', 'PUT') !!}
        {!! Form::hidden('logo') !!}
        {!! Form::bsSubmit('تعديل') !!}
        {!! Form::close() !!}
      </div>
    

@endsection