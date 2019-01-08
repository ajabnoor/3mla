@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>تعديل الدولة</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>
 
     

        {!!  Form::model($country, [
          'route' => ['admin.country.update', $country->id],
          'enctype'=>'multipart/form-data'
        ])
        !!}
        {!! Form::bsText('name', 'إسم الدولة') !!}
        {!! Form::hidden('_method', 'PUT') !!}
        {!! Form::bsSubmit('تعديل') !!}
        {!! Form::close() !!}
    
    

@endsection