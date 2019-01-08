@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>تعديل المدينة</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>
 
     

        {!!  Form::model($city, [
          'route' => ['admin.city.update', $city->id],
          'enctype'=>'multipart/form-data'
        ])!!}
        {!! Form::bsSelect('country','اختر الدولة', $countries ) !!}
        {!! Form::bsText('name', 'إسم المدينة') !!}
        {!! Form::hidden('_method', 'PUT') !!}
        {!! Form::bsSubmit('تعديل') !!}
        {!! Form::close() !!}

        
    
    

@endsection