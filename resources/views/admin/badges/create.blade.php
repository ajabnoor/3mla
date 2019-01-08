@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>إضافة وسم جديد</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>
 
<div class="row">
  <div class=" col-md-8">
            {!! Form::open(['action' => 'Admin\BadgeController@store']) !!}
            {!! Form::bsText('name', 'إسم الوسم') !!}
            {!! Form::bsText('description', 'الوصف') !!}
            {!! Form::bsText('class', 'الكلاس') !!}
                {!! Form::bsSubmit('إضافة') !!}
            {!! Form::close() !!}
  </div>   
</div>   
        
@endsection