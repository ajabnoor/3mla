@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>تعديل العملة</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>
 
      {{-- {!! BootForm::open(['model' => $currency, 'update' => 'users.update']);  !!} --}}
      {{-- {!! BootForm::open(['action' => ['Admin\CurrencyController@update', $currency->id], 'enctype'=>'multipart/form-data']) !!} --}}

      {{-- {!! Form::open(['action' => route('admin.currency.update', $currency), 'enctype'=>'multipart/form-data']) !!} --}}
      <img src="{{url('/')}}/storage/uploads/{{$currency->logo}}" alt="">



        {!!  Form::model($currency, [
          'route' => ['admin.currency.update', $currency->id],
          'enctype'=>'multipart/form-data'
        ])
        !!}
        {!! Form::bsText('name', 'إسم العملة') !!}
        {!! Form::bsText('english', 'english') !!}
        {!! Form::bsText('code', 'رمز العملة') !!}
        {!! Form::bsText('wallet', 'رقم المحفظة') !!}
        {!! Form::bsFile('logo_new', 'لوجو العملة') !!}
        {!! Form::hidden('_method', 'PUT') !!}
        {!! Form::hidden('logo') !!}
        {!! Form::bsSubmit('تعديل') !!}
        {!! Form::close() !!}
    
    

@endsection