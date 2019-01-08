@extends('admin.main')

@section('content')

  <div class="row justify-content-md-right">
    <div class="col-md-auto">
      <h2>تعديل الوسم</h2>
    </div>   
    
  </div>
  <div class="mx-auto" style="height: 20px;">
</div>
 
     
<div class="row">
    <div class=" col-md-8">
        {!!  Form::model($badge, [
          'route' => ['admin.badge.update', $badge->id],
          'enctype'=>'multipart/form-data'
        ])
        !!}
        {!! Form::bsText('name', 'إسم الوسم') !!}
        {!! Form::bsText('description', 'الوصف') !!}
            {!! Form::bsText('class', 'الكلاس') !!}
        {!! Form::hidden('_method', 'PUT') !!}
        {!! Form::bsSubmit('تعديل') !!}
        {!! Form::close() !!}
    </div>
  </div>
    

@endsection